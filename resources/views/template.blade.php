<!DOCTYPE html>
<html >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <title>600 Words For TOEIC</title>

        <link rel="stylesheet" href="{!! url('/public/css/style.css') !!}"/>
        <link rel="stylesheet" href="{!! url('/public/css/hover.css') !!}"/>
        <link rel="stylesheet" href="{!! url('/public/css/font-awesome.css') !!}"/>
        @yield('style')
    </head>

    <body>
        <div class="container">
            <!-- begin banner -->
            <div class="banner shadow">
                <h1 class="number"><span class="relief neon">600</span> Words For TOEIC</h1>
            </div><!-- end banner -->
            <!--<div class="col-lg-12">-->
            <div id='top-menu'>
                @if (Auth::check())
                @include('block.topmenu')
                @else
                @include('block.topmenu-guest')
                @endif
            </div>

        </div>

        <div class="container">
            <div class="col">
                <!--<div style="height: 100px;"></div>-->
                <div class="BackgroundLinedPaper shadow content">
                    <div class="col-4">
                        @yield('leftmenu')

                        @if (Auth::check())
                        @include('block.leftmenu')
                        @else
                        @include('block.leftmenu-guest')
                        @endif

                    </div>
                    <div class="col-8">
                        <div class="main">
                            <div class="main-title" id="main-title">@yield('main-title')</div>
                            @include('block.error')
                            <div id="message"></div>
                            <div class="main-content">
                                <!--Đây là nội dung-->
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="footer col-offset-9">
                        Design by HOANG HOI.
                    </div>

                </div>
            </div>
        </div>

        <script src="{!! url('public/js/jquery-1.11.3.min.js') !!}"></script>
        <script src="{!! url('public/js/myscript.js') !!}"></script>
        <script src="{!! url('public/js/style.js') !!}"></script>

        @yield('script')
        <!--<script src="{!! url('public/js/play-sound.js') !!}"></script>-->
        <!--<script src="{!! url('public/js/mousehoa.js') !!}" type="text/javascript"></script>-->
    </body>
</html>