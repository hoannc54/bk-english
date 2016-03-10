<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">

        <title>Admin - 600 word for toeic</title>

        <!-- Bootstrap Core CSS -->
        <link href="{!! url('public/css/bootstrap.min.css') !!}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{!! url('public/css/metisMenu.min.css') !!}" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="{!! url('public/css/dataTables.bootstrap.css') !!}" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="{!! url('public/css/jquery.dataTables.min.css') !!}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{!! url('public/css/sb-admin-2.css') !!}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{!! url('public/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div id="wrapper">
            @include('admin_test.menu')
            <div id="page-wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Quản lý từ</h1>
                    </div>
                </div>
                <!-- /.row -->

                @include('admin_test.table')
                @include('admin_test.other')
                
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="{!! url('public/js/jquery-1.11.3.min.js') !!}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{!! url('public/js/bootstrap.min.js') !!}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{!! url('public/js/metisMenu.min.js') !!}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{!! url('public/js/sb-admin-2.js') !!}"></script>
        @yield('script')

    </body>

</html>
