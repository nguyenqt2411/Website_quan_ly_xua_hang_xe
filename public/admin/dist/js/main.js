var config = {};

function formatNumber(nStr, decSeperate, groupSeperate) {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}

var init_function = {
    init: function () {
        let _this = this;
        _this.bs_input_file();
        _this.showImage();
        _this.preview();
    },
    bs_input_file: function () {
        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' id='input_img' style='visibility:hidden; height:0'>");
                    element.attr("name",$(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    },
    showImage: function() {
        $("#input_img").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_render').attr('src', e.target.result);
                    $('#image_render').css('height', '150px');
                    $('#image_render').css('display', 'block');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    },
    preview : function () {
        $(".btn-preview").click(function (event) {
            event.preventDefault();
            let url = $(this).attr('href');
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
            }).done(function (result) {
                if (result.html)
                {
                    $("#preview").html('').append(result.html);
                    $(".preview").modal('show');
                }
            })
        })
    }
}

$(function () {
    init_function.init();
    $('.btn-confirm-delete').confirm({
        title: 'Xóa dữ liệu',
        content: "Bạn có chăc chắn muốn xóa dữ liệu ?",
        icon: 'fa fa-warning',
        type: 'red',
        buttons: {
            confirm: {
                text: 'Xác nhận',
                btnClass: 'btn-blue',
                action: function () {
                    location.href = this.$target.attr('href');
                }
            },
            cancel: {
                text: 'Hủy',
                btnClass: 'btn-danger',
                action: function () {
                }
            }
        }
    });

    $("#check-all").click(function () {
        $('input.check_auto_clearing:checkbox').prop('checked', $(this).is(':checked'));
    });

    $('.btn-add-row-product').click(function () {
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
        }).done(function (result) {
            if (result.html)
            {
                $(".content-table").append(result.html);
            }
        })
    })

    $(document).on('click', '.btn-remove-row', function () {

        var number_item = $('.item-import').length;
        if (number_item == 1) {
            toastr.error('Cần ít nhất nhập 1 sản phẩm.', {timeOut: 3000});
            return false;
        }
        $(this).parent().parent().remove();


    })

    $(document).on('change', '.total_number', function () {
        var total_number = $(this).val();
        if (total_number <= 0) {
            $(this).val(1)
        }
        var price = $(this).parent().parent().find('.price').val();

        if (total_number == '' || price == '') {
            return false;
        }

        var total_price = total_number * price;

        var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

        $(this).parent().parent().find('.total_price').html(totalPrice);
    })

    $(document).on('change', '.price', function () {
        var price = $(this).val();

        if (price < 0) {
            $(this).val(0)
        }

        var total_number = $(this).parent().parent().find('.total_number').val();

        if (total_number == '' || price == '') {
            return false;
        }

        var total_price = total_number * price;

        var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

        $(this).parent().parent().find('.total_price').html(totalPrice);
    })

    $('.btn-add-row-export').click(function () {
        var url = $(this).attr('url');

        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
        }).done(function (result) {
            if (result.html)
            {
                $(".content-table").append(result.html);
            }
        })
    })


    $(document).on('change', '.product_id', function () {
        var product_id = $(this).val();
        var that__ = $(this);
        $(this).parent().parent().find('.total_number').val(0);

        if (product_id == '') {
            toastr.error('Vui lòng chọn sản phẩm cần xuất.', {timeOut: 3000});
            return false;
        }

        $.ajax({
            url: productShow,
            type: 'POST',
            dataType: 'json',
            data : {
                product_id : product_id
            }
        }).done(function (result) {

            if (result.code == 200)
            {
                console.log(result.product.price)
                that__.parent().parent().find('.price').val(result.product.price);
            }
        })

    })

    $(document).on('change', '.branche-export', function () {

        var branche_id = $(this).val();
        var __that = $(this);
        var total_number = $(this).parent().parent().find('.total_number_export').val();
        var product_id = $(this).parent().parent().find('.product_id').val();

        if (product_id == '') {
            toastr.error('Vui lòng chọn sản phẩm cần xuất.', {timeOut: 3000});
        }

        if (branche_id == '' || total_number == '') {
            if (branche_id == '') {
                toastr.error('Vui lòng chọn chi nhánh hoặc kho.', {timeOut: 3000});
            }

            if (total_number == '') {
                toastr.error('Vui lòng nhập vào số lượng.', {timeOut: 3000});
            }

            return false;
        }

        var price = $(this).parent().parent().find('.price').val();

        if (total_number == '' || price == '') {
            return false;
        }

        $.ajax({
            url: branchCheckQuantity,
            type: 'POST',
            dataType: 'json',
            data : {
                branche_id : branche_id,
                total_number : total_number,
            }
        }).done(function (result) {

            if (result.code == 200)
            {
                var total_price = total_number * price;

                var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

                __that.parent().parent().find('.total_price').html(totalPrice);


            } else {
                __that.parent().parent().find('.total_number_export').val(result.total_number);
                var total_price = result.total_number * price;

                var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

                __that.parent().parent().find('.total_price').html(totalPrice);
                toastr.error(result.message, {timeOut: 3000});
            }
        })

    })

    $(document).on('change', '.total_number_export', function () {

        var total_number = $(this).val();

        if (total_number < 0) {
            $(this).val(0);
        }
        var __that = $(this);
        var branche_id = $(this).parent().parent().find('.branche-export').val();
        var product_id = $(this).parent().parent().find('.product_id').val();

        if (product_id == '') {
            toastr.error('Vui lòng chọn sản phẩm cần xuất.', {timeOut: 3000});
        }

        if (branche_id == '' || total_number == '') {
            if (branche_id == '') {
                toastr.error('Vui lòng chọn chi nhánh hoặc kho.', {timeOut: 3000});
            }

            if (total_number == '') {
                toastr.error('Vui lòng nhập vào số lượng.', {timeOut: 3000});
            }

            return false;
        }

        var price = $(this).parent().parent().find('.price').val();

        if (total_number == '' || price == '') {
            return false;
        }



        $.ajax({
            url: branchCheckQuantity,
            type: 'POST',
            dataType: 'json',
            data : {
                branche_id : branche_id,
                total_number : total_number,
            }
        }).done(function (result) {

            if (result.code == 200)
            {
                var total_price = total_number * price;

                var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

                __that.parent().parent().find('.total_price').html(totalPrice);

            } else {
                __that.parent().parent().find('.total_number_export').val(result.total_number);
                var total_price = result.total_number * price;

                var totalPrice = formatNumber(total_price, '.', ',') + ' <sup>đ</sup>';

                __that.parent().parent().find('.total_price').html(totalPrice);
                toastr.error(result.message, {timeOut: 3000});
            }
        })

    })

})