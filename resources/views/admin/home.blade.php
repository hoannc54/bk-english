@extends('admin/admin-template')

@section('left-menu')
<ul class="nav nav-pills nav-stacked">
    <li class="active"><a href="#section1">Trang chủ</a></li>
    <li class="">
        <a data-toggle="collapse" href="#collapse1">Quản lý từ</a>
        <div id="collapse1" class="collapse">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Thêm từ mới</a></li>
                <li class="list-group-item"><a href="#">Danh sách từ</a></li>
                <!--<li class="list-group-item"><a href="#">Three</a></li>-->
            </ul>
        </div>

    </li>
    <li class="">
        <a data-toggle="collapse" href="#collapse2">Quản lý thành viên</a>
        <div id="collapse2" class="collapse">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Thêm thành viên mới</a></li>
                <li class="list-group-item"><a href="#">Danh sách thành viên</a></li>
                <!--<li class="list-group-item"><a href="#">Three</a></li>-->
            </ul>
        </div>

    </li>
</ul>
@stop

@section('content')
<form class="form-horizontal" role="form">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Email:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" placeholder="Enter email">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="pwd">Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="pwd" placeholder="Enter password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>
@stop