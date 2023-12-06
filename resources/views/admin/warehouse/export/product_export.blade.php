@extends('admin.layouts.main')
@section('title', 'Sản phẩm đã nhập')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('warehouse.import.products') }}">Sản phẩm đã xuất</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h3 class="card-title">From tìm kiếm</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="product" class="form-control mg-r-15" placeholder="Tên sản phẩm ...">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="branch" class="form-control mg-r-15" placeholder="Tên chi nhánh hoặc kho ...">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Tìm kiếm </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th width="4%" class=" text-center">STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Cửa hàng</th>
                                    <th>Từ Chi nhánh / Kho</th>
                                    <th>Đến Chi nhánh / Kho</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Ngày nhập</th>
                                    <th class=" text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$products->isEmpty())
                                    @php $i = $products->firstItem(); @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                            <td style="vertical-align: middle">{{ isset($product->product) ? $product->product->name : ''  }}</td>
                                            <td style="vertical-align: middle">{{ isset($product->shop) ? $product->shop->name : '' }}</td>
                                            <td style="vertical-align: middle">{{ isset($product->branch) ? $product->branch->branch_no . '-' .$product->branch->name : '' }}</td>
                                            <td style="vertical-align: middle">{{ isset($product->branchExport) ? $product->branchExport->branch_no . '-' .$product->branchExport->name : '' }}</td>
                                            <td style="vertical-align: middle">{{ number_format($product->price,0,',','.') }} vnđ </td>
                                            <td style="vertical-align: middle">{{ $product->total_number }}</td>
                                            <td style="vertical-align: middle">{{ number_format($product->total_price,0,',','.') }} vnđ</td>
                                            <td style="vertical-align: middle">{{ formatDate($product->created_at) }} </td>
                                            <td class="text-center" style="vertical-align: middle">

                                                <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('warehouse.import.products.delete', $product->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if($products->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $products->appends($query = '')->links() }}
                                </div>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop
