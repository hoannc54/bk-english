/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {

    var table = $('#table').DataTable({
        dom: 'Bfrtip',
        "processing": true,
//        "stateSave": true,
//        serverSide: true,
        "ajax": typeof listAjax !== "undefined" ? listAjax : "",
        "columns": [
            {
                "orderable": false,
                "className": "center",
//                "data": function (source, type, val) {
//                    if (source.examples) {
//                        return '<i class="has-chil fa fa-plus-square"></i>';
//                    } else {
//                        return '<i class="has-chil fa fa-plus-square"></i>';
//                    }
//                },
                "defaultContent": '<i class="has-chil fa fa-plus-square"></i>'
            },
            {"data": "word"},
            {
                "data": "spell",
                "className": "spell center"
            },
            {"data": "type"},
            {"data": "mean"},
//            {"data": "example"},
//            {"data": "mean_ex"},
//            {"data": "parent_word"},
            {
                "orderable": false,
                "searchable": false,
                "className": "word_edit center",
                "defaultContent": '<i class="fa fa-edit"></i>'
            },
            {
                "orderable": false,
                "searchable": false,
                "className": "word_delete center",
                "defaultContent": '<i class="fa fa-close"></i>'
            },
            {
                "orderable": false,
                "searchable": false,
                "className": "select-checkbox center",
                "defaultContent": " "
            }
        ],
        "order": [[1, 'asc']],
        select: {
            style: 'multi',
            selector: 'td:last-child'
        },
        buttons: [
            {
                text: 'Chọn trang hiện tại',
                action: function () {
                    table.rows().deselect();
                    table.rows({page: 'current'}).select();
                }
            },
            {
                text: 'Chọn tất cả',
                action: function () {
                    table.rows().select();
                }
            },
            {
                text: 'Đảo lựa chọn PAGE',
                action: function () {
                    de = table.rows({selected: true, page: 'current'});
                    se = table.rows({selected: false, page: 'current'});
                    se.select();
                    de.deselect();
                }
//                enabled: false
            },
            {
                text: 'Đảo lựa chọn',
                action: function () {
                    de = table.rows({selected: true});
                    se = table.rows({selected: false});
                    se.select();
                    de.deselect();
                }
//                enabled: false
            },
            {
                text: 'Bỏ chọn tất cả',
                action: function () {
                    table.rows().deselect();
                },
                enabled: false
            },
            {
                text: 'Xóa mục đã chọn',
                action: function () {
                    ids = '';
                    //gộp id các mục đã chọn thành 1 chuỗi, mỗi id cách nhau bởi dấu cách
                    table.rows({selected: true}).data().each(function (group, i) {
                        ids += ' ' + group.id;
                    });
//                    alert(ids);
                    delete_id(ids);
                },
                enabled: false
            }
        ]
    });

    //nếu không có mục nào được chọn thì disable nút không cần thiết
    function en_dis_button() {
        var selectedRows = table.rows({selected: true}).count();

//        table.button(0).enable();
//        alert(selectedRows);
        if (selectedRows > 0) {
            table.button(4).enable();
            table.button(5).enable();
        } else {
            table.button(4).disable();
            table.button(5).disable();
        }
    }

    table
            .on('select', function () {
                en_dis_button();
            })
            .on('deselect', function () {
                en_dis_button();
            })
            .on('processing.dt', function () {
                en_dis_button();
            });

    function delete_id(id) {
        //tạo dữ liệu gửi đi
        var request = {ids: id, action: "delete", _token: typeof token !== "undefined" ? token : ""};
        //hiện thông báo chắc chắn xóa
        var r = confirm("Bạn có chắc chắn xóa?");
        if (r) {
            //Nếu người dùng bấm OK thì gửi dữ liệu id các bản ghi cần xóa về server
            //để thực hiện xóa
            $.post(typeof postDel !== "undefined" ? postDel : "", request,
                    function (data, status) {
                        table.ajax.reload(null, false);
                        result = JSON.parse(data);
                        //kết quả trả về, đưa ra thông báo tương ứng
                        switch (result.status) {
                            case 'success':
                                message('#message', 'alert alert-success', result.message);
                                break;
                            case 'danger':
                                message('#message', 'alert alert-danger', result.message);
                                break;
                            default :
                                message('#message', 'alert alert-danger', 'Lỗi không xác định.');
                                break;
                        }
                    });
        }
    }

    $('#table tbody').on('click', 'td.spell', function () {
//        alert(1111);
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var rdata = row.data();
        playSound(rdata.sound);
//        alert(rdata.sound);
    });

    //click hiển thị danh sách ví dụ
    $('#table tbody').on('click', 'i.has-chil', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

//Tạo bảng các câu ví dụ
//        var examples = row.data().examples;
//        var data_chil = '<table class="table_ex"><tr><td colspan="3">Ví dụ:</td></tr>';
//        if (examples) {
//            for (var i = 0; i < examples.length; i++) {
//                data_chil += '<tr class="info"><td>' + (i + 1) + '.</td><td>' + examples[i].example + '</td>\n\
//                            <td>' + examples[i].mean + '</td></tr>';
//            }
//        }
//        data_chil += '</table>';

        var data_chil = '<table class="table_ex"><tr><td colspan="2">Ví dụ:</td></tr>';
        data_chil += '<tr class="info">';
        data_chil += '<td>' + row.data().example + '</td>';
        data_chil += '<td>' + row.data().mean_ex + '</td>';
        data_chil += '</tr>';
        data_chil += '</table>';
//Tạo thẻ hiện ảnh minh họa
        data_chil += '<img src="' + row.data().image + '" class="img_mh"/>';


        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            $(this).addClass('fa-plus-square');
            $(this).removeClass('fa-minus-square');
        } else {
            // Open this row
            row.child(data_chil).show();
            $(this).addClass('fa-minus-square');
            $(this).removeClass('fa-plus-square');
        }
    });

    //click sửa từ
    $('#table tbody').on('click', 'td.word_edit', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var rdata = row.data();
        var wtype = rdata.type;

        //Thêm dữ liệu mặc định vào modal
        $('#id').val(rdata.id);
        $('#word').val(rdata.word);
        $('#spell').val(rdata.spell);
        $('#mean').val(rdata.mean);
        $('#example').val(rdata.example);
        $('#mean_ex').val(rdata.mean_ex);
        $('#sound').val('');
        $('#img').val('');
        $('#logo-img').attr('src', rdata.image);


        if (wtype.search('N') >= 0) {
            $('#type_n').prop({'checked': true});
        } else {
            $('#type_n').prop({'checked': false});
        }
        if (wtype.search('V') >= 0) {
            $('#type_v').prop({'checked': true});
        } else {
            $('#type_v').prop({'checked': false});
        }
        if (wtype.search('Adj') >= 0) {
            $('#type_adj').prop({'checked': true});
        } else {
            $('#type_adj').prop({'checked': false});
        }
        if (wtype.search('Adv') >= 0) {
            $('#type_adv').prop({'checked': true});
        } else {
            $('#type_adv').prop({'checked': false});
        }

        if (rdata.parent_word == 'none') {
            $('#parent').val('');
        } else {
            $('#parent').val(rdata.parent_word);
        }

        //hiện modal
        $("#myModal").modal();
    });

    //click vào nút xóa
    $('#table tbody').on('click', 'td.word_delete', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = row.data().id;

        //thực hiện hàm xóa
        delete_id(id);
//        var request = {ids: id, action: "delete", _token: typeof token !== "undefined" ? token : ""};
//        var r = confirm("Bạn có chắc chắn xóa?");
//        if (r) {
//            $.post(typeof postDel !== "undefined" ? postDel : "", request,
//                    function (data, status) {
//                        table.ajax.reload(null, false);
//                        result = JSON.parse(data);
//                        switch (result.status) {
//                            case 'success':
//                                message('#message', 'alert alert-success', result.message);
//                                break;
//                            case 'danger':
//                                message('#message', 'alert alert-danger', result.message);
//                                break;
//                            default :
//                                message('#message', 'alert alert-danger', 'Lỗi không xác định.');
//                                break;
//                        }
//                    });
//        }
    });

    var options = {
        beforeSubmit: showRequest,
//        success: showResponse,
        type: 'post',
        complete: showResponse
    };


    $('#form_modal').ajaxForm(options);

