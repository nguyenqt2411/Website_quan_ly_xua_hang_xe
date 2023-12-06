<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Tên<sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên" name="name" value="{{ old('name',isset($branch) ? $branch->name : '') }}">
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Địa chỉ </label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Địa chỉ" name="address" value="{{ old('address',isset($branch) ? $branch->address : '') }}">
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
                            <a href="{{ route('branch.index') }}">
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
