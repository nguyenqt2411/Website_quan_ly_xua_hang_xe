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
        <select name="branches[]" id="" class="form-control branches branche-export" required>
            <option value="">Chọn chi nhánh / kho</option>
            @if($branches)
                @foreach($branches as $key => $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            @endif
        </select>
    </td>
    <td style="vertical-align: middle">
        <select name="customers[]" id="" class="form-control" required>
            <option value="">Chọn chi nhánh / kho</option>
            @if($branches)
                @foreach($branches as $key => $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            @endif
        </select>
    </td>
    <td style="vertical-align: middle; padding-right: 0px !important; width: 9%;">
        <input type="number" class="form-control total_number_export" name="total_numbers[]" value="" placeholder="Số lượng" min="1" required style="width: 90px">
    </td>
    <td style="vertical-align: middle; padding-right: 0px !important; width: 17%;">
        <input type="number" class="form-control price" name="prices[]" value="" placeholder="Đơn giá" min="1" required style="width: 180px">
    </td>
    <td style="vertical-align: middle"><span class="total_price"></span></td>
    <td style="vertical-align: middle"><a class="btn btn-xs btn-danger btn-remove-row mg-t-5"><i class="fas fa-trash" style="color: #fff"></i></a></td>
</tr>
