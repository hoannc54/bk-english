@extends('admin.template')

@section('main-title','Quản lý thành viên')

@section('sub-title','Danh sách thành viên')

@section('content')
<div id="message"></div>
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Cấp độ</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>Tên đăng nhập</th>
            <th>Email</th>
            <th>Cấp độ</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>


<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh thông tin thành viên</h4>
            </div>
            <div class="modal-body">
                <div id="modal_message"></div>
                <form class="form-horizontal form-modal" role="form" method="POST" id="form_modal">

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="name">Tên đăng nhập:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nhập câu" required="required" disabled="disable">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" for="email">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" value="{!! old('email') !!}" placeholder="Nhập email" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Cấp độ:</label>
                        <div class="col-sm-8">
                            <label class="radio-inline">
                                <input type="radio" id="sqt" name="level" value="1">Super Admin
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="qt" name="level" value="2">Admin
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="tv" name="level" value="3">Member
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="submit" class="btn btn-success">Sửa</button>
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <input type="hidden" name="id" id="id"/>
                    <!--end form-->
                </form>
                <!--end modal-body-->
            </div>
            <!--end modal-content-->
        </div>

    </div>
</div>
@endsection

@section('script')
@parent

<!-- DataTables JavaScript -->
<script src="{!! url('public/js/jquery.dataTables.js') !!}"></script>
<script src="{!! url('public/js/dataTables.select.js') !!}"></script>
<script src="{!! url('public/js/dataTables.buttons.js') !!}"></script>


<script type="text/javascript">
            var listAjax = "{!! route('admin.user.getListAjax') !!}",
            token = "{!! csrf_token() !!}",
            postDel = "{!! route('admin.user.postDel') !!}",
            postEdit = "{!! route('admin.user.postEdit') !!}";</script>

<!-- List example JavaScript -->
<script src="{!! url('public/js/list-user.js') !!}"></script>

<!-- play sound -->
<!--<script src="{!! url('public/js/play-sound.js') !!}"></script>-->
@stop


@section('style')
@parent

<!-- Button DataTables CSS -->
<link href="{!! url('public/css/buttons.dataTables.css') !!}" rel="stylesheet">

<style>
    .form-modal{
        margin: 50px;
    }
    .center{text-align: center;}
    td.user_edit, td.user_delete, td.select-checkbox, td.spell, i.has-chil{cursor: pointer; color: #0000C2;}
    /*    .chil_table{
            margin-left: 50px;
        }*/
</style>
@stop

