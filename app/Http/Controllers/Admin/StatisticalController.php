<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\ProductWarehousing;
use Illuminate\Support\Facades\Auth;

class StatisticalController extends Controller
{
    public function __construct()
    {
        view()->share([
            'statistical_active' => 'active',
            'branchs' => Branch::all()
        ]);
    }
    //
    public function index(Request $request)
    {
        $products = ProductWarehousing::with(['product' => function ($query) {
            $query->with(['trademark', 'category']);
        }, 'branch'])->select('product_id', 'branch_id');

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

        if ($request->branch_id) {
            $products->where('branch_id', $request->branch_id);
        }

        $products = $products->groupBy('product_id', 'branch_id')->paginate(NUMBER_PAGINATION);

        return view('admin.statistical.index',compact('products'));
    }
}
