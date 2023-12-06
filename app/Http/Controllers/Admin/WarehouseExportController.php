<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;
use App\Models\Product;
use App\Models\Branch;
use App\Models\ProductWarehousing;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WarehouseExportRequest;
use Carbon\Carbon;



class WarehouseExportController extends Controller
{

    public function __construct()
    {
        view()->share([
            'export_warehouse' => 'active',
            'export_active' => 'active',
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

        $warehouses = Warehouse::with(['user', 'shop']);

        if ($request->warehouse_no) {
            $warehouses = $warehouses->where('warehouse_no', $request->warehouse_no);
        }

        if ($request->name) {
            $warehouses = $warehouses->where('name', $request->name);
        }

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $warehouses->where('shop_id', $admin->shop_id);
        }

        $warehouses = $warehouses->where('type', Warehouse::EXPORT_WAREHOUSES)->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.warehouse.export.index', compact('warehouses'));
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

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
            $branches->where('shop_id', $admin->shop_id);
        }
        $products = $products->get();
        $branches = $branches->get();

        return view('admin.warehouse.export.create', compact('products', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WarehouseExportRequest $request)
    {
        //
        $admin = Auth::user();
        $attributes = $request->except('products', 'customers', 'branches', 'total_numbers', 'prices', '_token', 'submit');

        $attributes['warehouse_no'] = randomOderNo();
        $attributes['shop_id'] = $admin->shop_id;
        $attributes['user_id'] = $admin->id;
        $attributes['type'] = Warehouse::EXPORT_WAREHOUSES;
        $attributes['created_at'] = $attributes['updated_at'] = Carbon::now();

        \DB::beginTransaction();
        try {
            $id = Warehouse::insertGetId($attributes);
            if ($id) {
                $products = $request->products;
                $customers = $request->customers;
                $branches = $request->branches;
                $total_numbers = $request->total_numbers;
                $prices = $request->prices;

                foreach ($products as $key => $product) {

                    $params = [
                        'shop_id' => $admin->shop_id,
                        'warehouse_id' => $id,
                        'product_id' => $product,
                        'branch_id' => $branches[$key] ?? '',
                        'export_branch_id' => $customers[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::EXPORT_WAREHOUSES,
                    ];

                    $paramsx = [
                        'shop_id' => $admin->shop_id,
                        'warehouse_id' => $id,
                        'product_id' => $product,
                        'branch_id' => $branches[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::IMPORT_WAREHOUSES,
                    ];

                    ProductWarehousing::create($params);

                    ProductWarehousing::create($paramsx);
                }
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
        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
            $branches->where('shop_id', $admin->shop_id);
        }
        $products = $products->get();
        $branches = $branches->get();

        $warehouse = Warehouse::with(['products'])->find($id);

        if (!$warehouse) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.warehouse.export.edit', compact('products', 'branches', 'warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WarehouseExportRequest $request, $id)
    {
        //
        $admin = Auth::user();
        $attributes = $request->except('products', 'customers', 'branches', 'total_numbers', 'prices', '_token', 'submit');
        $attributes['shop_id'] = $admin->shop_id;
        $attributes['updated_at'] = Carbon::now();

        \DB::beginTransaction();
        try {
            $warehouse = Warehouse::with(['products'])->find($id);

            if ($warehouse) {

                $products = $request->products;
                $customers = $request->customers;
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
                        'export_branch_id' => $customers[$key] ?? '',
                        'branch_id' => $branches[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::EXPORT_WAREHOUSES,
                    ];

                    $paramsx = [
                        'shop_id' => $admin->shop_id,
                        'warehouse_id' => $id,
                        'product_id' => $product,
                        'branch_id' => $branches[$key] ?? '',
                        'total_number' => $total_numbers[$key] ?? '',
                        'price' => $prices[$key] ?? '',
                        'total_price' => $total_numbers[$key] * $prices[$key],
                        'type' => Warehouse::IMPORT_WAREHOUSES,
                    ];

                    ProductWarehousing::create($params);
                    ProductWarehousing::create($paramsx);
                }
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


        $html =  view('admin.warehouse.export.row', compact('products', 'branches'))->render();

        return response([
            'html' => $html
        ]);
    }

    public function warehouseExport(Request $request)
    {
        $products = ProductWarehousing::with(['product', 'supplier', 'branch', 'branchExport']);

        $admin = Auth::user();

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
        }

        if ($request->product) {
            $nameProduct = $request->product;
            $products = $products->whereIn('product_id', function ($query) use($nameProduct) {
                $query->select('id')->from('products')->where('name', 'like', "%".$nameProduct."%");
            });
        }

        if ($request->branch) {
            $branch = $request->branch;
            $products = $products->whereIn('branch_id', function ($query) use($branch) {
                $query->select('id')->from('branches')->where('name', 'like', "%".$branch."%");
            })->orWhereIn('export_branch_id', function ($query) use($branch) {
                $query->select('id')->from('branches')->where('name', 'like', "%".$branch."%");
            });
        }

        $products = $products->whereIn('type', [Warehouse::EXPORT_WAREHOUSES, Warehouse::EXPORT_SELLING])->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);
        return view('admin.warehouse.export.product_export', compact('products'));
    }

    public function exportInvoicePrint($id)
    {
        $warehouse = Warehouse::with(['products' => function($query) {
            $query->with(['product', 'branchExport', 'branch'])->where('type', Warehouse::EXPORT_WAREHOUSES);
        }])->find($id);
        return view('admin.warehouse.export.export_print', compact('warehouse'));
    }
}
