<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Admin login</title>        
        <link rel="stylesheet" href="{!! url('public/css/login-form.css') !!}"/>
        <!--<link rel="stylesheet" href="{!! url('public/css/bootstrap.min.css') !!}">-->
        <style>
            .alert {
                padding: 5px;
                margin-bottom: 10px;
                /*margin-top: 10px;*/
                border: 1px solid transparent;
                border-radius: 4px;
            }
            .alert > ul {
                /*margin-bottom: 0;*/
                list-style: none;
                margin-left: -25px;
            }
            .alert-success {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
            }
            .alert-info {
                color: #31708f;
                background-color: #d9edf7;
                border-color: #bce8f1;
            }
            .alert-warning {
                color: #8a6d3b;
                background-color: #fcf8e3;
                border-color: #faebcc;
            }
            .alert-danger {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
            }
        </style>
    </head>
    <body>
        <form class="login" action="{!! route('admin.postLogin') !!}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <h1>Log In</h1>
            @include('block.error')
            @include('block.message')
            <fieldset class="inputs">
                <input class="username" id="username" name="username" placeholder="Tên đăng nhập" autofocus="" required="" type="text">   
                <input class="password" id="password" name="password" placeholder="Mật khẩu" required="" type="password">
            </fieldset>
            <fieldset class="actions">
                <input class="submit" value="Log in" type="submit">
<!--                <a href="">Quên mật khẩu?</a>
                <a href="">Đăng kí</a>-->
            </fieldset>
        </form>
        
        <!-- jQuery -->
        <script src="{!! url('public/js/jquery-2.2.0.min.js') !!}"></script>
        
        <!-- My JavaScript -->
        <script src="{!! url('public/js/myscript.js') !!}"></script>
    </body>
</html>