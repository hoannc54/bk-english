<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Admin login</title>        
        <link rel="stylesheet" href="{!! url('public/css/login-form.css') !!}"/>
        <!--<link rel="stylesheet" href="{!! url('public/css/bootstrap.min.css') !!}">-->
        <style>
            .alert {
                padding: 15px;
                margin-bottom: 20px;
                border: 1px solid transparent;
                border-radius: 4px;
            }
            .alert h4 {
                margin-top: 0;
                color: inherit;
            }
            .alert .alert-link {
                font-weight: bold;
            }
            .alert > p,
            .alert > ul {
                margin-bottom: 0;
            }
            .alert > p + p {
                margin-top: 5px;
            }
            .alert-dismissable,
            .alert-dismissible {
                padding-right: 35px;
            }
            .alert-dismissable .close,
            .alert-dismissible .close {
                position: relative;
                top: -2px;
                right: -21px;
                color: inherit;
            }
            .alert-success {
                color: #3c763d;
                background-color: #dff0d8;
                border-color: #d6e9c6;
            }
            .alert-success hr {
                border-top-color: #c9e2b3;
            }
            .alert-success .alert-link {
                color: #2b542c;
            }
            .alert-info {
                color: #31708f;
                background-color: #d9edf7;
                border-color: #bce8f1;
            }
            .alert-info hr {
                border-top-color: #a6e1ec;
            }
            .alert-info .alert-link {
                color: #245269;
            }
            .alert-warning {
                color: #8a6d3b;
                background-color: #fcf8e3;
                border-color: #faebcc;
            }
            .alert-warning hr {
                border-top-color: #f7e1b5;
            }
            .alert-warning .alert-link {
                color: #66512c;
            }
            .alert-danger {
                color: #a94442;
                background-color: #f2dede;
                border-color: #ebccd1;
            }
            .alert-danger hr {
                border-top-color: #e4b9c0;
            }
            .alert-danger .alert-link {
                color: #843534;
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
                <a href="">Quên mật khẩu?</a>
                <a href="">Đăng kí</a>
            </fieldset>
        </form>
    </body>
</html>