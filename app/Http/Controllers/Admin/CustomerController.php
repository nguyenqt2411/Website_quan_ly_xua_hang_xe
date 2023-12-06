<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Shop;

class CustomerController extends Controller
{
    public $customer;
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
        view()->share([
            'customer_active' => 'active',
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
        $customers = Customer::with(['shop']);

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $customers->where('shop_id', $admin->shop_id);
        }

        if ($request->name) {
            $customers->where('name', '%'.$request->name.'%', $request->name);
        }

        $customers = $customers->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Auth::user();
        $shops = Shop::all();

        $viewData = [
            'shops' => $shops,
            'admin' => $admin,
        ];

        return view('admin.customer.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->customer->createOrUpdate($request);
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
        $shops = Shop::all();

        $customer = Customer::findOrFail($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $viewData = [
            'shops' => $shops,
            'customer' => $customer,
            'admin' => $admin,
        ];

        return view('admin.customer.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->customer->createOrUpdate($request, $id);
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
        $customer = Customer::findOrFail($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $customer->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
