<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Shop;
use App\Models\Trademark;
use App\Models\Category;


class ProductController extends Controller
{
    public $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
        view()->share([
            'product_active' => 'active',
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
        $products = Product::with(['shop', 'trademark', 'category']);

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $products->where('shop_id', $admin->shop_id);
        }

        if ($request->name) {
            $products->where('name', '%'.$request->name.'%', $request->name);
        }

        $products = $products->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.product.index', compact('products'));
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
        $shops = Shop::all();
        $trademarks = Trademark::select('*');
        $categories = Category::select('*');

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $trademarks->where('shop_id', $admin->shop_id);
            $categories->where('shop_id', $admin->shop_id);
        }

        $trademarks = $trademarks->get();
        $categories = $categories->get();

        $viewData = [
            'shops' => $shops,
            'trademarks' => $trademarks,
            'categories' => $categories,
            'admin' => $admin,
        ];

        return view('admin.product.create', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->product->createOrUpdate($request);
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
        $trademarks = Trademark::select('*');
        $categories = Category::select('*');

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $trademarks->where('shop_id', $admin->shop_id);
            $categories->where('shop_id', $admin->shop_id);
        }

        $trademarks = $trademarks->get();
        $categories = $categories->get();

        $product = Product::findOrFail($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $viewData = [
            'shops' => $shops,
            'trademarks' => $trademarks,
            'categories' => $categories,
            'product' => $product,
            'admin' => $admin,
        ];

        return view('admin.product.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->product->createOrUpdate($request, $id);
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
        $product = Product::findOrFail($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $product->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }

    public function show(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->product_id;
            $product = Product::findOrFail($id);

            if (!$product) {
                return response([
                    'code' => 404,
                    'message' => 'Sản phẩm không tồn tại'
                ]);
            }

            return response([
                'code' => 200,
                'product' => $product
            ]);
        }

        return response([
            'code' => 404,
            'message' => 'Sản phẩm không tồn tại'
        ]);
    }
}
