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
<div id="show" style=" width: 100%; position: relative; padding-bottom: 4em;">
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
    <!--    <div>
            <audio src="{!! url('public/sounds/agreement.mp3') !!}"></audio>
            <img src="{!! url('public/images/words/agreement.jpg') !!}" class="anh"/>
        </div>
        <div class="doremon_noi" id="doremon_noi">Đây là câu nói của Doremon, Doremon gợi ý để trả lời câu hỏi Đây là câu nói của Doremon</div>
        <div class="doremon" style="float: right;"></div>
        <div class="goi_y">
            Đây là nghĩa của từ nghĩa của từ rất dài, dài ơi là dài
        </div>
        <div>
            <input type="text" class="tra_loi" id="tra_loi"/>
        </div>-->
    <input type="radio" id="pa_1" class="phuong_an" value=""/><label for="pa_1">Phương án 1</label>
    <input type="radio" id="pa_2" class="phuong_an" value=""/><label for="pa_2">Phương án 2</label>
    <input type="radio" id="pa_3" class="phuong_an" value=""/><label for="pa_3">Phương án 3</label>
    <input type="radio" id="pa_4" class="phuong_an" value=""/><label for="pa_4">Phương án 4</label>
    <input type="button" id="b_pa" value="OK"/>
</div>
@endsection


@section('script')
@parent
<script src="{!! url('public/js/learning.js') !!}"></script>
<!--<script src="{!! url('public/js/play-sound.js') !!}"></script>-->
<script>
    $(document).ready(function () {
//        var so_lan_nghe = 0;
//        var doremon_noi = [
//            'Bạn bấm vào ảnh để nghe phát âm nhé.',
//            'Hãy nghĩ kĩ trước khi trả lời nhé. Từ này khó lắm nha.',
//            '...'
//        ];

//        function noi(id) {
//            $('#doremon_noi').html(doremon_noi[id]);
//            $("#doremon_noi").animate({
//                width: 'toggle',
//                height: 'toggle',
//                opacity: 'toggle',
//                fontSize: 'toggle',
//                top: '-=40%',
//                left: '-=40%'
//            }, 'slow').delay(3000);
//            $("#doremon_noi").animate({
//                width: 'toggle',
//                height: 'toggle',
//                opacity: 'toggle',
//                fontSize: 'toggle',
//                top: '+=40%',
//                left: '+=40%'
//            }, 'slow');
//        }

//        $('#tra_loi').on('focus', function () {
//            if (so_lan_nghe == 0) {
//                noi(0);
//            } else {
//                noi(1);
//            }
//        });

//        $('.anh').on('click', function () {
//            so_lan_nghe++;
//            $(this).parent().find('audio').get(0).play();
//        });

//        $('#main-title').html('Bài học hôm nay');

//        var drm_bg_pos = 0;
//        $('.doremon').on('click', function () {
//            drm_bg_pos += 10;
//            if (drm_bg_pos == 110) {
//                drm_bg_pos = 0;
//            }
//            $(this).css('background-position', drm_bg_pos + '%');
//        });


        var learning_option = {
            url: '{{ route("getLearningAjax") }}',
            view: $('#show'),
            _token: '{!! csrf_token() !!}',
            update_url: '{!! route("postLearningUpdate") !!}',
            test_url: '{!! route("getLearnedAjax") !!}',
            test_up_url: '{!! route("postLearningUptest") !!}'
        };
        var Learning = new learning();
        Learning.init(learning_option);
        $('#today').on('click', 'li a', function () {
            Learning.action($(this).data('action'));
        });

//        function fix_image_doremon_noi() {
//            var w_n, h_n;
//            $('.doremon_noi').css('width', '55%');
//            w_n = $('.doremon_noi').innerWidth();
//            h_n = w_n * 0.48;
//            $('.doremon_noi').css('height', h_n);
//            $('.doremon_noi').css('font-size', w_n / 18);
//        }

//        function fix_image_doremon() {
//            var w, h;
//            w = $('.doremon').innerWidth();
//            h = w * 1.16;
//            $('.doremon').css('height', h);
//        }

//        $(window).load(function () {
//            fix_image_doremon();
//            fix_image_doremon_noi();
//            $("#doremon_noi").animate({
//                width: 'toggle',
//                height: 'toggle',
//                opacity: 'toggle',
//                fontSize: 'toggle',
//                top: '+=40%',
//                left: '+=40%'
//            }, 'slow');
//        });
//        $(window).on("resize", function () {
//            fix_image_doremon();
//            fix_image_doremon_noi();
//        });
//        $(window).on("resize", function () {
//            fix_image_doremon();
//        });
    });
