@extends('admin.layouts.main_auth')
@section('title')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Đặt lại mật khẩu </b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form action="" method="post">
                    <p class="login-box-msg">Nhập vào mật khẩu mới của bạn.</p>
                    @if (session('danger'))
                        <p class="login-box-msg text-danger">{{ session('danger') }}</p>
                    @endif
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password" >
                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('password') }}</p></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="r_password" >
                        <span class="text-danger"><p class="mg-t-5">{{ $errors->first('r_password') }}</p></span>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block col-6" style="margin: auto;">Gửi</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <p><a href="{{ route('admin.login') }}">Đăng nhập </a> </p>

                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@stop