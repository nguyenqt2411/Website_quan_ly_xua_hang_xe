@extends('admin.layouts.main')
@section('title', 'Chi nhánh \ Kho')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('branch.index') }}">Chi nhánh \ Kho</a></li>
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
                                    <input type="text" name="branch_no" class="form-control mg-r-15" placeholder="Tìm mã chi nhánh \ kho ...">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control mg-r-15" placeholder="Tên kho ...">
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
                                    <a href="{{ route('branch.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Mã chi nhánh</th>
                                        <th>Tên</th>
                                        <th>Xe đã nhập</th>
                                        <th>Xe đã xuất</th>
                                        <th>Tồn kho</th>
                                        <th>Địa chỉ</th>
                                        <th>Cửa hàng</th>
                                        <th class=" text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$branchs->isEmpty())
                                        @php $i = $branchs->firstItem(); @endphp
                                        @foreach($branchs as $branch)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                                <td style="vertical-align: middle">{{ $branch->branch_no }}</td>
                                                <td style="vertical-align: middle">{{ $branch->name }}</td>
                                                <td style="vertical-align: middle">
                                                    {{ $branch->imports->sum('total_number') }}
                                                </td>
                                                <td style="vertical-align: middle">
                                                    {{ $branch->exports->sum('total_number') }}
                                                </td>
                                                <td style="vertical-align: middle">
                                                    @php $numberProduct = $branch->imports->sum('total_number') - $branch->exports->sum('total_number') @endphp
                                                    {{ $numberProduct <= 0 ? 'Hết Hàng' : $numberProduct }}
                                                </td>
                                                <td style="vertical-align: middle">{{ $branch->address }}</td>
                                                <td style="vertical-align: middle">{{ isset($branch->shop) ? $branch->shop->name : '' }}</td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('branch.update', $branch->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('branch.delete', $branch->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('branch.products', $branch->id) }}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($branchs->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $branchs->appends($query = '')->links() }}
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
