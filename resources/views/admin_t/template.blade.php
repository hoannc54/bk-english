<!DOCTYPE html>
<html lang="en">
    <head>
        <title>600 word for toeic</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{!! url('public/css/list.css') !!}">
        <link rel="stylesheet" href="{!! url('public/css/effeckt.css') !!}">
        <link rel="stylesheet" href="{!! url('public/css/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! url('public/css/admin-style.css') !!}"/>
    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 sidenav">
                    <h2>600 word for toeic</h2>
                    @include('admin.menu')
                </div>

                <div class="col-lg-7">
                    <h4>Admin page</h4>
                    <hr/>
                    <h3>@yield('main-title')</h3>
                    @include('block.error')

                    @include('block.message')

                    @yield('content')
                </div>
                <div class="col-lg-2">                    
                    @yield('right-menu')
                </div>
            </div>
        </div>

        <footer>
            <p>Design by Hoang Hoi.</p>
        </footer>

        <script src="{!! url('public/js/jquery-1.11.3.min.js') !!}"></script>
        
        <script src="{!! url('public/js/bootstrap.min.js') !!}"></script>
        
        <script src="{!! url('public/js/myscript.js') !!}"></script>
        
        <script src="{!! url('public/js/play-sound.js') !!}"></script>
        @yield('script')
    </body>
</html>
