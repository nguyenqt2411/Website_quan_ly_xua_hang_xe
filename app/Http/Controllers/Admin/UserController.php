<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Shop;

class UserController extends Controller
{
    public function __construct(Role $role)
    {
        view()->share([
            'user_active' => 'active',
            'roles' => $role->all(),
            'status' => User::STATUS,
            'genders' => User::GENDERS,
            'classStatus' => User::CLASS_STATUS
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
        $users = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            },
            'shop'
        ]);
        if ($request->name) {
            $keyWord = $request->name;
            $users->where('name', 'like', '%'.$keyWord.'%');
            $users->orWhere('phone', $keyWord);
            if (strpos($keyWord, '@') && strpos($keyWord, '.')) {
                $users->orWhere('email', $keyWord);
            }
        }
        if ($request->status) {
            $users->where('status', $request->status);
        }
        $admin = Auth::user();

        if (!$admin->hasRole(ADMINISTRATOR)) {
            $users->where('shop_id', $admin->id);
        }

        $users = $users->orderBy('id', 'DESC')->paginate(NUMBER_PAGINATION);

        return view('admin.user.index', compact('users'));
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
        return view('admin.user.create', compact('admin', 'shops'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        \DB::beginTransaction();
        try {

            $data = $request->except('submit', 'password', 'reset', '_token', 'images', 'role');

            $data['password'] = bcrypt($request->password);

            $admin = Auth::user();
            if (empty($request->shop_id)) {
                $data['shop_id'] = $admin->id;
            }

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $data['avatar'] = $image['name'];
            }

            $userId = User::insertGetId($data);

            if ($userId) {
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $userId]);
                $userNo = genderCode('ND', $userId);
                User::find($userId)->update(['user_no' => $userNo]);
            }

            \DB::commit();
            return redirect()->back()->with('success','Thêm mới thành công');
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
        $user = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            }
        ])->find($id);
        $listRoleUser = \DB::table('role_user')->where('user_id', $id)->first();
        if(!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }
        $admin = Auth::user();
        $shops = Shop::all();

        $viewData = [
            'user' => $user,
            'listRoleUser' => $listRoleUser,
            'admin' => $admin,
            'shops' => $shops
        ];
        return view('admin.user.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $user = User::find($id);

            $data = $request->except('submit', 'password', 'reset', '_token', 'images', 'role');

            if ($request->password) {
                $data['password'] = bcrypt($request->password);
            }

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $data['avatar'] = $image['name'];
            }

            $admin = Auth::user();
            if (empty($request->shop_id)) {
                $data['shop_id'] = $admin->id;
            }

            if ($user->update($data)) {
                \DB::table('role_user')->where('user_id', $id)->delete();
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $user->id]);
            }

            \DB::commit();
            return redirect()->back()->with('success','Chỉnh sửa thành công');
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
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        \DB::beginTransaction();
        try {
            $user->delete();
            \DB::commit();
            return redirect()->back()->with('success','Đã xóa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return
     */
    public function updateStatus(Request $request, $id)
    {
        if($request->ajax()) {
            $user = User::find($id);

            if (!$user) {
                return response([
                    'status_code' => 404,
                    'html' => '',
                    'message' => 'Đã xảy ra lỗi vui lòng thử lại sau'
                ]);
            }
            if ($user->status == 1) {
                $status = 2;
            } else {
                $status = 1;
            }
            $data = [
                'status' => $status
            ];

            \DB::beginTransaction();
            try {
                $user->update($data);
                \DB::commit();

                return response([
                    'status_code' => 200,
                    'update_id' => $user->id,
                    'status' => [
                        'class_status' => User::CLASS_STATUS[$status],
                        'text_status' => User::STATUS[$status],
                    ]
                ]);

            } catch (\Exception $exception) {
                \DB::rollBack();
                return response([
                    'status_code' => 404,
                    'html' => '',
                    'message' => 'Đã xảy ra lỗi vui lòng thử lại sau'
                ]);
            }
        }

        return response([
            'status_code' => 404,
            'html' => '',
            'message' => 'Đã xảy ra lỗi vui lòng thử lại sau'
        ]);
    }
}
