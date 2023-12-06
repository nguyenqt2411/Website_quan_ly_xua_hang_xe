@extends('admin.layouts.main')
@section('title', 'Chi nhánh \ Kho')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
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
                                            <select name="branch_id" id="" class="form-control branches branche-export" required>
                                                <option value="">Chọn chi nhánh / kho</option>
                                                @if($branchs)
                                                    @foreach($branchs as $key => $branch)
                                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
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
                </div>
            </section>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th width="4%" class=" text-center">STT</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Thuộc kho</th>
                                    <th>Hãng xe</th>
                                    <th>Dòng xe</th>
                                    <th>Đã nhập</th>
                                    <th>Đã xuất</th>
                                    <th>Tiền nhập</th>
                                    <th>Tiền xuất</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$products->isEmpty())
                                    @php $i = $products->firstItem(); @endphp
                                    @foreach($products as $product)
                                        <tr>
                                            <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                            <td style="vertical-align: middle">{{ $product->product->name }}</td>
                                            <td style="vertical-align: middle">{{ $product->branch->name }}</td>
                                            <td style="vertical-align: middle">{{ $product->product->trademark->name }}</td>
                                            <td style="vertical-align: middle">{{ $product->product->category->name }}</td>
                                            <td style="vertical-align: middle">
                                                @php
                                                    $total_number_import = \DB::table('product_warehousing')->where(['branch_id' => $product->branch_id, 'type' => 1, 'product_id' => $product->product_id])->sum('total_number');
                                                @endphp
                                                {{ $total_number_import }}
                                            </td>
                                            <td style="vertical-align: middle">
                                                @php
                                                    $total_number_export = \DB::table('product_warehousing')->whereIn('type', [2, 3])->where(['branch_id' => $product->branch_id, 'product_id' => $product->product_id])->sum('total_number');
                                                @endphp
                                                {{ $total_number_export }}
                                            </td>
                                            <td style="vertical-align: middle">
                                                @php
                                                    $total_price_import = \DB::table('product_warehousing')->where(['branch_id' => $product->branch_id, 'type' => 1, 'product_id' => $product->product_id])->sum('total_price');
                                                @endphp
                                                {{ number_format($total_price_import,0,',','.') }} vnđ
                                            </td>
                                            <td style="vertical-align: middle">
                                                @php
                                                    $total_price_export = \DB::table('product_warehousing')->whereIn('type', [2, 3])->where(['branch_id' => $product->branch_id, 'product_id' => $product->product_id])->sum('total_price');
                                                @endphp
                                                {{ number_format($total_price_export,0,',','.') }} vnđ
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
