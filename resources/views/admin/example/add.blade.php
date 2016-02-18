<?php
$example_manage = 'active';
?>
@extends('admin.template')

@section('main-title','Thêm câu ví dụ mới')

@section('content')
<form class="form-horizontal" role="form" action="{!! route('admin.example.postAdd') !!}" method="POST">
    <?php
//    $list_title = 'Từ đi kèm';
    $list_data = '
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="word">Câu:</label>
        <div class="col-sm-8"><input type="text" class="form-control" name="example[0][sentence]" placeholder="Nhập câu"></div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Nghĩa:</label>
        <div class="col-sm-8"><input type="text" class="form-control" name="example[0][mean]" placeholder="Nhập nghĩa"></div>
    </div>';
    $list_data_add = '
    <hr>
    <div class="form-group">
        <label class="control-label col-sm-2" for="word">Câu:</label>
        <div class="col-sm-8"><input type="text" class="form-control" name="example[id][sentence]" placeholder="Nhập câu"></div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Nghĩa:</label>
        <div class="col-sm-8"><input type="text" class="form-control" name="example[id][mean]" placeholder="Nhập nghĩa"></div>
    </div>';
    ?>
    @include('block.list')

    <div class="form-group">
        <div class="col-sm-offset-10">
            <button type="submit" class="btn btn-default">Thêm</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop
