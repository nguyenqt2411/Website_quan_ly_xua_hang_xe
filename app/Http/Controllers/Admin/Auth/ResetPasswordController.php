<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

use Illuminate\Http\Request;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\User;
use App\Models\PasswordResets;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */

    public function resetPassword(Request $request)
    {
        $data = PasswordResets::where('token', $request->token)->first();

        if (!$data) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        $dateNow = \Carbon\Carbon::now();
        $dateReset = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $data->time_reset);
        $minutes = $dateReset->diffInMinutes($dateNow);
        if ($minutes <= 0 || $data->flg_update == 1) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        return view('admin.auth.passwords.reset', compact('data'));
    }

    public function postResetPassword(ResetPasswordRequest $request, $token)
    {
        $data['password'] = bcrypt($request->password);

        $dataPass = PasswordResets::where('token', $token)->first();

        if (!$dataPass) {
            return redirect()->route('forgot.password')->with('danger', 'Đã quá hạn đổi mật khẩu. Bạn vui lòng gửi lại yêu cầu đổi mật khẩu');
        }

        try {
            $dataPass->flg_update = 1;
            $dataPass->save();
            User::where('email', $dataPass->email)->update($data);
            return redirect()->route('admin.login')->with('success', 'Đổi mật khẩu thành công.');

        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]'.$exception->getMessage());
        }
    }
}
