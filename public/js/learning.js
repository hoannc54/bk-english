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
    this.id_dang_hoc = 0;
    //biến dùng cho học từ
    this.update_url = '';
    this.token = '';
    this.cap_nhat = false;
    this.doremon_noi = null;
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
    this.traloi = '';
    this.co = true;
    this.so_lan_nghe = 0;
    //Biến dùng cho ôn tập
    this.test_data = null;
    this.test_url = '';
    this.test_up_url = '';
    this.test_id = null;
    //Các biến thông báo
    this.emty = '<div style="text-align: center;">Danh sách trống.</div>';
    this.loading = '<div style="text-align: center; width: 100%; margin-top: 50%; margin-left: 75%;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>';
    this.init = function (option) {
        this.url = option.url;
        this.objView = option.view;
        this.update_url = option.update_url;
        this.test_url = option.test_url;
        this.test_up_url = option.test_up_url;
        this.token = option._token;
        this.loadAjax();
        this.testLoadAjax();
        this.action('danh_sach');
    };
    this.loadAjax = function () {
        var curent = this;
        $.ajax({
            url: curent.url,
            type: curent.type,
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
                console.log('load danh sách từ thành công');
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
//    this.show = function (page) {
//
//    };
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
                    this.hoc();
                    break;
                case 'kiem_tra_bai_cu':
                    this.test();
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
//==============================================================================
//Hàm hiển thị danh sách
    this.list = function () {
        $('#main-title').html('Bài học hôm nay');
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
//==============================================================================
//Các hàm phục vụ cho việc học
    this.khoi_tao_hoc = function () {
        this.doremon_noi = {
            chao: {noi: 'Cùng học từ nào!', dem: 0},
            nghe: {noi: 'Bạn bấm vào ảnh để nghe phát âm nhé.', dem: 0}, //0
            nghi: {noi: 'Hãy nghĩ kĩ trước khi trả lời nhé. Từ này khó lắm nha.', dem: 0}, //1
            nghe_nhieu: {noi: 'Hãy nghe phát âm nhiều lần để tìm ra đáp án đúng nhé', dem: 0}, //2
            dung: {noi: ['Đáp án đúng rồi. Bạn thật là giỏi. :) :) :)', 'Đó là đáp án đúng, hoan hô bạn.'], dem: 0, dem2: 0}, //3
            kho: {noi: 'Khó lắm à, để tớ tìm gợi ý nha.', dem: 0}, //4
            goi_y: {noi: 'Có gợi ý đây:', dem: 0, luu: ''}, //5
            gan_dung: {noi: 'Bạn trả lời gần đúng rồi đấy. Còn vài chữ cái nữa thôi.', dem: 0}, //6
            sai: {noi: ['Sai rồi kìa.', 'Lại sai rồi kìa.', 'Vẫn còn sai.', 'Sai rồi.'], dem: 0, dem2: 0}, //7
            sai_bet: {noi: [
                    'Câu trả lời sai. Đáp án đúng là <b>' + this.dang_hoc.word + '</b>',
                    'Bạn đã trả lời sai. <b>' + this.dang_hoc.word + '</b> mới là đáp án đúng.'
                ], dem: 0}, //8

            them_goi_y: {noi: 'Để tớ tìm xem còn gợi ý nào không.', dem: 0}, //9
            het_goi_y: {noi: 'Hết gợi ý mới rồi. Bạn xem lại các gợi ý cũ nha.', dem: 0}, //10
            doi_tu: {noi: 'Vẫn sai kìa. Nếu chưa tìm ra đáp án ngay bây giờ có thể đổi từ khác.', dem: 0}, //11
            im_lang: {noi: '...', dem: 0}
        };
        this.traloi = '';
        this.co = true;
        this.so_lan_nghe = 0;
        this.cap_nhat = false;
    };
    this.hoc = function () {
        var ma_tu = this.id_dang_hoc;
        this.dang_hoc = this.data[ma_tu];
        this.khoi_tao_hoc();
//        alert(ma_tu);
        var html = '';
        html += '<div>';
        html += '<audio src="' + this.data[ma_tu]['sound'] + '"></audio>';
        html += '<img src="' + this.data[ma_tu]['image'] + '" class="anh"/>';
        html += '</div>';
//        html += '<div class="doremon_noi" id="doremon_noi">Cùng học từ nào!</div>';
        html += '<div class="doremon" style="float: right;"><div class="doremon_noi" id="doremon_noi"><div id="noi" class="noi">Cùng học từ nào!</div></div></div>';
        html += '<div class="goi_y">';
        html += '<b>Mean:</b> ' + this.data[ma_tu]['mean'];
        html += '</div>';
        html += '<div style="width=50%;">';
        html += '<input type="text" class="tra_loi" id="tra_loi"/>';
        html += '<div class="nex_pre">';
        html += '<i id="pre" class="fa fa-arrow-circle-o-left" aria-hidden="true" style="float:left;cursor: pointer;" title="Previous"></i>';
        html += '<i id="nex" class="fa fa-arrow-circle-o-right" aria-hidden="true" style="float:right;cursor: pointer;" title="Next"></i>';
        html += '</div>';
        html += '</div>';
        this.view(html);
//        this.
        this.add_av_hoc();
    };
    //co thuộc tính có sử dùng cờ hay không
    //tf thuộc tính luôn hiện: true = luôn hiên, false = tùy theo biến dem
    //max giá trị để biến đếm trở về 0
    this.noi = function (cau, img, time_dl, co, tf, max, cal_back, da) {
//        var a = cal_back;
        var curent = this;
        var caunoi = '';
        var hien = false;
//        var time_dl = 3000;

//        $('#message').html($('#doremon_noi').queue().length + ' ' + curent.doremon_noi.sai.dem2 + ' ' + curent.doremon_noi.kho.dem);
        if (typeof max != 'number') {
            max = 3;
//            alert(typeof max);
        }
        if (typeof time_dl != 'number') {
            time_dl = 3000;
//            alert(typeof max);
        }
        if (typeof tf != 'boolean') {
            tf = false;
//            alert(typeof tf);
        }
        if (typeof co != 'boolean') {
            co = false;
//            alert(typeof tf);
        }
//        co = co | curent.co;
        if (cau == 'sai' || cau == 'sai_bet' || cau == 'dung' || cau == 'chon') {
            var id_sai = Math.floor((Math.random() * curent.doremon_noi[cau].noi.length));

//            if (cau == 'sai' && curent.doremon_noi.sai.dem2 < 1) {
//                id_sai = 0;
//            }
//            alert(id_sai);
            caunoi = curent.doremon_noi[cau].noi[id_sai];
        } else {
            caunoi = curent.doremon_noi[cau].noi;
        }
//        var disp = $('#doremon_noi').css('display');


        //nếu tf == true thì luôn hiện
        //Ngược lại phải kiểm tra dem = 0 mới hiện
        if (tf == true) {
            //Nếu sử dụng cờ thì khi cờ được giương lên mới hiện
            //Đồng thời hạ cờ xuống
            if (co) {
                if (curent.co == true) {
                    hien = true;
                    curent.co = false;
                }
            } else {
                hien = true;
            }
        } else {
            if (curent.doremon_noi[cau].dem == 0) {
                //Nếu sử dụng cờ thì khi cờ được giương lên mới hiện
                //Đồng thời hạ cờ xuống
                if (co) {
                    if (curent.co == true) {
                        hien = true;
                        curent.co = false;
                    } else {
                        //Nếu không có cờ thì giảm biến đếm
                        curent.doremon_noi[cau].dem--;
                    }
                }
            }
            //Tính toán biến đếm
            curent.doremon_noi[cau].dem++;
            if (curent.doremon_noi[cau].dem >= max) {
                curent.doremon_noi[cau].dem = 0;
            }
        }



        if (hien) {

            //Nếu thuộc tính luôn hiện là true
            //Thuộc tính cờ là false
            //kết thúc tất cả các hiệu ứng trước
            //Chờ cho cờ nổi lên
            if (co == false) {
                $('#doremon_noi').finish();
                while (curent.co == false)
                    ;
            }
            if (typeof da != 'undefined') {
                caunoi += ' ' + da;
            }
            curent.drm_bg(curent.doremon_image[img]);
            $('#noi').html(curent.doremon_noi.im_lang.noi);
            $("#doremon_noi").animate({
                width: 'toggle',
                height: 'toggle',
                opacity: 'toggle',
                fontSize: 'toggle',
//                top: '14%',
//                left: '46%'

                top: 'toggle',
                left: 'toggle'
            }, 'slow', function () {
                $('#noi').html(caunoi);
            }).delay(time_dl);
            $("#doremon_noi").animate({
                width: 'toggle',
                height: 'toggle',
                opacity: 'toggle',
                fontSize: 'toggle',
//                top: '54%',
//                left: '86%'

                top: 'toggle',
                left: 'toggle'
            }, 'slow', function () {
                curent.drm_bg(curent.doremon_image['bt']);
                //Giương cờ cho hiệu ứng tiếp theo dùng
                if (co) {
                    curent.co = true;
                }
                if (typeof cal_back == 'function') {
                    cal_back();
                }
            });
        }
    };
    this.goi_y = function (co, cal_back) {
        var curent = this;
        var caunoi = '';
        var time_dl = 4000;
        var goi_y = '';
        var hien = false;
        if (typeof co != 'boolean') {
            co = false;
        }

        if (curent.doremon_noi.kho.dem == 0) {
            if (co) {
                if (curent.co) {
                    hien = true;
                    curent.co = false;
                } else {
                    hien = false;
                    curent.doremon_noi.kho.dem--;
                }
            } else {
                hien = true;
            }
        }
        curent.doremon_noi.kho.dem++;
        if (curent.doremon_noi.kho.dem > 3) {
            curent.doremon_noi.kho.dem = 0;
        }


        if (hien) {

            //Tính toán câu nói và gợi ý
            switch (curent.doremon_noi.goi_y.dem) {
                case 0:
                    curent.doremon_noi.goi_y.luu += 'từ này bắt đầu bằng chữ <b>' + curent.dang_hoc['word'][0] + '</b>';
                    caunoi = curent.doremon_noi.kho.noi;
                    goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                    time_dl = 4000;
                    break;
                case 1:
                    curent.doremon_noi.goi_y.luu += ', có phát âm là <b>' + curent.dang_hoc['spell'] + '</b>';
                    caunoi = curent.doremon_noi.them_goi_y.noi;
                    goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                    time_dl = 4000;
                    break;
                case 2:
                    curent.doremon_noi.goi_y.luu += ', có <b>' + curent.dang_hoc['word'].length + '</b>' + ' chữ cái';
                    caunoi = curent.doremon_noi.them_goi_y.noi;
                    goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                    time_dl = 4000;
                    break;
                case 3:
                    curent.doremon_noi.goi_y.luu += ', kết thúc bằng chữ <b>' + curent.dang_hoc['word'].slice(-1) + '</b>';
                    caunoi = curent.doremon_noi.them_goi_y.noi;
                    goi_y = curent.doremon_noi.goi_y.noi + ' ' + curent.doremon_noi.goi_y.luu;
                    time_dl = 5000;
                    break;
                default :
                    caunoi = curent.doremon_noi.het_goi_y.noi;
                    goi_y = curent.doremon_noi.goi_y.luu;
                    time_dl = 5000;
            }

            curent.doremon_noi.goi_y.dem++;
            curent.drm_bg(curent.doremon_image.tim_goi_y);
            $('#noi').html(curent.doremon_noi.im_lang.noi);
            $("#doremon_noi").animate({
                width: 'toggle',
                height: 'toggle',
                opacity: 'toggle',
                fontSize: 'toggle',
//                top: '14%',
//                left: '46%'

                top: 'toggle',
                left: 'toggle'
            }, 'slow', function () {
                $('#noi').html(caunoi);
            }).delay(time_dl);
            $("#doremon_noi").animate({
                width: 'toggle',
                height: 'toggle',
                opacity: 'toggle',
                fontSize: 'toggle',
//                top: '54%',
//                left: '86%'

                top: 'toggle',
                left: 'toggle'
            }, 'slow', function () {
                //Hiện xong câu nói thì hiện gợi ý
                //Hiện gợi ý
                curent.drm_bg(curent.doremon_image['goi_y']);
                $('#noi').html(goi_y);
                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
//                    top: '14%',
//                    left: '46%'

                    top: 'toggle',
                    left: 'toggle'
                }, 'slow').delay(time_dl);
                $("#doremon_noi").animate({
                    width: 'toggle',
                    height: 'toggle',
                    opacity: 'toggle',
                    fontSize: 'toggle',
//                    top: '54%',
//                    left: '86%'

                    top: 'toggle',
                    left: 'toggle'
                }, 'slow', function () {
                    curent.drm_bg(curent.doremon_image['bt']);
                    if (co) {
                        curent.co = true;
                    }
                    if (typeof cal_back == 'function') {
                        cal_back();
                    }
                });
            });
        }
    };
    this.update_learning = function (kq) {
        if (this.cap_nhat == false) {
            var curent = this;
            var id = this.dang_hoc.id;
            var update_result;
            $.ajax({
                method: "POST",
                url: curent.update_url,
                dataType: "json",
                async: false,
                data: {id: id, kq: kq, _token: curent.token},
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                },
                success: function (result) {
                    update_result = result;
                    console.log('Update thành công: ' + id + ' ' + kq);
                }
            });
            if (update_result['status'] == 'error') {
                console.log('Không cập nhật được lên hệ thống. Lỗi: ' + update_result.message);
            } else {
                this.cap_nhat = true;
            }
            if (kq == true) {
                curent.loadAjax();
            }
        }
    };
    this.fix_image_doremon_noi = function () {
        var w_n, h_n;
        $('.doremon_noi').css('width', '200%');
        w_n = $('.doremon_noi').innerWidth();
        h_n = w_n * 0.48;
        $('.doremon_noi').css('height', h_n);
        $('.doremon_noi').css('font-size', w_n / 20);
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
    this.tl_dung = function () {
        var curent = this;
        var leng_cl = curent.dang_hoc['word'].length - curent.traloi.length;
        $('#tra_loi').css('color', 'blue');
        switch (leng_cl) {
            case 0:
                $('#tra_loi').prop('disabled', 'disabled');
                $('#tra_loi').addClass('tl_dung');
                curent.noi('dung', 'vui', 3000, false, true);
                this.update_learning(true);
                break;
            case 2:
                curent.noi('gan_dung', 'gio_chan', 3000, true, true);
                break;
            default :
                ;
        }
    };
    this.tl_sai = function () {
        var curent = this;
        $('#tra_loi').css('color', 'red');
        curent.doremon_noi.sai.dem2++;
        if (curent.doremon_noi.sai.dem2 < 25) {

            curent.noi('sai', 'sai', 3000, true, false, 2, function () {

                if (curent.doremon_noi.sai.dem2 >= 5) {
                    curent.goi_y(true);
//                    curent.noi('sai', 'sai', true, false, 2);
                }
            });
        } else if (curent.doremon_noi.sai.dem2 < 30) {

            curent.noi('doi_tu', 'sai', 3000, true);
        } else {
            $('#tra_loi').prop('disabled', 'disabled');
            curent.noi('sai_bet', 'sai_bet', 5000, false, true, 3, function () {
                $('#nex').click();
            });
            this.update_learning(false);
        }

    };
    this.add_av_hoc = function () {
        var curent = this;
        $('#main-title').html('Cùng luyện từ nào');
        $('#tra_loi').on('focus', function () {
            if (curent.so_lan_nghe == 0) {
                curent.noi('nghe', 'ngoi', 3000, true);
            } else {
                curent.noi('nghi', 'vui', 3000, true);
            }
        });
        $('#tra_loi').on('blur', function () {
            if (curent.so_lan_nghe > 4 && curent.doremon_noi.nghe_nhieu.dem > 0) {
                curent.goi_y(true);
            }
        });
        $('#tra_loi').on('keyup', function () {
//            curent.update_learning(true);
            curent.traloi = $(this).val();
            var so_sanh = curent.dang_hoc['word'].substr(0, curent.traloi.length);
            if (curent.traloi != so_sanh) {
                curent.tl_sai();
            } else {
                curent.tl_dung();
            }
//            alert(curent.dang_hoc['word'].substr(0, curent.traloi.length));
        });
//        $('#tra_loi').on('click', function () {
//            alert($(this).prop('disabled'));
//            if ($(this).prop('disabled') == 'disabled') {
//                $('#nex').click();
//            }
//        });

        $('#nex').on('click', function () {
            if (curent.doremon_noi.sai.dem2 > 20) {
                curent.update_learning(false);
            }
            curent.id_dang_hoc++;
            if (curent.id_dang_hoc >= curent.data.length) {
                curent.id_dang_hoc = 0;
            }
            curent.hoc();
//            alert(222);
        });
        $('#pre').on('click', function () {
            if (curent.doremon_noi.sai.dem2 > 20) {
                curent.update_learning(false);
            }
            curent.id_dang_hoc--;
            if (curent.id_dang_hoc < 0) {
                curent.id_dang_hoc = curent.data.length - 1;
            }
            curent.hoc();
//            alert(333);
        });
        $('.anh').on('click', function () {
            curent.so_lan_nghe++;
            $(this).parent().find('audio').get(0).play();
            curent.noi('nghe_nhieu', 'bt', 3000, true, false);
        });
        this.fix_image_doremon();
        this.fix_image_doremon_noi();
        this.co = false;
        $("#doremon_noi").delay(2000).animate({
            width: 'toggle',
            height: 'toggle',
            opacity: 'toggle',
            fontSize: 'toggle',
//            top: '54%',
//            left: '86%'


            top: 'toggle',
            left: 'toggle'
        }, 'slow', function () {
            curent.co = true;
        });
        $(window).on("resize", function () {
            curent.fix_image_doremon();
            curent.fix_image_doremon_noi();
        });
    };
    this.testLoadAjax = function () {
        var curent = this;
        $.ajax({
            url: curent.test_url,
            type: curent.type,
            dataType: "json",
            async: false,
            data: {
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            },
            success: function (result) {
//                alert(111);
                curent.test_data = result;
                console.log('load danh sách từ đã học thành công');
                console.log(result);
            }
        });
    };
    this.khoi_tao_test = function () {
        var curent = this;
        this.test_id = Math.floor((Math.random() * curent.test_data.length));
        this.so_lan_nghe = 0;
        this.doremon_noi = {
            chao: {noi: 'Cùng học từ nào!', dem: 0},
            nghe: {noi: 'Bạn bấm vào ảnh để nghe phát âm nhé.', dem: 0}, //0
            chua_chon: {noi: 'Bạn phải chọn đáp án trước khi bấm OK nha.', dem: 0}, //0
            chon: {noi: [
                    'Bạn bấm vào ảnh để nghe phát âm nhé.',
                    'Bạn có chắc chắn với đáp án của mình không.',
                    'Nếu bạn chắc chắn chọn đáp án đấy thì bấm OK nhé.',
                    'Hãy suy nghĩ kĩ trước khi chọn nha.'
                ], dem: 0, dem2: 0}, //7
            sai_bet: {noi: [
                    'Câu trả lời sai. Đáp án đúng:',
                    'Bạn phải học lại từ này rồi. Đáp án đúng:'
                ], dem: 0, dem2: 0}, //8
            dung: {noi: [
                    'Bạn chọn đúng rồi. Bạn thật là gỏi! :)',
                    'Bạn chọn đúng rồi. Chúng ta sang câu tiếp theo nhé! :)',
                    'Đấy là đáp án đúng. Hoan hô bạn.'
                ], dem: 0, dem2: 0}, //9
            im_lang: {noi: '...', dem: 0}
        };
//        alert(this.test_id);
    };

    this.next_test = function () {
        var curent = this;
        var html = '';
        this.test_id = Math.floor((Math.random() * curent.test_data.length));
        var maso = this.test_id;
        var arr = this.arr_test();
        this.so_lan_nghe = 0;
        html += '<div><input type="radio" id="pa_1" name="pa" class="phuong_an" value="' + arr[0] + '"/><label for="pa_1">' + this.test_data[arr[0]]['mean'] + '</label></div>';
        html += '<div><input type="radio" id="pa_2" name="pa" class="phuong_an" value="' + arr[1] + '"/><label for="pa_2">' + this.test_data[arr[1]]['mean'] + '</label></div>';
        html += '<div><input type="radio" id="pa_3" name="pa" class="phuong_an" value="' + arr[2] + '"/><label for="pa_3">' + this.test_data[arr[2]]['mean'] + '</label></div>';


        $('#audio').prop('src', curent.test_data[maso]['sound']);
        $('#anh').prop('src', curent.test_data[maso]['image']);
        $('#word_test').html(curent.test_data[maso]['word']);
        $('#pa').html(html);

        console.log('Load xong câu test mới.');

    };

    this.add_av_test = function () {
        var curent = this;
        $('.anh').on('click', function () {
            curent.so_lan_nghe++;
            $(this).parent().find('audio').get(0).play();
//            curent.noi('nghe', 'bt', 3000, true, false);
        });
        this.fix_image_doremon();
        this.fix_image_doremon_noi();
        this.co = false;
        $("#doremon_noi").delay(2000).animate({
            width: 'toggle',
            height: 'toggle',
            opacity: 'toggle',
            fontSize: 'toggle',
//            top: '54%',
//            left: '86%'


            top: 'toggle',
            left: 'toggle'
        }, 'slow', function () {
            curent.co = true;
        });
        $(window).on("resize", function () {
            curent.fix_image_doremon();
            curent.fix_image_doremon_noi();
        });

        $('#b_pa').on('click', function () {
            curent.dap_an();
        });

        $('#pa').on('click', 'input', function () {
//            alert(111);
            curent.noi('chon', 'ngoi', 3000, true, false);
        });

    };
    this.kt_trung = function (pt, arr) {
        var kq = false;
        for (var i = 0; i < arr.length; i++) {
            if (pt == arr[i]) {
                kq = true;
            }
        }
        return kq;
    };

    this.arr_test = function () {
        var arr = [];
        var k;
//        var i = 1;
        var can;
        var t;
        var max = this.test_data.length;
        console.log('Số từ đã học: ' + max + '.');
        arr[0] = this.test_id;
        if (max < 3) {
            can = max;
        } else {
            can = 3;
        }
        console.log('Số từ cần kiểm tra: ' + can);
        for (var i = 1; i < can; i++) {
            do {
                k = Math.floor((Math.random() * max));
            } while (this.kt_trung(k, arr));
            arr[i] = k;
        }

        //Trộn đáp án
        for (var i = 0; i < 4; i++) {
            k = Math.floor((Math.random() * can));
            t = arr[k];
            arr[k] = arr[can - k - 1];
            arr[can - k - 1] = t;
        }
        return arr;
    };

    this.up_test = function () {
        if (this.cap_nhat == false) {
            var kq = false;
            var curent = this;
            var id = this.test_data[this.test_id].id;
            var update_result;
            $.ajax({
                method: "POST",
                url: curent.test_up_url,
                dataType: "json",
                async: false,
                data: {id: id, kq: kq, _token: curent.token},
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                },
                success: function (result) {
                    update_result = result;
//                    console.log('Kết quả: '+result);
                    console.log('Gửi cập nhật test thành công: ' + id + ' ' + kq + ' lên hệ thống.');
//                    console.log('Kết quả: ' + update_result['status'] + ' ' + update_result.message);
                }
            });
            if (update_result['status'] == 'error') {
                console.log('Không cập nhật được lên hệ thống. Lỗi: ' + update_result.message);
            } else {
                this.cap_nhat = true;
            }
//            if (kq == true) {
            curent.testLoadAjax();
//            }
        }
    };

    this.dap_an = function () {
        var curent = this;
        var tl = $('#pa').find('input:checked').val();
        console.log('Câu trả lời ' + tl);
        if (typeof tl == 'undefined') {
            this.noi('chua_chon', 'gan_dung', 3000, true, true);
        } else {
            //Nếu trả lời đúng
            if (tl == this.test_id) {
                this.noi('dung', 'gio_chan', 3000, false, true);
                this.next_test();
            } else {
                var dung = '<b>' + this.test_data[this.test_id]['mean'] + '</b>';
                $('#pa').find('input').prop('disabled', 'disabled');
                $('#b_pa').hide();
                this.up_test();
                this.noi('sai_bet', 'sai_bet', 5000, false, true, 3, function () {
                    curent.next_test();
                    $('#b_pa').show();
                }, dung);
            }
        }
    };

    this.test = function () {
        this.khoi_tao_test();
        $('#main-title').html('Kiểm tra');

        var arr = this.arr_test();
        console.log(this.test_id);
        for (var i = 0; i < arr.length; i++) {
            console.log(arr[i] + ' ');
        }


        var maso = this.test_id;
        var html = '';
        if (this.test_data.length < 3) {
            html += 'Không có bài kiểm tra';
            this.view(html);
        } else {


            html += '<div style="height: 16em;">';
            html += '<audio id="audio" src="' + this.test_data[maso]['sound'] + '"></audio>';
            html += '<img src="' + this.test_data[maso]['image'] + '" class="anh" id="anh"/>';
            html += '</div>';
            html += '';
            html += '<div class="doremon" style="float: right;">';
            html += '<div class="doremon_noi" id="doremon_noi"><div id="noi" class="noi">Kiểm tra bài cũ!</div></div>';
            html += '</div>';
            html += '<div class="word_test" id="word_test">';
            html += this.test_data[maso]['word'];
            html += '</div>';
            html += '<div style="width=50%;" id="pa">';
            html += '<div><input type="radio" id="pa_1" name="pa" class="phuong_an" value="' + arr[0] + '"/><label for="pa_1">' + this.test_data[arr[0]]['mean'] + '</label></div>';
            html += '<div><input type="radio" id="pa_2" name="pa" class="phuong_an" value="' + arr[1] + '"/><label for="pa_2">' + this.test_data[arr[1]]['mean'] + '</label></div>';
            html += '<div><input type="radio" id="pa_3" name="pa" class="phuong_an" value="' + arr[2] + '"/><label for="pa_3">' + this.test_data[arr[2]]['mean'] + '</label></div>';
            html += '</div>';
            html += '<button id="b_pa" class="button blue b_pa">OK</button>';

            this.view(html);
            this.add_av_test();
        }
    };
    return this;
}