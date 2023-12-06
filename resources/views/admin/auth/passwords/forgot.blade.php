@extends('admin.layouts.main_auth')
@section('title')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Quên mật khẩu</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">

                <form action="" method="post">
                    <p class="login-box-msg">Nhập vào email tài khoản của bạn</p>
                    @if (session('danger'))
                        <p class="login-box-msg text-danger">{{ session('danger') }}</p>
                    @endif
                    @if (Session::has('success') && ($message = Session::get('success')))
                        <p class="login-box-msg text-success">{{ $message }}</p>
                    @endif
                    <div class="input-group mb-3">
                        <input name="email" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            @if ($errors->first('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
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