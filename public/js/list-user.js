/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    var table = $('#table').DataTable({
        dom: 'Bfrtip',
//        dom: 'Bflirtflp',
        "processing": true,
        "ajax": typeof listAjax !== "undefined" ? listAjax : "",
        "columns": [
            {
                "searchable": false,
                "orderable": false,
                "defaultContent": ""
            },
            {"data": "name"},
            {"data": "email"},
            {
                "data": function (source, type, val) {
                    switch (source.level) {
                        case 1:
                            return 'Super Admin';
                            break;
                        case 2:
                            return 'Admin';
                            break;
                        case 3:
                            return 'Member';
                            break;
                    }
                }
            },
            {
                "orderable": false,
                "searchable": false,
                "className": "user_edit center",
                "defaultContent": '<i class="fa fa-edit"></i>'
            },
            {
                "orderable": false,
                "searchable": false,
                "className": "user_delete center",
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

    //nếu không có mục nào được chọn thì disable mất nút không cần thiết
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
//    setInterval( function () {
//	table.ajax.reload();
//    }, 30000 );
    $('#table tbody').on('click', 'td.user_edit', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var rdata = row.data();
        var level = rdata.level;

        //Thêm thông tin vào modal
        $('#id').val(rdata.id);
        $('#name').val(rdata.name);
        $('#email').val(rdata.email);

        if (level == 1) {
            $('#sqt').prop({'checked': true});
        } else {
            $('#sqt').prop({'checked': false});
        }

        if (level == 2) {
            $('#qt').prop({'checked': true});
        } else {
            $('#qt').prop({'checked': false});
        }

        if (level == 3) {
            $('#tv').prop({'checked': true});
        } else {
            $('#tv').prop({'checked': false});
        }

        //Hiển thị modal
        $("#myModal").modal();
    });

    //click vào button xóa
    $('#table tbody').on('click', 'td.user_delete', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = row.data().id;

        //thực hiện hàm xóa
        delete_id(id);
    });

    //Hiển thị chỉ số của các hàng
    table.on('order.dt search.dt', function () {
        table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    $("#form_modal").submit(function (event) {

        var $form = $(this);

        //Chọn tất cả các trường nhập liệu
        var $inputs = $form.find("input, select, button, textarea");

        //lấy dữ liệu của form
        var serializedData = $form.serialize();

        //Không cho người dùng sửa nội dung form trong khi đang xử lý dữ liệu
        $inputs.prop("disabled", true);

        //Gửi dữ liệu EDIT về server để xử lý
        $.post(typeof postEdit !== "undefined" ? postEdit : "", serializedData,
                function (data, status) {
//                    alert(status);
                    table.ajax.reload(null, false);
                    result = JSON.parse(data);

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
                });

        $inputs.prop("disabled", false);
        $('#name').prop("disabled", true);

        //Không cho form gửi submit như bình thường
        event.preventDefault();
    });

});