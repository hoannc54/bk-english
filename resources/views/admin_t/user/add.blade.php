<?php
$user_manage = 'active';
?>

@extends('admin.template')

@section('main-title','Thêm thành viên mới')

@section('content')
<form class="form-horizontal" role="form" action="{!! route('admin.user.postAdd') !!}" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-3" for="name">Tên đăng nhập:</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="name" name="name" value="{!! old('name') !!}" placeholder="Tên đăng nhập" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="email">Email:</label>
        <div class="col-sm-7">
            <input type="email" class="form-control" id="email" name="email" value="{!! old('email') !!}" placeholder="Nhập email" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="password">Mật khẩu:</label>
        <div class="col-sm-7">
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required="required">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-3" for="repassword">Nhập lại mật khẩu:</label>
        <div class="col-sm-7">
            <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" required="required">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-3">Cấp độ:</label>
        <div class="col-sm-7">
            <label class="radio-inline">
                <input type="radio" name="level" value="2" <?php if((int)old('level')==2) echo 'checked="checked"'; ?>>Quản trị
            </label>
            <label class="radio-inline">
                <input type="radio" name="level" value="1" <?php if((int)old('level')!=2) echo 'checked="checked"'; ?>>Thành viên
            </label>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-9">
            <button type="submit" class="btn btn-default">Thêm</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop

@section('script')
<!--<script src="{!! url('public/js/list-items.js') !!}"></script>-->
@endsection