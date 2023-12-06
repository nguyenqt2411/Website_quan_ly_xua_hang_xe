@extends('admin.layouts.main')
@section('title', 'Quản trị website')
@section('style-css')
    <!-- fullCalendar -->
    <style>
        .highcharts-background {
            fill: rgb(255 255 255) !important;
        }
    </style>
@stop
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản trị website</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="#">Quản trị website</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Biểu đồ thống kê</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row" style="margin-bottom: 15px;">
                                        <div class="col-sm-12">
                                            <form action="">
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-4">
                                                        <?php $month = date('m'); ?>
                                                        <div class="form-group">
                                                            <select name="select_month" id="" class="form-control">
                                                                <option value="">Chọn tháng</option>
                                                                @for($i = 1; $i < 13; $i++)
                                                                    @if(Request::get('select_month'))
                                                                        <option {{ Request::get('select_month') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                                    @else
                                                                        <option {{ $month == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-4">
                                                        <?php $year = date('Y'); ?>
                                                        <div class="form-group">
                                                            <select name="select_year" id="" class="form-control">
                                                                <option value="">Chọn năm</option>
                                                                @for($i = $year - 15; $i <= $year + 5; $i++)
                                                                    @if(Request::get('select_year'))
                                                                        <option {{ Request::get('select_year') == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                                    @else
                                                                        <option {{ $year == $i ? "selected='selected'" : '' }} value="{{$i}}">{{$i}}</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-3">
                                                        <div class="input-group-append">
                                                            <button type="submit" class="btn btn-success " style="margin-right: 10px"><i class="fas fa-search"></i> Lọc dữ liệu </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                            <figure class="highcharts-figure">
                                                <div id="container2" data-list-day="{{ $listDay }}" data-money={{ $arrRevenueTransactionMonth }}>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.container-fluid -->
                    </section>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
@section('script')
    <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- <script src="https://code.highcharts.com/modules/exporting.js"></script> --}}
    {{-- <script src="https://code.highcharts.com/modules/export-data.js"></script> --}}
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript">
        let listday = $("#container2").attr("data-list-day");
        listday = JSON.parse(listday);

        let listMoneyMonth = $("#container2").attr('data-money');
        listMoneyMonth = JSON.parse(listMoneyMonth);


        Highcharts.chart('container2', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'Biểu đồ doanh thu các ngày trong tháng'
            },
            subtitle: {
                text: 'Danh sách ngày'
            },
            xAxis: {
                categories: listday
            },
            yAxis: {
                title: {
                    text: 'Doanh thu'
                },
                labels: {
                    formatter: function () {
                        return this.value + 'VNĐ';
                    }
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#ffffff',
                        lineWidth: 1
                    }
                }
            },
            series: [
                {
                    name: 'Hoàn tất giao dịch',
                    marker: {
                        symbol: ''
                    },
                    data: listMoneyMonth
                }
            ]
        });
    </script>
@stop