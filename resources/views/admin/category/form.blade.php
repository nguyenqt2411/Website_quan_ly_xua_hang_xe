<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group {{ $errors->first('trademark_id') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Hãng xe <sup class="text-danger">(*)</sup></label>
                                <div>
                                    <select class="custom-select" name="trademark_id">
                                        <option value="">Chọn hãng xe</option>
                                        @foreach($trademarks as $trademark)
                                            <option
                                                    {{old('trademark_id', isset($category->trademark_id) ? $category->trademark_id : '') == $trademark->id ? 'selected="selected"' : ''}}
                                                    value="{{$trademark->id}}"
                                            >
                                                {{$trademark->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('trademark_id') }}</p></span>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} col-md-6">
                                <label for="inputEmail3" class="control-label default">Tên dòng xe<sup class="text-danger">(*)</sup></label>
                                <div>
                                    <input type="text" maxlength="100" class="form-control"  placeholder="Tên dòng xe" name="name" value="{{ old('name',isset($category) ? $category->name : '') }}">
                                    <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                                </div>
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
                            <a href="{{ route('category.index') }}">
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
