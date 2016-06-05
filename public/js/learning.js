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
                    this.hoc('kkk');
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
        alert(ma_tu);
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
    return this;
}