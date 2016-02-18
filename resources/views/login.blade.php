@extends('template')

@section('top-menu')
<ul>
    <li><a href='#' >Trang chủ</a></li>
    <li class='active'><a href='#'>Đăng nhập</a></li>
    <li><a href='#'>Đăng kí</a></li>
</ul>
@stop

@section('left-menu')
<div class="left-menu bg-color-1">
    <div class="left-title">MỤC LỤC</div>
    <ul>
        <li>Trang chủ</li>
        <li>Thông tin tác giả</li>
    </ul>
</div>
@stop

@section('main-title')
Đăng nhập
@stop

@section('content')
<form action="" method="POST" >
    <div class="group">
        <label class="col-4" for="name">Tên đăng nhập:</label>
        <input class="col-7 form-control" type="text"/>
    </div>
    <div class="group">
        <label class="col-4" for="pass">mật khẩu:</label>
        <input class="col-7 form-control" type="text"/>
    </div>

    <div class="col-7 col-offset-4 checkbox">
        <label><input type="checkbox" value="">Ghi nhớ mật khẩu</label>
    </div>
    <div class="group col-7 col-offset-4" >
        <input class="button" type="submit" value="Đăng nhập"/>
    </div>
    <div class="group col-7 col-offset-4" >
        <span>Chưa có tài khoản? <a href="#">Đăng kí</a> ngay.</span>
    </div>
</form>
@stop