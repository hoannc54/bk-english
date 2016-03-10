<?php
$word_manage = 'active';
?>

@extends('admin.template')

@section('main-title','Thêm câu hỏi vào ngân hàng')

@section('content')
<form class="form-horizontal" role="form" action="{{url('/admin/test/question/create')}}" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="word">Tên câu hỏi</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="word" name="name" value="{!! old('word') !!}" placeholder="Nhập câu hỏi" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="spell">Nội dung</label>
        <div class="col-sm-8">
            <textarea type="text" class="form-control" id="spell" name="content" value="{!! old('spell') !!}" required="required"> </textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Đáp án a </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="means" name="a" value="{!! old('means') !!}" placeholder="Nhập câu trả lời" required="required">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Đáp án b </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="means" name="b" value="{!! old('means') !!}" placeholder="Nhập câu trả lời" required="required">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Đáp án c </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="means" name="c" value="{!! old('means') !!}" placeholder="Nhập câu trả lời" required="required">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Đáp án d </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="means" name="d" value="{!! old('means') !!}" placeholder="Nhập câu trả lời" required="required">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2" >Đáp án đúng</label>
        <div class="col-sm-8">
            <select class="form-control" name="key">
                <option value="a">A</option>
                <option value="b">B</option>
                <option value="c">C</option>
                <option value="d">D</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-10">
            <button type="submit" class="btn btn-default">Thêm</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop

@section('script')
<script src="{!! url('public/js/list-items.js') !!}"></script>
@endsection