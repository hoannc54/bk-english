@extends('admin.template')

@section('main-title','Quản lý ví dụ')

@section('sub-title','Danh sách câu ví dụ')

@section('content')
<div id="message"></div>
<!--<div class="dataTable_wrapper">-->
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Câu ví dụ</th>
            <th>Nghĩa</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>Câu ví dụ</th>
            <th>Nghĩa</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>


<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh câu ví dụ</h4>
            </div>
            <div class="modal-body">
                <div id="modal_message"></div>
                <form class="form-horizontal form-modal" role="form" method="POST" id="form_modal">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="example">Câu:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="example" name="example" placeholder="Nhập câu" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mean">Nghĩa:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mean" name="mean" placeholder="Nhập nghĩa của câu" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <input type="hidden" name="id" id="id"/>
                    <!--end form-->
                </form>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>

    </div>
</div>
@endsection


@section('script')
@parent

<!-- DataTables JavaScript -->
<script src="{!! url('public/js/jquery.dataTables.js') !!}"></script>
<script src="{!! url('public/js/dataTables.select.js') !!}"></script>
<script src="{!! url('public/js/dataTables.buttons.js') !!}"></script>

<!-- List example JavaScript -->
<script src="{!! url('public/js/list-example.js') !!}"></script>

<script type="text/javascript">
            var listAjax = "{!! route('admin.example.getListAjax') !!}",
            token = "{!! csrf_token() !!}",
            postDel = "{!! route('admin.example.postDel') !!}",
            postEdit = "{!! route('admin.example.postEdit') !!}";</script>

<!-- play sound -->
<!--<script src="{!! url('public/js/play-sound.js') !!}"></script>-->
@stop


@section('style')
@parent

<!-- Button DataTables CSS -->
<link href="{!! url('public/css/buttons.dataTables.css') !!}" rel="stylesheet">

<style>
    .form-modal{
        margin: 50px;
    }
    .center{text-align: center;}
    td.example_edit, td.example_delete, td.select-checkbox, td.spell, i.has-chil{cursor: pointer; color: #0000C2;}
    /*    .chil_table{
            margin-left: 50px;
        }*/
</style>
@stop
