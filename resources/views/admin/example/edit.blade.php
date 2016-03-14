@extends('admin.template')

@section('main-title','Quản lý ví dụ')

@section('sub-title','Chỉnh sửa câu ví dụ')

@section('content')
<form class="form-horizontal" role="form" action="{!! route('admin.example.postEdit',$data->id) !!}" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="example">Câu:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="example" name="example" placeholder="Nhập câu" required="required" value="{!! old('example', isset($data)?$data->example:NULL) !!}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="mean">Nghĩa:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="mean" name="mean" placeholder="Nhập nghĩa" value="{!! old('mean', isset($data)?$data->mean:NULL) !!}">
        </div>
    </div
    <div class="form-group">
        <div class="col-sm-offset-7">
            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-success">Reset</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop
