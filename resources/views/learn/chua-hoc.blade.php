@extends('template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ trong từ điển')

@section('content')
<div id="message"></div>
<!--<div class="dataTable_wrapper">-->
<table id="table" class="display" cellspacing="0">
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
