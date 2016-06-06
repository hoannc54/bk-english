/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function learning() {
    this.url = '';
    this.objView = '';
    this.type = 'get';
    this.data = '';
    this.dang_hoc = null;

    //Các biến dùng cho quá trình học 1 từ
    this.doremon_noi = {
        nghe: {noi: 'Bạn bấm vào ảnh để nghe phát âm nhé.', dem: 0}, //0
        nghi: {noi: 'Hãy nghĩ kĩ trước khi trả lời nhé. Từ này khó lắm nha.', dem: 0}, //1
        nghe_nhieu: {noi: 'Hãy nghe phát âm nhiều lần để tìm ra đáp án đúng nhé', dem: 0}, //2
        dung: {noi: 'Đáp án đúng rồi. Bạn thật là giỏi. :)', dem: 0}, //3
        kho: {noi: 'Khó lắm à, để tớ tìm gợi ý nha.', dem: 0}, //4
        goi_y: {noi: 'Có rồi đây:', dem: 0, luu: ''}, //5
        gan_dung: {noi: 'Bạn trả lời gần đúng rồi đấy.', dem: 0}, //6
        sai: {noi: 'Sai rồi kìa.', dem: 0}, //7
        sai_bet: {noi: 'Câu trả lời sai. Đáp án đúng là ', dem: 0}, //8

        them_goi_y: {noi: 'Để tớ tìm xem còn gợi ý nào không.', dem: 0}, //9
        het_goi_y: {noi: 'Hết gợi ý mới rồi. Bạn xem lại các gợi ý cũ nha.', dem: 0}, //10
        doi_tu: {noi: 'Vẫn sai kìa. Nếu chưa tìm ra đáp án ngay bây giờ có thể đổi từ khác.', dem: 0} //11
    };

    this.doremon_image = {
        bt: 0,
        ngoi: 1,
        gio_chan: 2,
        vui: 3,
        tim_goi_y: 4,
        goi_y: 5,
        gan_dung: 6,
        sai: 7,
        sai_bet: 8
    };
//    this.doremon_noi
    this.so_lan_nghe = 0;
//    this.goi_y = 0;
//    this.timeout = null;

    //Các biến thông báo
    this.emty = '<div style="text-align: center;">Danh sách trống.</div>';
    this.loading = '<div style="text-align: center; width: 100%; margin-top: 50%; margin-left: 75%;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>';

    this.init = function (option) {
        this.url = option.url;
        this.objView = option.view;
        this.loadAjax();
    };

    this.loadAjax = function () {
        var curent = this;
        $.ajax({
            url: this.url,
            type: this.type,
            dataType: "json",
            async: false,
            data: {
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            success: function (result) {
//                alert(111);
                curent.data = result;
                curent.action('danh_sach');
            }
        });
    };

    this.check = function () {
        if (this.data.length == 0) {
            return false;
        } else {
            return true;
        }
    };

    this.show = function (page) {

    };

    this.view = function (html) {
        this.objView.html(html);
    };

    this.action = function (act) {
        if (this.check()) {
            switch (act) {
                case 'danh_sach':
                    this.list();
                    break;
                case 'luyen_viet':
                    this.hoc(1);
                    break;
                case 'kiem_tra_bai_cu':
                    break;
//                case '':
//                    break;
                default:
                    alert('Lỗi!');
//                    this.list();
            }
        } else {
            this.view(this.emty);
        }
    };

    this.list = function () {
        $('#main-title').html('Bài học hôm nay')
        this.view(this.loading);
        var html = '';
        var start = 0;
        var end = this.data.length;
        html += '<div class="tabs">';
        for (var i = start; i < end; i++) {
            html += '<div class="tab">';

            html += '<input type="radio" id="tab-' + (i + 1) + '" name="tab-group"';
            if (i == 0) {
                html += 'checked>';
            } else {
                html += '>';
            }
            html += '<label for="tab-' + (i + 1) + '">' + this.data[i]['word'] + '</label>';
            html += '<div class="tab-content">';
            html += '<div class="item" data-id="' + i + '">';
            html += '<audio class="sound" src="' + this.data[i]['sound'] + '" style="display: none;"></audio>';
            html += '<img src="' + this.data[i]['image'] + '">';
            html += '<div class="profile">';
            html += '<div class="word">' + this.data[i]['word'] + '<small>' + this.data[i]['spell'] + '</small><i class="fa fa-headphones" aria-hidden="true"></i></div>';
            html += '<div class="thongtin"><b>Mean:</b> ' + this.data[i]['mean'] + '<br><br>';
            html += '<b>Example:</b><br>';
            html += this.data[i]['example'];
            html += '<div class="mean_example">' + this.data[i]['mean_ex'] + '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }
        html += '</div>';
        this.view(html);
        this.add_av_list();
    };

    this.hoc = function (ma_tu) {
//        alert(ma_tu);
        var html = '';
        html += '<div>';
        html += '<audio src="' + this.data[ma_tu]['sound'] + '"></audio>';
        html += '<img src="' + this.data[ma_tu]['image'] + '" class="anh"/>';
        html += '</div>';
        html += '<div class="doremon_noi" id="doremon_noi">Đây là câu nói của Doremon, Doremon gợi ý để trả lời câu hỏi Đây là câu nói của Doremon</div>';
        html += '<div class="doremon" style="float: right;"></div>';
        html += '<div class="goi_y">';
        html += '<b>Mean:</b> ' + this.data[ma_tu]['mean'];
        html += '</div>';
        html += '<div>';
        html += '<input type="text" class="tra_loi" id="tra_loi"/>';
        html += '</div>';

        this.view(html);
        this.dang_hoc = this.data[ma_tu];
        this.add_av_hoc();
    };

    this.add_av_list = function () {
        //Thêm các sự kiện phát âm TỪ
        $('.word').on('click', 'i', function () {
            var curAudio = $(this).parents('.item').find('audio');
            var allAudio = $('.sound');
            $.each(allAudio, function (ind, val) {
                $(this).get(0).pause();
                $(this).get(0).currentTime = 0;
            });
            curAudio.get(0).play();
        });
    };

    //==========================================================================
    //Các hàm phục vụ cho quá trình học 1 từ
    this.noi = function (cau, img) {
        var curent = this;
        var caunoi = '';
        var time_dl = 3000;
        caunoi = curent.doremon_noi[cau].noi;
        var disp = $('#doremon_noi').css('display');

        if (curent.doremon_noi[cau].dem == 0) {

            if (disp == 'none') {

                curent.drm_bg(curent.doremon_image[img]);
                $('#doremon_noi').html(caunoi);

                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
                    top: '-=40%',
                    left: '-=40%'
                }, 'slow').delay(time_dl);

                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
                    top: '+=40%',
                    left: '+=40%'
                }, 'slow', function () {
                    curent.drm_bg(curent.doremon_image['bt']);
                });

                curent.doremon_noi[cau].dem++;


            }
        } else {
            curent.doremon_noi[cau].dem++;
        }
        if (curent.doremon_noi[cau].dem > 3) {
            curent.doremon_noi[cau].dem = 0;
        }
    };

    this.goi_y = function () {
        var curent = this;
        var caunoi = '';
        var time_dl = 3000;
        var goi_y = '';

        var disp = $('#doremon_noi').css('display');

        if (curent.doremon_noi.kho.dem == 0) {

            if (disp == 'none') {

                //Tính toán câu nói và gợi ý
                switch (curent.doremon_noi.goi_y.dem) {
                    case 0:
                        curent.doremon_noi.goi_y.luu += 'từ này có ' + curent.dang_hoc['word'].length + ' chữ cái';
                        caunoi = curent.doremon_noi.kho.noi;
                        goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                        break;
                    case 1:
                        curent.doremon_noi.goi_y.luu += ', bắt đầu bằng chữ ' + curent.dang_hoc['word'][0];
                        caunoi = curent.doremon_noi.them_goi_y.noi;
                        goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                        break;
                    case 2:
                        curent.doremon_noi.goi_y.luu += ', kết thúc bằng chữ ' + curent.dang_hoc['word'].slice(-1);
                        caunoi = curent.doremon_noi.them_goi_y.noi;
                        goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                        break;
                    default :
                        caunoi = curent.doremon_noi.het_goi_y.noi;
                        goi_y = curent.doremon_noi.goi_y.luu;
                }

                curent.doremon_noi.goi_y.dem++;

                curent.drm_bg(curent.doremon_image.tim_goi_y);
                $('#doremon_noi').html(caunoi);

                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
                    top: '-=40%',
                    left: '-=40%'
                }, 'slow').delay(time_dl);

                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
                    top: '+=40%',
                    left: '+=40%'
                }, 'slow', function () {
                    //Hiện xong câu nói thì hiện gợi ý
                    //Hiện gợi ý
                    curent.drm_bg(curent.doremon_image['goi_y']);
                    $('#doremon_noi').html(goi_y);

                    $("#doremon_noi").animate({
                        width: 'toggle',
                        height: 'toggle',
                        opacity: 'toggle',
                        fontSize: 'toggle',
                        top: '-=40%',
                        left: '-=40%'
                    }, 'slow').delay(time_dl);
                    $("#doremon_noi").animate({
                        width: 'toggle',
                        height: 'toggle',
                        opacity: 'toggle',
                        fontSize: 'toggle',
                        top: '+=40%',
                        left: '+=40%'
                    }, 'slow', function () {
                        curent.drm_bg(curent.doremon_image['bt']);
                    });
                });

                curent.doremon_noi.kho.dem++;

            }
        } else {
            curent.doremon_noi.kho.dem++;
        }
        if (curent.doremon_noi.kho.dem > 3) {
            curent.doremon_noi.kho.dem = 0;
        }

    };


    this.fix_image_doremon_noi = function () {
        var w_n, h_n;
        $('.doremon_noi').css('width', '55%');
        w_n = $('.doremon_noi').innerWidth();
        h_n = w_n * 0.48;
        $('.doremon_noi').css('height', h_n);
        $('.doremon_noi').css('font-size', w_n / 18);
    };

    this.fix_image_doremon = function () {
        var w, h;
        w = $('.doremon').innerWidth();
        h = w * 1.16;
        $('.doremon').css('height', h);
    };

    this.drm_bg = function (stt) {
        if (stt > 10 || stt == null || stt < 0) {
            stt = 0;
        }
        $('.doremon').css('background-position', (stt * 10) + '%');
    };


    this.add_av_hoc = function () {
        var curent = this;
        $('#main-title').html('Cùng luyện từ nào');

        $('#tra_loi').on('focus', function () {
            if (curent.so_lan_nghe == 0) {
                curent.noi('nghe', 'ngoi');
            } else {
//                curent.drm_bg(0);
//                curent.doremon_noi.nghi.count == 0;
                curent.noi('nghi', 'vui');
            }
        });

        $('#tra_loi').on('blur', function () {
//            alert(curent.so_lan_nghe+' '+curent.doremon_noi.nghe_nhieu.dem);
            if (curent.so_lan_nghe > 4 && curent.doremon_noi.nghe_nhieu.dem > 0) {
                curent.goi_y();
//                curent.doremon_noi.goi_y.luu += 'từ này bắt đầu bằng chữ ' + curent.dang_hoc['word'].slice(-1);
//
//                curent.noi('kho', 'tim_goi_y');
//                $("#doremon_noi").delay(3000);

//                curent.drm_bg(2);
//                curent.noi(2);
            } else {

            }
        });



        $('.anh').on('click', function () {
            curent.so_lan_nghe++;
            $(this).parent().find('audio').get(0).play();
            curent.noi('nghe_nhieu', 'bt');
        });

        this.fix_image_doremon();
        this.fix_image_doremon_noi();
        $("#doremon_noi").animate({
            width: 'toggle',
            height: 'toggle',
            opacity: 'toggle',
            fontSize: 'toggle',
            top: '+=40%',
            left: '+=40%'
        }, 'slow');

        $(window).on("resize", function () {
            curent.fix_image_doremon();
            curent.fix_image_doremon_noi();
        });
    };
    return this;
}