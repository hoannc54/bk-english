@extends('admin.template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ trong từ điển')

@section('content')
<div id="message"></div>
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


<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh sửa từ</h4>
            </div>
            <div class="modal-body">
                <div id="modal_message"></div>
                <form class="form-horizontal form-modal" role="form" method="POST" id="form_modal">
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
                    <input type="hidden" name="id" id="id"/>
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
<script src="{!! url('public/js/dataTables.buttons.js') !!}"></script>

<!-- List word JavaScript -->
<script src="{!! url('public/js/list-words.js') !!}"></script>

<script type="text/javascript">
            var listAjax = "{!! route('admin.word.getListAjax') !!}",
            token = "{!! csrf_token() !!}",
            postDel = "{!! route('admin.word.postDel') !!}",
            postEdit = "{!! route('admin.word.postEdit') !!}",
            linkSound = "{!! url('/') !!}";</script>

<!-- play sound -->
<script src="{!! url('public/js/play-sound.js') !!}"></script>
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
    td.word_edit, td.word_delete, td.select-checkbox, td.spell, i.has-chil{cursor: pointer; color: #0000C2;}
/*    .chil_table{
        margin-left: 50px;
    }*/
</style>
@stop
