/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('.alert').delay(3000).slideUp();

//    $("#text").on("keypress", function () {
//
//        $(this).toggleClass('abc');
//    });

    //submit form delete
    $('.f_delete').submit(function () {
        return confirm('Bạn có muốn chắc chắn xóa?');
    });

    $('.b_delete').click(function () {
        $(this).parent().submit();
    });
    //end submmit form delete

    //CHECK ALL
    //Khởi tạo title nút check-all
    if ($('.check-all').prop('checked') == true) {
        $('.check-all').prop('title', 'Bỏ chọn tất cả');
    } else {
        $('.check-all').prop('title', 'Chọn tất cả');
    }

    $('.check-all').click(function () {
        if ($(this).prop('checked') == true) {
            $(this).parents('.list').find('.item').prop('checked', true);
            $(this).prop('title', 'Bỏ chọn tất cả');
            $('#ghichu').html('Đang chọn tất cả');
        } else {
            $(this).parents('.list').find('.item').prop('checked', false);
            $(this).prop('title', 'Chọn tất cả');
            $('#ghichu').html('Không chọn tất cả');
        }
    });

    $('.item').click(function () {
        var bien = true;
        var i = 0;
        $(this).parents('.list').find('.item').each(function () {
            if ($(this).prop('checked') == false) {
                bien = false;
                $('#bien').html($('#bien').html() + $(this).prop('id') + ' ' + i + ' ' + bien + '<br>');
                i++;
            }
        });

        if (bien == true) {
            $(this).parents('.list').find('.check-all').prop({'checked': true, 'title': 'Bỏ chọn tất cả'});
            $('#ghichu').html('Đang chọn tất cả ' + bien);
        } else {
            $(this).parents('.list').find('.check-all').prop({'checked': false, 'title': 'Chọn tất cả'});
            $('#ghichu').html('Không chọn tất cả ' + bien);
        }
    });
    //END CHECK ALL
});
