@extends('admin.layouts.main')
@section('title', 'Khách hàng')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i class="nav-icon fas fa fa-home"></i> Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.index') }}">Khách hàng</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <div class="btn-group">
                                    <a href="{{ route('customer.create') }}"><button type="button" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Tạo mới</button></a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th width="4%" class=" text-center">STT</th>
                                        <th>Mã khách hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Cửa hàng</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th class=" text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$customers->isEmpty())
                                        @php $i = $customers->firstItem(); @endphp
                                        @foreach($customers as $customer)
                                            <tr>
                                                <td class=" text-center" style="vertical-align: middle">{{ $i }}</td>
                                                <td style="vertical-align: middle">{{ $customer->customer_no }}</td>
                                                <td style="vertical-align: middle">{{ $customer->name }}</td>
                                                <td style="vertical-align: middle">{{ isset($customer->shop) ? $customer->shop->name : '' }}</td>
                                                <td style="vertical-align: middle">{{ $customer->email }}</td>
                                                <td style="vertical-align: middle">{{ $customer->phone }}</td>
                                                <td style="vertical-align: middle">{{ $customer->address }}</td>
                                                <td class="text-center" style="vertical-align: middle">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('customer.update', $customer->id) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm btn-delete btn-confirm-delete" href="{{ route('customer.delete', $customer->id) }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $i++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if($customers->hasPages())
                                <div class="pagination float-right margin-20">
                                    {{ $customers->appends($query = '')->links() }}
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
