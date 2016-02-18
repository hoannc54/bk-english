@extends('template')

@section('top-menu')
<ul>
    <li  class='active'><a href='#' >Trang chủ</a></li>
    <li><a href='#'>Bài học hôm nay</a>
        <ul>
            <li><a href='#'>Phương pháp học 1</a></li>
            <li><a href='#'>Phương pháp học 2</a></li>
        </ul>
    </li>
    <li><a href='#'>Hộp từ đã học</a></li>
    <li><a href='#'>Hộp từ đã thuộc</a></li>
    <li><a href='#'>Thông tin cá nhân</a></li>
</ul>
@stop

@section('left-menu')
<div class="left-menu bg-color-1">
    <div class="left-title">MỤC LỤC</div>
    <ul>
        <li>Trang chủ</li>
        <li>Bài hôm nay</li>
        <li>Kiểm tra bài cũ</li>
        <li>Thông tin tác giả</li>
    </ul>
</div>
@stop

@section('main-title')
Bài học hôm nay
@stop

@section('content')
<div class="hvr-icon-pulse"
     data-src-mp3="{!! url('public/sound/a cappella.mp3') !!}" 
     onclick="playSound($(this));">
    /phát âm/
</div>
@stop