</script>
@stop


@section('style')
@parent
<style>
    .tra_loi{
        /*width: 50%;*/
        padding: 10px 12px;
        /*color: #555;*/
        /*alignment-adjust: middle;*/
        background-color: #FFF;
        border: 1px solid #CCC;
        border-radius: 4px;
        box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        font-size: 2em;
        font-family: inherit;
        /*text-align: condensed;*/
        color: blue;
        margin-top: 1em;
        margin-bottom: 1em;

    }
    .tl_dung{
        text-shadow: 1px 0 1px blue;
    }
    /*    .tl_sai{
            text-shadow: 1px 0 1px blue;
        }*/
    .goi_y{
        /*float: left;*/ 
        width: 50%; 
        min-height: 4em;
    }
    /*    .goi_y:after{
            content: ' ';
            clear: both;
        }*/
    .anh{
        cursor: pointer;
        max-width: 80%;
        height: 16em;
        padding: 0.4em;
        border: 1px none;
        background: rgb(255, 255, 255) none repeat scroll 0% 0%;
        box-shadow: 0px 1px 4px rgb(204, 204, 204), 0px 0px 10px rgb(204, 204, 204) inset;
    }
    .nex_pre{
        font-size:4em; 
        overflow: hidden;
        color: red;
        cursor: pointer;
        /*min-height: 1em;*/
    }

    .word_test{
        width: 65%;
        padding-top: 0.6em;
        text-align: center;
        /*color: #555;*/
        /*alignment-adjust: middle;*/
        /*background-color: #FFF;*/
        /*border: 1px solid #CCC;*/
        /*border-radius: 4px;*/
        /*box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.075) inset;*/
        transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
        font-size: 2em;
        font-family: inherit;
        /*text-align: condensed;*/
        color: blue;
        /*margin-top: 1em;*/
        margin-bottom: 0.4em;
        text-shadow: 1px 0 1px blue;
    }
    .b_pa{
        margin-left: 50%;
        margin-top: 2.3em;
    }




    /* button
---------------------------------------------- */
    .button {
        display: inline-block;
        /*zoom: 1;*/ 
        /*zoom and *display = ie7 hack for display:inline-block*/ 
        /**display: inline;*/
        vertical-align: baseline;
        /*margin: 0 2px;*/
        outline: none;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        font: 14px/100% Arial, Helvetica, sans-serif;
        padding: .5em 2em .55em;
        text-shadow: 0 1px 1px rgba(0,0,0,.3);
        -webkit-border-radius: .5em;
        -moz-border-radius: .5em;
        border-radius: .5em;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
        box-shadow: 0 1px 2px rgba(0,0,0,.2);
    }
    .button:hover {
        text-decoration: none;
    }
    .button:active {
        position: relative;
        top: 1px;
    }


    /* blue */
    .blue {
        color: #d9eef7;
        border: solid 1px #0076a3;
        background: #0095cd;
        background: -webkit-gradient(linear, left top, left bottom, from(#00adee), to(#0078a5));
        background: -moz-linear-gradient(top, #00adee, #0078a5);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#00adee', endColorstr='#0078a5');
    }
    .blue:hover {
        background: #007ead;
        background: -webkit-gradient(linear, left top, left bottom, from(#0095cc), to(#00678e));
        background: -moz-linear-gradient(top, #0095cc, #00678e);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0095cc', endColorstr='#00678e');
    }
    .blue:active {
        color: #80bed6;
        background: -webkit-gradient(linear, left top, left bottom, from(#0078a5), to(#00adee));
        background: -moz-linear-gradient(top, #0078a5, #00adee);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#0078a5', endColorstr='#00adee');
    }
</style>
@stop
