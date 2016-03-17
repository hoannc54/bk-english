<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <input type="text" id="input"/>
        <button id="button">Button</button>
        <script src="{!! url('public/js/jquery-1.11.3.min.js') !!}"></script>
        <script>
            $(document).ready(function () {
                $('#button').on('click', function () {
                    var URL = "{!! url('post') !!}";
                    var data = $('input').val();
                        alert(data);
                    $.post(URL, data, function (data, status, xhr) {
                        alert(data);
                    })
                });
            });
        </script>
    </body>
</html>
