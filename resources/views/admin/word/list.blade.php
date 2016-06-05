@extends('admin.template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ trong từ điển')

@section('content')
<div id="message"></div>
<!--<div class="dataTable_wrapper">-->
<table id="table" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th></th>
            <th>Từ</th>
            <th>Phát âm</th>
            <th>Từ loại</th>
            <th>Nghĩa</th>
<!--            <th>Câu ví dụ</th>
            <th>Nghĩa câu ví dụ</th>-->
            <!--<th>Từ gốc</th>-->
            <th></th>
            <th></th>
            <th></th>
            <!--<th>salary</th>-->
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th></th>
            <th>Từ</th>
            <th>Phát âm</th>
            <th>Từ loại</th>
            <th>Nghĩa</th>
<!--            <th>Câu ví dụ</th>
            <th>Nghĩa câu ví dụ</th>-->
            <!--<th>Từ gốc</th>-->
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </tfoot>
</table>

<span id="span"></span>
<!-- Modal edit-->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Chỉnh sửa từ</h4>
            </div>
            <div class="modal-body">
                <div id="modal_message"></div>
                <form class="form-horizontal form-modal" role="form" action="{!! route('admin.word.postEdit') !!}" id="form_modal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="word">Từ:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="word" name="word" placeholder="Nhập từ" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Từ loại:</label>
                        <div class="col-sm-10">
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="N" id="type_n">Danh từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="V" id="type_v">Động từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="Adj" id="type_adj">Tính từ</label>
                            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="Adv" id="type_adv">Trạng từ</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="spell">Phát âm:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="spell" name="spell" placeholder="Nhập phát âm" required="required">
                            <input type="file" class="" id="sound" name="sound" accept="audio/mp3"/>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mean">Nghĩa:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mean" name="mean" placeholder="Nhập nghĩa" required="required">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="example">Câu ví dụ:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="example" name="example" placeholder="Nhập câu ví dụ" required="required">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="mean_ex">Nghĩa câu ví dụ:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="mean_ex" name="mean_ex" placeholder="Nhập nghĩa câu ví dụ" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="img">Hình minh họa:</label>
                        <div class="col-sm-8">
                            <img id="logo-img" title="Hình minh họa" style="width: 200px;" onclick="document.getElementById('img').click();" src="{!! url('public/images/words/no_img.jpg') !!}"/>
                            <input type="file" style="display: none" id="img" name="img" accept="image/*" onchange="addNewLogo(this)"/>
                            <!--<input type="file" class="form-control" id="img" name="img" placeholder="Nhập ảnh minh họa">-->
                        </div>
                    </div>
                    <!--                    <div class="form-group">
                                            <label class="control-label col-sm-2" for="parent">Từ gốc:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="parent" name="parent" placeholder="Nhập từ gốc">
                                            </div>
                                        </div>-->

                    <div class="form-group">
                        <div class="col-sm-offset-10">
                            <button type="submit" class="btn btn-success">Sửa</button>
                            <!--<button type="reset" class="btn btn-default">Reset</button>-->
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                    <input type="hidden" name="id" id="id"/>
                </form>

            </div>
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

<!-- List word JavaScript -->
<script src="{!! url('public/js/list-words.js') !!}"></script>

<!-- Jquery Form Javascript-->
<script src="{!! url('public/js/jquery.form.js') !!}"></script>

<script type="text/javascript">
                                var listAjax = "{!! route('admin.word.getListAjax') !!}",
                                        token = "{!! csrf_token() !!}",
                                        postDel = "{!! route('admin.word.postDel') !!}",
                                        postEdit = "{!! route('admin.word.postEdit') !!}",
                                        linkSound = "{!! url('/') !!}";</script>

<!-- play sound -->
<script src="{!! url('public/js/play-sound.js') !!}"></script>
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
    td.word_edit, td.word_delete, td.select-checkbox, td.spell, i.has-chil{cursor: pointer; color: #0000C2;}
    /*    .chil_table{
            margin-left: 50px;
        }*/
    .img_mh{
        float: right;
        width: 18%;
        padding: 1%;
        border: 1px none;
        background: rgb(255, 255, 255) none repeat scroll 0% 0%;
        box-shadow: 0px 1px 4px rgb(204, 204, 204), 0px 0px 10px rgb(204, 204, 204) inset;
    }
    .table_ex{
        width: 70%;
        float: left;
    }
</style>
@stop