//
//    $("#form_modal").submit(function (event) {
//
////        toggleLoading(); //show loading mask
//        $.ajax({
//            url: "http://bk-english.vn/admin/words/edit", //api upload phía server
//            type: "POST",
//            data: new FormData(this),
//            contentType: false,
//            cache: false,
//            processData: false,
//            success: function (data) {
//                alert(222);
////                toggleLoading();
////                alert('thành công');
//                table.ajax.reload(null, false);
//                result = JSON.parse(data);
//
//                //Nhận thông báo và đưa ra các thông báo cần thiết
//                switch (result.status) {
//                    case 'success':
//                        $("#myModal").modal("hide");
//                        message('#message', 'alert alert-success', result.message);
//                        break;
//                    case 'danger':
//                        message('#modal_message', 'alert alert-danger', result.message);
//                        break;
//                    default :
//                        message('#modal_message', 'alert alert-danger', 'Lỗi không xác định.');
//                        break;
//                }
//            }
//            ,
//            error: function (data) {
////                toggleLoading();
//                alert(data);
//            }
//        });
////        return false;
//
//
//        var $form = $(this);
//
//        //Chọn tất cả các trường nhập liệu
//        var $inputs = $form.find("input, select, button, textarea");
//
//        //lấy dữ liệu của form
////        var serializedData = $form.serialize();
//
//        $inputs.prop("disabled", true);
//
//        //Gửi dữ liệu EDIT về server để xử lý
////        $.post(typeof postEdit !== "undefined" ? postEdit : "", serializedData,
////                function (data, status) {
////                    table.ajax.reload(null, false);
////                    result = JSON.parse(data);
////
////                    //Nhận thông báo và đưa ra các thông báo cần thiết
////                    switch (result.status) {
////                        case 'success':
////                            $("#myModal").modal("hide");
////                            message('#message', 'alert alert-success', result.message);
////                            break;
////                        case 'danger':
////                            message('#modal_message', 'alert alert-danger', result.message);
////                            break;
////                        default :
////                            message('#modal_message', 'alert alert-danger', 'Lỗi không xác định.');
////                            break;
////                    }
////                });
//
//        $inputs.prop("disabled", false);
//
//        //Không cho form gửi submit như bình thường
//        event.preventDefault();
//    });
// pre-submit callback 
    function showRequest(formData, jqForm, options) {
//        var queryString = $.param(formData);
//        alert('About to submit: \n\n' + queryString);
        return true;
    }

// post-submit callback 
    function showResponse(xhr) {
        table.ajax.reload(null, false);
        result = JSON.parse(xhr.responseText);

        //Nhận thông báo và đưa ra các thông báo cần thiết
        switch (result.status) {
            case 'success':
                $("#myModal").modal("hide");
                message('#message', 'alert alert-success', result.message);
                break;
            case 'danger':
                message('#modal_message', 'alert alert-danger', result.message);
                break;
            default :
                message('#modal_message', 'alert alert-danger', 'Lỗi không xác định.');
                break;
        }
//        $('#span').html(xhr.responseText);
//        alert('status: '  + '\n\nresponseText: \n' + xhr.responseText +
//                '\n\nThe output div should have already been updated with the responseText.');
    }
});

