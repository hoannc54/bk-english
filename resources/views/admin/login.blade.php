<!DOCTYPE html>
<html><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Admin login</title>        
        <link rel="stylesheet" href="{!! url('public/css/login-form.css') !!}"/>
    <body>

        <form id="login">
            <h1>Log In</h1>
            <fieldset id="inputs">
                <input id="user" name="user" placeholder="Tên đăng nhập" autofocus="" required="" type="text">   
                <input id="pass" name="pass" placeholder="Mật khẩu" required="" type="password">
            </fieldset>
            <fieldset id="actions">
                <input id="submit" value="Log in" type="submit">
                <a href="">Quên mật khẩu?</a>Chưa có tài khoản?<a href="">Đăng kí</a> ngay.
            </fieldset>
        </form>
    </body>
</html>