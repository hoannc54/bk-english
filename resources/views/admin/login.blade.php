<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>Admin login</title>
        <link rel="stylesheet" href="{!! url('public/css/login-form.css') !!}"/>
    </head>

    <body>

        <form id="login" action="{!! route('admin.login') !!}" method="POST">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
            <h1>Log In</h1>
            <fieldset id="inputs">
                <input id="username" name="username" placeholder="Username" autofocus="" required="" type="text">   
                <input id="password" name="password" placeholder="Password" required="" type="password">
            </fieldset>
            <fieldset id="actions">
                <input id="submit" value="Log in" type="submit">
                <!--<a href="">Forgot your password?</a><a href="">Register</a>-->
            </fieldset>
        </form>




    </body>
</html>