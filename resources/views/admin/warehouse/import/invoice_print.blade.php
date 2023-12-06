<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin| Invoice Print</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{!! asset('admin/plugins/fontawesome-free/css/all.min.css') !!}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{!! asset('admin/dist/css/adminlte.min.css') !!}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{!! asset('admin/dist/css/style.css') !!}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body>
<div class="container">
    <section class="col-12" style="margin-top: 15px">
        <!-- /.row -->
        <h3 class="text-center" style="margin-top: 30px">CHI TIẾT PHIẾU NHẬP HÀNG</h3>

        <div class="row invoice-info">
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-sm-12 invoice-col">
                <h4 style="text-transform: uppercase">Thông tin nhập hàng</h4>
                <address>
                    <b>Mã nhập kho: {{ isset($warehouse) ? $warehouse->warehouse_no : '' }}</b><br>
                    <span>Nội dung nhập :</span> {{ isset($warehouse) ? $warehouse->name : '' }}<br>
                    <span>Người nhập : {{ isset($warehouse->user) ? $warehouse->user->name : '' }}</span><br>
                    <span>Ghi chú : {{ isset($warehouse->note) ? $warehouse->note : '' }}</span>
                </address>
            </div>
            <div class="col-12 table-responsive" style="margin-top: 30px">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th class="text-center">Nhà cung cấp</th>
                        <th>Cửa hàng</th>
                        <th>Chi nhánh / Kho</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if (isset($warehouse->products))
                            <?php $total = 0; ?>
                            @foreach($warehouse->products as $key => $product)
                                <tr>
                                    <td class=" text-center" style="vertical-align: middle">{{ $key + 1 }}</td>
                                    <td style="vertical-align: middle">{{ isset($product->product) ? $product->product->name : ''  }}</td>
                                    <td style="vertical-align: middle">{{ isset($product->supplier) ? $product->supplier->name : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($product->shop) ? $product->shop->name : '' }}</td>
                                    <td style="vertical-align: middle">{{ isset($product->branch) ? $product->branch->name : '' }}</td>
                                    <td style="vertical-align: middle">{{ number_format($product->price,0,',','.') }} vnđ </td>
                                    <td style="vertical-align: middle">{{ $product->total_number }}</td>
                                    <td style="vertical-align: middle">{{ number_format($product->total_price, 0,',','.') }} vnđ</td>
                                </tr>
                                <?php $total = $product->total_price + $total; ?>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="5" class="text-center"> <b>Tổng tiền:</b></td>
                            <td colspan="3" class="text-center"> <b>{{ $total > 0 ? number_format($total, 0,',','.') : 0 }} vnđ</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin-top: 30px">
            <div class="col-6 text-center">
                <p><b>Người xuất hóa đơn</b></p>
                <p style="font-size: 12px;">( Ký ghi rõ họ tên )</p>
            </div>
            <div class="col-6 text-center">
                <p><b>Người nhận</b></p>
                <p style="font-size: 12px;">( Ký ghi rõ họ tên )</p>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-12">
                <button type="button" class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Print </button>
            </div>
        </div>
    </section>
</div>

</body>
</html>
