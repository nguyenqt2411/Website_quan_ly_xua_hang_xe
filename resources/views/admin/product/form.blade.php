<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Tên xe <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" class="form-control"  placeholder="Tên xe" name="name" value="{{ old('name',isset($product) ? $product->name : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>
                        @if ($admin->hasRole(ADMINISTRATOR))
                            <div class="form-group" >
                                <label class="col-form-label default">Cửa hàng  <sup class="title-sup">(*)</sup></label>
                                <div >
                                    <select name="shop_id" class="form-control">
                                        <option value="">Chọn cửa hàng</option>
                                        @if($shops)
                                            @foreach($shops as $shop)
                                                <option  {{old('shop_id', isset($product->shop_id) ? $product->shop_id : '') == $shop->id ? 'selected=selected' : '' }}  value="{{$shop->id}}">{{$shop->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <span class="text-danger"><p class="mg-t-5">{{ $errors->first('shop_id') }}</p></span>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label>Hãng xe <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="trademark_id">
                                <option value="">Chọn hãng xe</option>
                                @foreach($trademarks as $trademark)
                                    <option
                                        {{old('trademark_id', isset($product->trademark_id ) ? $product->trademark_id  : '') == $trademark->id ? 'selected="selected"' : ''}}
                                        value="{{$trademark->id}}"
                                    >
                                        {{$trademark->name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('trademark_id') }}</p></span>
                        </div>
                        <div class="form-group">
                            <label>Dòng xe <sup class="text-danger">(*)</sup></label>
                            <select class="custom-select" name="category_id">
                                <option value="">Chọn dòng xe</option>
                                @foreach($categories as $category)
                                    <option
                                        {{old('category_id', isset($product->category_id ) ? $product->category_id  : '') == $category->id ? 'selected="selected"' : ''}}
                                        value="{{$category->id}}"
                                    >
                                        {{$category->name}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger"><p class="mg-t-5">{{ $errors->first('category_id') }}</p></span>
                        </div>
                        <div class="form-group {{ $errors->first('price') ? 'has-error' : '' }}">
                            <label for="inputEmail3" class="control-label default">Giá tiền <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="number" class="form-control"  placeholder="Giá tiền" name="price" value="{{ old('price',isset($product) ? $product->price : '') }}">
                                <span class="text-danger"><p class="mg-t-5">{{ $errors->first('price') }}</p></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="control-label default">Giới thiệu <sup class="title-sup">(*)</sup></label>
                            <div>
                                <textarea name="contents" id="contents" cols="30" rows="10" class="form-control" style="height: 225px;">{{ old('contents', isset($product) ? $product->contents : '') }}</textarea>
                                <script>
                                    ckeditor(contents);
                                </script>
                                @if ($errors->first('contents'))
                                    <span class="text-danger">{{ $errors->first('contents') }}</span>
                                @endif
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
                            <button type="reset" name="reset" value="reset" class="btn btn-danger">
                                <i class="fa fa-undo"></i> Reset
                            </button>
                        </div>
                    </div>
                    <div class="card-header">
                        <h3 class="card-title">Ảnh đại diện </h3>
                    </div>
                    <div class="card-body" style="min-height: 288px">
                        <div class="form-group">
                            <div class="input-group input-file" name="images">
                                <span class="input-group-btn">
                                    <button class="btn btn-default btn-choose" type="button">Chọn tệp</button>
                                </span>
                                <input type="text" class="form-control" placeholder='Không có tệp nào ...'/>
                                <span class="input-group-btn"></span>
                            </div>
                            <span class="text-danger "><p class="mg-t-5">{{ $errors->first('images') }}</p></span>
                            @if(isset($product) && !empty($product->image))
                                <img src="{{ asset(pare_url_file($product->image)) }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @else
                                <img src="{{ asset('admin/dist/img/no-image.png') }}" alt="" class="margin-auto-div img-rounded"  id="image_render" style="height: 150px; width:100%;">
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
</div>
