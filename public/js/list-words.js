/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



$(document).ready(function () {

    var table = $('#table').DataTable({
        "processing": true,
//        "stateSave": true,
//        serverSide: true,
        "ajax": typeof listAjax !== "undefined" ? listAjax : "",
        "columns": [
            {
                "orderable": false,
                "defaultContent": ''
            },
            {"data": "word"},
            {"data": "spell"},
            {"data": "type"},
            {"data": "mean"},
            {"data": "parent_word"},
            {
                "orderable": false,
                "searchable": false,
                className: 'word_edit',
                "defaultContent": '<i class="fa fa-edit"></i>'
            },
            {
                "orderable": false,
                "searchable": false,
                className: 'word_delete',
                "defaultContent": '<i class="fa fa-close"></i>'
            },
            {
                "orderable": false,
                "searchable": false,
                className: 'select-checkbox',
                "defaultContent": " "
            }
        ],
        "order": [[1, 'asc']],
        select: {
            style: 'multi',
            selector: 'td:last-child'
        }
        //Khi bảng đã load xong duyệt từng hàng trong bảng để thêm danh sách example (nếu có) 
        //đối với từ tương ứng
//            "rowCallback": function(row, data, displayIndex, displayIndexFull) {
//            //lấy danh sách ví dụ trong router admin.word.getExample với mỗi id của từ
//            $.get("{!! route('admin.word.getExample') !!}" + "/" + data.id, function(data, status){
//            if (data != '') {
//            //Thêm class has-chil vào cột nếu bảng nào có danh sách example
//            $('td:eq(0)', row).addClass('has-chil');
//                    var vidu = '<div class="table_ex"><table class="table"><tr><td colspan="3">Ví dụ:</td></tr>';
//                    for (var i = 0; i < data.length; i++){
//            vidu += '<tr><td>' + (i + 1) + '</td><td>' + data[i]['example'] + '</td>' +
//                    '<td>' + data[i]['mean'] + '</td></tr>';
//            }
//            vidu += '</table></div>';
//                    //thêm dữ liệu example (data-html-Chil) vào cột 0 ứng với mỗi bản ghi
//                    $('td:eq(0)', row).attr('data-html-Chil', vidu);
//            }
//            });
//            }
    });
//    setInterval( function () {
//	table.ajax.reload();
//    }, 30000 );
    $('#table tbody').on('click', 'td.has-chil', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var data_chil = $(this).data('htmlChil');
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            $(this).removeClass('shown');
        }
        else {
            // Open this row
            row.child(data_chil).show();
            $(this).addClass('shown');
        }
    });
    $('#table tbody').on('click', 'td.word_edit', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var rdata = row.data();
        var wtype = rdata.type;
        $('#id').val(rdata.id);
        $('#word').val(rdata.word);
        $('#spell').val(rdata.spell);
        $('#means').val(rdata.mean);

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
        $("#myModal").modal();
    });
    $('#table tbody').on('click', 'td.word_delete', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = row.data().id;
        var request = {ids: id, action: "delete", _token: typeof token !== "undefined" ? token : ""};
        var r = confirm("Bạn có chắc chắn xóa?");
        if (r) {
            $.post(typeof postDel !== "undefined" ? postDel : "", request,
                    function (data, status) {
                        table.ajax.reload(null, false);
                        result = JSON.parse(data);
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
    });

    $("#form_modal").submit(function (event) {

        var $form = $(this);

        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        // Serialize the data in the form
        var serializedData = $form.serialize();

        // Let's disable the inputs for the duration of the Ajax request.
        // Note: we disable elements AFTER the form data has been serialized.
        // Disabled form elements will not be serialized.
        $inputs.prop("disabled", true);

        $.post(typeof postEdit !== "undefined" ? postEdit : "", serializedData,
                function (data, status) {
                    table.ajax.reload(null, false);
                    result = JSON.parse(data);
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
                });
        // Fire off the request to /form.php
//                    request = $.ajax({
//                        url: "{!! route('admin.word.postEdit') !!}",
//                        type: "post",
//                        data: serializedData
//                    });

        // Callback handler that will be called on success
//                    request.done(function (response, textStatus, jqXHR) {
//                        // Log a message to the console
//                        console.log("Hooray, it worked!");
//                    });

        // Callback handler that will be called on failure
//                    request.fail(function (jqXHR, textStatus, errorThrown) {
//                        // Log the error to the console
//                        console.error(
//                                "The following error occurred: " +
//                                textStatus, errorThrown
//                                );
//                    });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
//                    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
//                    });

        // Prevent default posting of form
        event.preventDefault();
    });

});