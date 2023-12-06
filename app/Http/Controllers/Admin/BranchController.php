<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ProductWarehousing;
use App\Http\Requests\BranchRequest;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{

    public $branch;
    public function __construct(Branch $branch)
    {
        $this->branch = $branch;
        view()->share([
            'branch_active' => 'active',
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
        $branchs =  Branch::with(['imports', 'exports']);

        if ($request->branch_no) {
            $branchs->where('branch_no', $request->branch_no);
        }

        if ($request->name) {
            $branchs->where('name', 'like', '%'. $request->name . '%');
        }

        $branchs = $branchs->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.branch.index', compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.branch.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BranchRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->branch->createOrUpdate($request);
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
        $branch = Branch::findOrFail($id);

        if (!$branch) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.branch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->branch->createOrUpdate($request, $id);
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
        $branch = Branch::findOrFail($id);
        if (!$branch) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $branch->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function checkQuantity(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->branche_id;
            $total_number = $request->total_number;

            if (empty($id)) {
                return response([
                    'code' => 404,
                    'message' => 'Kho chi nhánh không tồn tại',
                ]);
            }

            $branch = Branch::with(['imports', 'exports'])->find($id);

            $numberProduct = $branch->imports->count() - $branch->exports->count();

            if ($numberProduct < $total_number) {
                return response([
                    'code' => 404,
                    'message' => 'Số lượng sản phẩm trong kho không đủ để đặt hàng số lượng còn lại là : '. $numberProduct,
                    'total_number' => $numberProduct > 0 ? $numberProduct : 0,
                ]);
            } else {
                return response([
                    'code' => 200,
                    'message' => 'Số lượng trong kho còn đủ',
                ]);
            }
        }
    }

    public function products(Request $request, $id)
    {

        $branch = Branch::findOrFail($id);

        if (!$branch) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $products = ProductWarehousing::with(['product' => function ($query) {
            $query->with(['trademark', 'category']);
        }])->select('product_id');

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

        $products = $products->where('branch_id', $id)->groupBy('product_id')->paginate(NUMBER_PAGINATION);
        return view('admin.branch.product', compact('branch', 'products'));
    }
}
