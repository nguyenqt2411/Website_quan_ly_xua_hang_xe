@extends('admin.layouts.main')
@section('title', 'Hãng xe')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('warehouse.export.index') }}">Xuất kho</a></li>
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
                                    <input type="text" name="warehouse_no" class="form-control mg-r-15" placeholder="Tìm mã xuất hàng ...">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control mg-r-15" placeholder="Nội dung xuất hàng ...">
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
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('warehouse.export.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                <tr>
                                    <th width="4%" class=" text-center">STT</th>
                                    <th>Mã xuất kho</th>
                                    <th>Nội dung xuất</th>
                                    <th>Người xuất</th>
                                    <th>Ghi chú</th>
                                    <th>Ngày tạo</th>
                                    <th class=" text-center">Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (!$warehouses->isEmpty())
                                    @php $i = $warehouses->firstItem(); @endphp
                                    @foreach($warehouses as $warehouse)
                                        <tr>
                                            <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                            <td style="vertical-align: middle">{{ $warehouse->warehouse_no }}</td>
                                            <td style="vertical-align: middle">{{ $warehouse->name }}</td>
                                            <td style="vertical-align: middle">{{ isset($warehouse->user) ? $warehouse->user->name : '' }}</td>
                                            <td style="vertical-align: middle">{{ $warehouse->note }}</td>
                                            <td style="vertical-align: middle">{{ formatDate($warehouse->created_at) }}</td>
                                            <td class="text-center" style="vertical-align: middle">
                                                <a class="btn btn-primary btn-sm" href="{{ route('warehouse.export.update', $warehouse->id) }}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('warehouse.export.delete', $warehouse->id) }}">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="{{ route('warehouse.export.invoice', $warehouse->id) }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                            @if($warehouses->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $warehouses->appends($query = '')->links() }}
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
