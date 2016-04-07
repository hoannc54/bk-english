@extends('template')

@section('left-menu')
<div class="left-menu bg-color-1">
    <div class="left-title">MỤC LỤC</div>
    <ul>
        <li>Trang chủ</li>
        <li>Thông tin tác giả</li>
    </ul>
</div>
@stop

@section('main-title','Đăng ký')

@section('content')
@include('block.error')
@include('block.message')

<form action="{!! route('postRegister') !!}" method="POST" >
    <div class="group">
        <label class="col-4" for="name">Tên đăng nhập:</label>
        <input class="col-7 form-control" type="text" id="name" name="name"/>
    </div>
    <div class="group">
        <label class="col-4" for="email">Email:</label>
        <input class="col-7 form-control" type="email" id="email" name="email"/>
    </div>
    <div class="group">
        <label class="col-4" for="password">Mật khẩu:</label>
        <input class="col-7 form-control" type="text" id="password" name="password"/>
    </div>
    <div class="group">
        <label class="col-4" for="password">Nhập lại mật khẩu:</label>
        <input class="col-7 form-control" type="text" id="repassword" name="repassword"/>
    </div>

    <!--    <div class="col-7 col-offset-4 checkbox">
            <label><input type="checkbox" value="">Ghi nhớ mật khẩu</label>
        </div>-->
    <div class="group col-7 col-offset-4" >
        <input class="button" type="submit" value="Đăng kí"/>
    </div>
    <div class="group col-7 col-offset-4" >
        <span>Đã có tài khoản? <a href="{!! route('getLogin') !!}">Đăng nhập</a>.</span>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop