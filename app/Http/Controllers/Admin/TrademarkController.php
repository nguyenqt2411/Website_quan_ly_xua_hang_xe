<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Trademark;
use App\Http\Requests\TrademarkRequest;

class TrademarkController extends Controller
{
    public $trademark;

    public function __construct(Trademark $trademark)
    {
        $this->trademark = $trademark;
        view()->share([
            'trademark_active' => 'active',
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
        $trademarks =  Trademark::select('*');

        $trademarks = $trademarks->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.trademark.index', compact('trademarks'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.trademark.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrademarkRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $this->trademark->createOrUpdate($request);
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
        $trademark = Trademark::findOrFail($id);

        if (!$trademark) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        return view('admin.trademark.edit', compact('trademark'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrademarkRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $this->trademark->createOrUpdate($request, $id);
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
        $trademark = Trademark::findOrFail($id);
        if (!$trademark) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        try {
            $trademark->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể xóa dữ liệu');
        }
    }
}
