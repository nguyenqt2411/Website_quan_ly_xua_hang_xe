<style>
    table > thead > tr {
        border: 1px solid;
    }
    table > thead > tr > th {
        border: 1px solid;
    }
    table > tbody > tr {
        border: 1px solid;
    }
    table > tbody > tr > td {
        border: 1px solid;
    }
</style>
<div style="width: 100%;max-width: 800px;margin:0 auto">
    <div style="background: white;padding: 15px;border:1px solid #dedede;">
        <h2 style="margin:10px 0;border-bottom: 1px solid #dedede;padding-bottom: 10px;">Cám ơn bạn đã mua xe tại cửa hàng của chúng tôi</h2>
        <div>
            <h2>Xin chào : {{ isset($data->selling->name) ? $data->selling->name : '' }}<b></b></h2>
        </div>
        <div>
            <p>Số điện thoại : {{ isset($data->selling->phone) ? $data->selling->phone : '' }} </p>
            <p>Email  : {{ isset($data->selling->email) ? $data->selling->email : '' }} </p>
            <p>Địa chỉ : {{ isset($data->selling->address) ? $data->selling->address : '' }}</p>

            <table class="table table-striped" style="width: 100%; border: 1px solid; border-collapse: collapse;">
                <thead>
                <tr style="border: 1px solid;">
                    <th style="border: 1px solid;">STT</th>
                    <th style="border: 1px solid;">Sản phẩm</th>
                    <th style="border: 1px solid;">Cửa hàng</th>
                    <th style="border: 1px solid;">Từ Chi nhánh / Kho</th>
                    <th style="border: 1px solid;">Giá</th>
                    <th style="border: 1px solid;">Số lượng</th>
                    <th style="border: 1px solid;">Tổng tiền</th>
                </tr>
                </thead>
                <tbody>
                @if (isset($data->products))
                    <?php $total = 0; ?>
                    @foreach($data->products as $key => $product)
                        <tr style="border: 1px solid;">
                            <td class=" text-center" style="vertical-align: middle">{{ $key + 1 }}</td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ isset($product->product) ? $product->product->name : ''  }}</td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ isset($product->shop) ? $product->shop->name : '' }}</td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ isset($product->branch) ? $product->branch->name : '' }}</td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ number_format($product->price,0,',','.') }} vnđ </td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ $product->total_number }}</td>
                            <td style="vertical-align: middle; border: 1px solid;">{{ number_format($product->total_price, 0,',','.') }} vnđ</td>
                        </tr>
                        <?php $total = $product->total_price + $total; ?>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-center"> <b>Tổng tiền:</b></td>
                        <td colspan="3" class="text-center"> <b>{{ $total > 0 ? number_format($total, 0,',','.') : 0 }} vnđ</b></td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    <div style="background: #f4f5f5;box-sizing: border-box;padding: 15px">
        <p style="margin:2px 0;color: #333">Email : </p>
        <p style="margin:2px 0;color: #333">Phone : </p>
        <p style="margin:2px 0;color: #333">Face : <a href=""></a></p>
    </div>
</div>