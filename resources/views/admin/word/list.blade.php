@extends('admin.template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ trong từ điển')

@section('content')
<!--<div class="dataTable_wrapper">-->
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Từ</th>
            <th>Phát âm</th>
            <th>Từ loại</th>
            <th>Nghĩa</th>
            <th>Từ gốc</th>
            <th></th>
            <th></th>
            <th></th>
            <!--<th>salary</th>-->
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>Từ</th>
            <th>Phát âm</th>
            <th>Từ loại</th>
            <th>Nghĩa</th>
            <th>Từ gốc</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>


<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh sửa từ</h4>
            </div>
            <div class="modal-body">

                <form class="form-horizontal form-model" role="form" method="POST">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="word">Từ:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="word" name="word" placeholder="Nhập từ" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Từ loại:</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="N" id="type_n">Danh từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="V" id="type_v">Động từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="Adj" id="type_adj">Tính từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="Adv" id="type_adv">Trạng từ</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="spell">Phát âm:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="spell" name="spell" placeholder="Nhập phát âm" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="means">Nghĩa:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="means" name="means" placeholder="Nhập nghĩa" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="parent">Từ gốc:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="parent" name="parent" placeholder="Nhập từ gốc">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection


@section('script')
@parent

<!-- DataTables JavaScript -->
<script src="{!! url('public/js/jquery.dataTables.js') !!}"></script>
<script src="{!! url('public/js/dataTables.select.js') !!}"></script>

<script>
            $(document).ready(function() {


    var table = $('#table').DataTable({
        "processing": true,
//        "stateSave": true,
//        serverSide: true,
    "ajax": "{!! route('admin.word.getListAjax') !!}",
            "columns": [
            {
            "orderable":      false,
                    "defaultContent": ''
            },
            { "data": "word" },
            { "data": "spell" },
            { "data": "type" },
            { "data": "mean" },
            { "data": "parent_word" },
            {
            "orderable":      false,
                    "searchable":      false,
                    className: 'word_edit',
                    "defaultContent": '<i class="fa fa-edit"></i>'
            }, {
            "orderable":      false,
                    "searchable":      false,
                    className: 'word_delete',
                    "defaultContent": '<i class="fa fa-close"></i>'
            },
            {
            "orderable":      false,
                    "searchable":      false,
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
            $('#word').val(rdata.word);
            $('#spell').val(rdata.spell);
            $('#means').val(rdata.mean);
            
            if (wtype.search('N') >= 0){
    $('#type_n').prop({'checked':true});
    }else{
    $('#type_n').prop({'checked':false});
    }
    if (wtype.search('V') >= 0){
    $('#type_v').prop({'checked':true});
    }else{
    $('#type_v').prop({'checked':false});
    }
    if (wtype.search('Adj') >= 0){
    $('#type_adj').prop({'checked':true});
    }else{
    $('#type_adj').prop({'checked':false});
    }
    if (wtype.search('Adv') >= 0){
    $('#type_adv').prop({'checked':true});
    }else{
    $('#type_adv').prop({'checked':false});
    }

    if (rdata.parent_word == 'none'){
    $('#parent').val('');
    } else{
    $('#parent').val(rdata.parent_word);
    }
    $("#myModal").modal();
    });
            $('#table tbody').on('click', 'td.word_delete', function () {
    var tr = $(this).closest('tr');
            var row = table.row(tr);
            var id = row.data().id;
            var request = {ids: id, action:"delete", _token: "{!! csrf_token() !!}"};
            var r = confirm("Bạn có chắc chắn xóa?");
            if(r){
            $.post("{!! route('admin.word.postDel') !!}", request,
                    function (data, status) {
                    table.ajax.reload(null, false);
                    result = JSON.parse(data);
                    switch(result.status){
                        case 'success': message('alert alert-success', result.message); break;
                        case 'danger': message('alert alert-danger', result.message); break;
                            default : message('alert alert-danger', 'Lỗi không xác định.'); break;
    }
                    });
                }
//            message('alert alert-danger', 'dddddd');
    });
    
//            $(".word_edit").click(function(){
//    $("#myModal").modal();
//    });
    });
        </script>

<!-- play sound -->
<script src="{!! url('public/js/play-sound.js') !!}"></script>
@stop


@section('style')
@parent
<style>
    .form-model{
        margin: 50px;
    }
    .word_edit, .word_delete, .select-checkbox{cursor: pointer;}
</style>
@stop
