<div class="container-fluid">
    <form role="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <!-- form start -->
                    <div class="card-body">
                        <div class="form-group {{ $errors->first('name') ? 'has-error' : '' }} ">
                            <label for="inputEmail3" class="control-label default">Nội dung nhập hàng <sup class="text-danger">(*)</sup></label>
                            <div>
                                <input type="text" maxlength="100" class="form-control"  placeholder="Nội dung nhập hàng" name="name" value="{{ old('name', isset($warehouse) ? $warehouse->name : '') }}" required>
                                <span class="text-danger "><p class="mg-t-5">{{ $errors->first('name') }}</p></span>
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                            <label for="exampleInputEmail1">Ghi chú </label>
                            <textarea name="note" class="form-control" id="" cols="30" rows="10" style="height: 100px;">{{ old('note', isset($warehouse) ? $warehouse->note : '') }}</textarea>
                            @if($errors->has('note'))
                                <span class="help-block">{{$errors->first('note')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <label for="exampleInputEmail1">Dữ liệu nhập hàng <sup class="title-sup">(*)</sup></label>
                        <table class="table table-bordered" id = "table-import-product">
                            <thead>
                                <tr>
                                    <th class="text-center">Sản phẩm</th>
                                    <th class="text-center">Nhà cung cấp</th>
                                    <th class="text-center">Chi nhánh / Kho</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Đơn giá</th>
                                    <th class="text-center">Tổng tiền</th>
                                    <th width="2%" class="text-center">Xóa</th>
                                </tr>
                             </thead>
                            <tbody class="content-table">
                                @if (!isset($warehouse))
                                    <tr class="item-import">
                                        <td style="vertical-align: middle">
                                            <select name="products[]" id="" class="form-control product_id" required>
                                                <option value="">Chọn sản phẩm</option>
                                                @if($products)
                                                    @foreach($products as $key => $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <select name="suppliers[]" id="" class="form-control" required>
                                                <option value="">Chọn nhà cung cấp</option>
                                                @if($suppliers)
                                                    @foreach($suppliers as $key => $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td style="vertical-align: middle">
                                            <select name="branches[]" id="" class="form-control" required>
                                                <option value="">Chọn chi nhánh / kho</option>
                                                @if($branches)
                                                    @foreach($branches as $key => $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->branch_no }}-{{ $branch->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td style="vertical-align: middle; padding-right: 0px !important; width: 9%;">
                                            <input type="number" class="form-control total_number" name="total_numbers[]" value="" placeholder="Số lượng" min="1" required style="width: 90px" required>
                                        </td>
                                        <td style="vertical-align: middle; padding-right: 0px !important; width: 17%;">
                                            <input type="number" class="form-control price" name="prices[]" value="" placeholder="Đơn giá" min="1" required style="width: 180px" required>
                                        </td>
                                        <td style="vertical-align: middle"><span class="total_price"></span></td>
                                        <td style="vertical-align: middle"><a class="btn btn-xs btn-danger btn-remove-row mg-t-5"><i class="fas fa-trash" style="color: #fff"></i></a></td>
                                    </tr>
                                @else
                                    @if(isset($warehouse) && $warehouse->products->count() > 0)
                                        @foreach($warehouse->products as $item)
                                            <tr class="item-import">
                                                <td style="vertical-align: middle">
                                                    <select name="products[]" id="" class="form-control product_id" required>
                                                        <option value="">Chọn sản phẩm</option>
                                                        @if($products)
                                                            @foreach($products as $key => $product)
                                                                <option value="{{ $product->id }}" {{ $item->product_id == $product->id ? "selected" : '' }}>{{ $product->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <select name="suppliers[]" id="" class="form-control" required>
                                                        <option value="">Chọn nhà cung cấp</option>
                                                        @if($suppliers)
                                                            @foreach($suppliers as $key => $supplier)
                                                                <option value="{{ $supplier->id }}" {{ $item->supplier_id == $supplier->id ? "selected" : '' }}>{{ $supplier->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="vertical-align: middle">
                                                    <select name="branches[]" id="" class="form-control" required>
                                                        <option value="">Chọn chi nhánh / kho</option>
                                                        @if($branches)
                                                            @foreach($branches as $key => $branch)
                                                                <option value="{{ $branch->id }}" {{ $item->branch_id == $branch->id ? "selected" : '' }}>{{ $branch->branch_no }}-{{ $branch->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </td>
                                                <td style="vertical-align: middle; padding-right: 0px !important; width: 9%;">
                                                    <input type="number" class="form-control total_number" name="total_numbers[]" value="{{ $item->total_number }}" placeholder="Số lượng" min="1" required style="width: 90px" required>
                                                </td>
                                                <td style="vertical-align: middle; padding-right: 0px !important; width: 17%;">
                                                    <input type="number" class="form-control price" name="prices[]" value="{{ $item->price }}" placeholder="Đơn giá" min="1" required style="width: 180px" required>
                                                </td>
                                                <td style="vertical-align: middle"><span class="total_price">{{ number_format($item->total_price, 0,',','.') }} vnđ</span></td>
                                                <td style="vertical-align: middle"><a class="btn btn-xs btn-danger btn-remove-row mg-t-5"><i class="fas fa-trash" style="color: #fff"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endif
                            </tbody>
                        </table>
                        <div class="box-body text-right" style="margin-top: 15px">
                            <button type="button" class="btn btn-success mg-t-20 mg-b-15 btn-add-row-product" url="{{ route('warehouse.import.row') }}"><i class="fa fa-plus-circle"></i> Thêm sản phẩm</button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Xuất bản</h3>
                    </div>
                    <div class="card-body">
                        <div class="btn-set" style="text-align: right;">
                            <button type="submit" name="submit" class="btn btn-info">
                                <i class="fa fa-save"></i> Lưu dữ liệu
                            </button>
                            <a href="{{ route('warehouse.import.index') }}">
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
