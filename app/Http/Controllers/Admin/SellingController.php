<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\ProductWarehousing;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SellingRequest;
use Carbon\Carbon;
use App\Helpers\MailHelper;

class SellingController extends Controller
{
    //
    public function __construct()
    {
        view()->share([
            'selling_active' => 'active',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $admin = Auth::user();

        $warehouses = Warehouse::with(['user', 'shop', 'selling']);

        if ($request->warehouse_no) {
            $warehouses = $warehouses->where('warehouse_no', $request->warehouse_no);
        }

        if ($request->name) {
            $name = $request->name;
            $warehouses = $warehouses->whereIn('selling_id', function ($query) use ($name) {
                $query->select('id')->from('customers')->where('name', 'like', '%'.$name.'%');
            });
        }

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $warehouses->where('shop_id', $admin->shop_id);
        }

        $warehouses = $warehouses->where('type', Warehouse::EXPORT_SELLING)->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.selling.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $admin = Auth::user();
        $products = Product::select('*');
        $branches = Branch::select('*');
        $customers = Customer::select('*');

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
            $branches->where('shop_id', $admin->shop_id);
            $customers->where('shop_id', $admin->shop_id);
        }
        $products = $products->get();
        $branches = $branches->get();
        $customers = $customers->get();

        return view('admin.selling.create', compact('products', 'branches', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellingRequest $request)
    {
        //
        $admin = Auth::user();
        $attributes = $request->except('products', 'branches', 'total_numbers', 'prices', '_token', 'submit');

        $attributes['warehouse_no'] = randomOderNo();
        $attributes['shop_id'] = $admin->shop_id;
        $attributes['user_id'] = $admin->id;
        $attributes['type'] = Warehouse::EXPORT_SELLING;
        $attributes['created_at'] = $attributes['updated_at'] = Carbon::now();

        if ($request->selling_id) {
            $customer = Customer::find($request->selling_id);
            if ($customer) {
                $attributes['name'] = $customer->name;
            }
        }

        \DB::beginTransaction();
        try {
            $id = Warehouse::insertGetId($attributes);
            if ($id) {
                $products = $request->products;
                $branches = $request->branches;
                $total_numbers = $request->total_numbers;
                $prices = $request->prices;

                foreach ($products as $key => $product) {
                    $params = [
                        'shop_id' => $admin->shop_id,
                        'warehouse_id' => $id,
                        'product_id' => $product,
                        'branch_id' => $branches[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::EXPORT_SELLING,
                    ];
                    ProductWarehousing::create($params);
                }

                $this->invoicePrint($id, true);
            }
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = Auth::user();
        $products = Product::select('*');
        $branches = Branch::select('*');
        $customers = Customer::select('*');

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
            $branches->where('shop_id', $admin->shop_id);
            $customers->where('shop_id', $admin->shop_id);
        }
        $products = $products->get();
        $branches = $branches->get();
        $customers = $customers->get();

        $warehouse = Warehouse::with(['products'])->find($id);

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.selling.edit', compact('products', 'branches', 'warehouse', 'customers'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellingRequest $request, $id)
    {
        //
        $admin = Auth::user();
        $attributes = $request->except('products', 'branches', 'total_numbers', 'prices', '_token', 'submit');
        $attributes['shop_id'] = $admin->shop_id;
        $attributes['updated_at'] = Carbon::now();

        if ($request->selling_id) {
            $customer = Customer::find($request->selling_id);
            if ($customer) {
                $attributes['name'] = $customer->name;
            }
        }

        \DB::beginTransaction();
        try {
            $warehouse = Warehouse::with(['products'])->find($id);

            if ($warehouse) {

                $products = $request->products;
                $branches = $request->branches;
                $total_numbers = $request->total_numbers;
                $prices = $request->prices;

                $warehouse->update($attributes);
                ProductWarehousing::where('warehouse_id', $id)->delete();
                foreach ($products as $key => $product) {
                    $params = [
                        'warehouse_id' => $id,
                        'shop_id' => $admin->shop_id,
                        'product_id' => $product,
                        'branch_id' => $branches[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::EXPORT_SELLING,
                    ];
                    ProductWarehousing::create($params);
                }

                $this->invoicePrint($id, true);
            }
            \DB::commit();
            return redirect()->back()->with('success', 'Lưu dữ liệu thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $warehouse = Warehouse::find($id);
        if (!$warehouse) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $warehouse->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function importRow()
    {
        $admin = Auth::user();
        $products = Product::select('*');
        $branches = Branch::select('*');
        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
            $branches->where('shop_id', $admin->shop_id);
        }
        $products = $products->get();
        $branches = $branches->get();


        $html =  view('admin.selling.row', compact('products', 'branches'))->render();

        return response([
            'html' => $html
        ]);
    }

    public function invoicePrint($id, $sendMail = false)
    {
        $warehouse = Warehouse::with(['products' => function($query) {
            $query->with(['product', 'branch'])->where('type', Warehouse::EXPORT_SELLING);
        }, 'selling'])->find($id);
        if ($sendMail) {
            MailHelper::sendMailSelling($warehouse);
        }
        return view('admin.selling.export_print', compact('warehouse'));
    }
}
