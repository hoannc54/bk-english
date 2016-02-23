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


    $('.f_delete').submit(function () {
        return confirm('Bạn có muốn chắc chắn xóa?');
    });

    $('.b_delete').click(function () {
        $(this).parent().submit();
    });
});
