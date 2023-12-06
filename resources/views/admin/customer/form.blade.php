<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        @if ($admin->hasRole(ADMINISTRATOR))
                            <div class="form-group" >
                                <label class="col-form-label default">Cửa hàng  <sup class="title-sup">(*)</sup></label>
                                <div >
                                    <select name="shop_id" class="form-control">
                                        <option value="">Chọn cửa hàng</option>
                                        @if($shops)
                                            @foreach($shops as $shop)
                                                <option  {{old('shop_id', isset($customer->shop_id) ? $customer->shop_id : '') == $shop->id ? 'selected=selected' : '' }}  value="{{$shop->id}}">{{$shop->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('shop_id') }}</p></span>
                                </div>
                            </div>
                        @endif
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên khách hàng<sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Tên khách hàng" name="name" value="{{ old('name',isset($customer) ? $customer->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('email') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Email<sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="email" maxlength="100" class="form-control"  placeholder="Email" name="email" value="{{ old('email',isset($customer) ? $customer->email : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('email') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Số điện thoại<sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Số điện thoại" name="phone" value="{{ old('phone',isset($customer) ? $customer->phone : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('phone') }}</p></span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Địa chỉ </label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Địa chỉ" name="address" value="{{ old('address',isset($customer) ? $customer->address : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('address') }}</p></span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <a href="{{ route('customer.index') }}">
                                <button type="button" name="reset" value="reset" class="btn btn-danger">
                                    <i class="fa fa-undo"></i> Trở lại
                                </button>
                            </a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </form>
</div>
