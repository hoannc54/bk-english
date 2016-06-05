@extends('template')

@section('leftmenu')
@parent

<div class="left-menu bg-color-3">
    <div class="left-title">BÀI HÔM NAY</div>
    <ul id="today">
        <!--<li>Danh sách từ mới</li>-->
        <li><a data-action="danh_sach">Học từ mới</a></li>
        <li><a data-action="luyen_viet">Luyện viết từ</a></li>
        <li><a data-action="kiem_tra_bai_cu">Kiểm tra bài cũ</a></li>
    </ul>
</div>
@endsection

@section('content')
<div id="show">
    <!--
        <div class="tabs">
            <div class="tab">
                <input type="radio" id="tab-1" name="tab-group-1" checked>
                <label for="tab-1">Tab 1</label>
                <div class="tab-content">
    
                    <div class="item" data-id="0"><img src="http://bk-english.vn/public/images/words/no_img.jpg">
                        <div class="profile">
                            <div class="word">engage<small>in'geidʤ</small><i class="fa fa-headphones" aria-hidden="true"></i></div>
                            <div class="thongtin">Mean: Tham gia, cam kết, (n)sự hứa hẹn, hứa hôn<br>Example:<br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->


</div>
@endsection


@section('script')
@parent
<script src="{!! url('public/js/learning.js') !!}"></script>
<!--<script src="{!! url('public/js/play-sound.js') !!}"></script>-->
<script>
    $(document).ready(function () {
        var learning_option = {
            url: '{{ route("getLearningAjax") }}',
            view: $('#show')
        };
        var Learning = new learning();
        Learning.init(learning_option);
        $('#today').on('click', 'li a', function () {
            Learning.action($(this).data('action'));
        });
    });
</script>
@stop


@section('style')
@parent
<style>
</style>
@stop
