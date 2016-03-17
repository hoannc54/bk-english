@extends('admin.template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                Danh sách từ trong từ điển
            </div>
            <!-- /.panel-heading -->

            <div class="panel-body">
                <!--<div class="dataTable_wrapper">-->
                <table id="table" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Từ</th>
                            <th>Phát âm</th>
                            <th>Nghĩa</th>
                            <th>Từ gốc</th>
                            <th>Hành động</th>
                            <!--<th>salary</th>-->
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Từ</th>
                            <th>Phát âm</th>
                            <th>Nghĩa</th>
                            <th>Từ gốc</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
@endsection


@section('script')
@parent

<!-- DataTables JavaScript -->
<script src="{!! url('public/js/jquery.dataTables.js') !!}"></script>
<script src="{!! url('public/js/play-sound.js') !!}"></script>
<script>
            $(document).ready(function() {


    var table = $('#table').DataTable({
    "ajax": "{!! route('admin.word.getListAjax') !!}",
            "columns": [
            {
            "orderable":      false,
                    "defaultContent": ''
            },
            { "data": "word" },
            { "data": "spell" },
            { "data": "mean" },
            { "data": "parent_word" },
            {"data": "parent_word" }
            ],
            "order": [[1, 'asc']],
            //Khi bảng đã load xong duyệt từng hàng trong bảng để thêm danh sách example (nếu có) 
            //đối với từ tương ứng
            "rowCallback": function(row, data, displayIndex, displayIndexFull) {
                //lấy danh sách ví dụ trong router admin.word.getExample với mỗi id của từ
            $.get("{!! route('admin.word.getExample') !!}" + "/" + data.id, function(data, status){
            if (data != '') {
                //Thêm class has-chil vào cột nếu bảng nào có danh sách example
            $('td:eq(0)', row).addClass('has-chil');
                    var vidu = '<div class="table_ex"><table class="table"><tr><td colspan="3">Ví dụ:</td></tr>';
                    for (var i = 0; i < data.length; i++){
            vidu += '<tr><td>' + (i + 1) + '</td><td>' + data[i]['example'] + '</td>' +
                    '<td>' + data[i]['mean'] + '</td></tr>';
            }
            vidu += '</table></div>';
            //thêm dữ liệu example (data-html-Chil) vào cột 0 ứng với mỗi bản ghi
                    $('td:eq(0)', row).attr('data-html-Chil', vidu);
            }
            });
            }
    });
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
    });


</script>
@stop
