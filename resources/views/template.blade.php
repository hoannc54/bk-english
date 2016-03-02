<!DOCTYPE html>
<html >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>600 Words For TOEIC</title>
        <link rel="stylesheet" href="{!! url('/public/css/style.css') !!}"/>
        <link rel="stylesheet" href="{!! url('/public/css/hover.css') !!}"/>
        <link rel="stylesheet" href="{!! url('/public/css/font-awesome.css') !!}"/>
        <script src="{!! url('public/js/jquery-1.11.3.min.js') !!}"></script>
        <script src="{!! url('public/js/style.js') !!}"></script>
        <script src="{!! url('public/js/play-sound.js') !!}"></script>

    </head>

    <body>
        <div class="container">
            <!-- begin banner -->
            <div class="banner shadow">
                <h1 class="number"><span class="relief neon">600</span> Words For TOIEC</h1>
                {{--<h1 class="shade t-color">TOEIC</h1>--}}
            </div><!-- end banner -->
            <!--<div class="col-lg-12">-->
            {{--Menu--}}
            <div id='top-menu'>
                {{--@yield('top-menu')--}}
                <ul>
                    <li><a href='{{url('/')}}' >Trang chủ</a></li>
                    <li><a href='#'>Bài học hôm nay</a>
                        <ul>
                            <li><a href='#'>Phương pháp học 1</a></li>
                            <li><a href='#'>Phương pháp học 2</a></li>
                        </ul>
                    </li>
                    <li><a href='#'>Hộp từ đã học</a></li>
                    <li><a href='#'>Hộp từ đã thuộc</a></li>
                    {{--<li><a href='#'>Thông tin cá nhân</a></li>--}}

                    <li><a href='{{ url('/auth/login') }}'>Đăng nhập</a></li>
                    <li><a href='{{ url('/auth/register') }}'>Đăng ký</a></li>
                </ul>
            </div>

            <!--<div style="height: 100px;"></div>-->
            <div class="BackgroundLinedPaper shadow content">
                <div class="col-4">
                   {{--@yield('left-menu')--}}
                    <div class="left-menu bg-color-1">
                        <div class="left-title">MỤC LỤC</div>
                        <ul>
                            <li>Trang chủ</li>
                            <li>Thông tin tác giả</li>
                        </ul>
                    </div>
                </div>
                <div class="col-8">
                    <div class="main">
                        <div class="main-title">@yield('main-title')</div>
                        <div class="main-content">
                            <!--Đây là nội dung-->
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="footer col-offset-9">
                    Design by HOANG HOI & Công Hoan
                </div>

            </div>
        </div>
        <script src="{!! url('public/js/mousehoa.js') !!}" type="text/javascript"></script>
    </body>
</html>