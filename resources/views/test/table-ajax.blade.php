
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách từ trong từ điển
            </div>
            <span id="button">aaaaa</span>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <!--<div class="dataTable_wrapper">-->
                <table id="table" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>name</th>
                            <th>position</th>
                            <th>office</th>
                            <th>salary</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>name</th>
                            <th>position</th>
                            <th>office</th>
                            <th>salary</th>
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

@section('script')
@parent

<!-- DataTables JavaScript -->
<script src="{!! url('public/js/jquery.dataTables.js') !!}"></script>
<script src="{!! url('public/js/play-sound.js') !!}"></script>
<script>
            $(document).ready(function() {

    var table = $('#table').DataTable({
    "ajax": "{!! url('public/txt/test-table.txt') !!}",
            "columns": [
            {
                "orderable":      false,
                "defaultContent": ''
            },
            { "data": "name" },
            { "data": "position" },
            { "data": "office" },
            { "data": "salary" }
            ],
            "order": [[1, 'asc']],
            "rowCallback": function(row, data, displayIndex, displayIndexFull) {
                if (data.office == "Tokyo") {
                    $('td:eq(0)', row).addClass('has-chil');
                    $('td:eq(0)', row).attr('data-html-Chil', data.extn);
                }
            }
    });
            $('#table tfoot th').each(function () {
    if ($(this).text() != ""){
    var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
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
