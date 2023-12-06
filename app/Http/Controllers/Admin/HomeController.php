<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductWarehousing;
use App\Helpers\Date;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([
            'home_active' => 'active',

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
        $month = $request->select_month ? $request->select_month : date('m');
        $year = $request->select_year ? $request->select_year : date('Y');
        $listDay = Date::getListDayInMonth($month, $year);


        //Doanh thu theo tháng ứng với trạng thái đã xử lý
        $revenueTransactionMonth = ProductWarehousing::where('type',3);
        $admin = Auth::user();

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $revenueTransactionMonth->where('shop_id', $admin->shop_id);
        }
        $revenueTransactionMonth = $revenueTransactionMonth->whereMonth('created_at', $month)->whereYear('created_at', $year)
            ->select(\DB::raw('sum(total_price) as totalMoney'), \DB::raw('DATE(created_at) day'))
            ->groupBy('day')
            ->get()->toArray();

        $arrRevenueTransactionMonth = [];
        foreach($listDay as $day) {
            $total = 0;
            foreach ($revenueTransactionMonth as $key => $revenue) {
                if ($revenue['day'] ==  $day) {
                    $total = $revenue['totalMoney'];
                    break;
                }
            }

            $arrRevenueTransactionMonth[] = (int)$total;
        }

        $viewData = [
            'listDay'                    => json_encode($listDay),
            'arrRevenueTransactionMonth' => json_encode($arrRevenueTransactionMonth),
        ];

        return view('admin.home.index', $viewData);
    }
}
