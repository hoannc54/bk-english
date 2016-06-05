function learn() {
    this.url = '';
    this.objView = '';
    this.type = 'get';
    this.data = '';
    this.maxPage = 1;
    this.length1page = 2;
//    Các biến thông báo
    this.emty = '<div style="text-align: center;">Danh sách trống.</div>';
    this.loading = '<div style="text-align: center;"><i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i></div>';
    this.init = function (option) {
        this.url = option.url;
        this.objView = option.view;
        this.view(this.loading);
        this.loadAjax();
//        alert( this.url);
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
            error: function (jqXHR, textStatus, errorThrown ){
                alert(errorThrown);
            },
            success: function (result) {
//                alert(111);
                curent.data = result;
                curent.action();
            }
        });
    };
    this.check = function () {
//        alert(this.data.length);
        if (this.data.length==0) {
            return false;
        } else {
            return true;
        }
    };
    this.show_pagination = function (curentPage) {
//        curentPage = 10;
        if (curentPage >= this.maxPage || curentPage < 0) {
            curentPage = 0;
        }
        var html = '';
        html += '<ul class="pagination">';

        if (curentPage == 0) {
            html += '<li><a data-page = "1" class="active">1</a></li>';
        } else {
            html += '<li><a data-page = "1" class="">1</a></li>';
        }


        if (this.maxPage <= 10) {
            for (var i = 2; i < this.maxPage; i++) {
                if (curentPage == i - 1) {
                    html += '<li><a data-page = "' + i + '" class="active" >' + i + '</a></li>';
                } else {
                    html += '<li><a data-page = "' + i + '" class="" >' + i + '</a></li>';
                }
            }
        } else {

            var start = curentPage - 3;
            var end = curentPage + 3;
            if (start <= 1) {
                start = 1;
            }

            if (end >= (this.maxPage - 2)) {
                end = this.maxPage - 2;
            }

            if (curentPage > 4) {
                html += '<li><a class="none" >...</a></li>';
            }

            for (var i = start; i <= end; i++) {
                if (curentPage == i) {
                    html += '<li><a data-page = "' + (i + 1) + '" class="active" >' + (i + 1) + '</a></li>';
                } else {

                    html += '<li><a data-page = "' + (i + 1) + '" class="" >' + (i + 1) + '</a></li>';
                }

            }

            if (curentPage < (this.maxPage - 5)) {
                html += '<li><a class="none"  >...</a></li>';
            }
        }


        if (this.maxPage > 1) {
            if ((curentPage + 1) == this.maxPage) {
                html += '<li><a data-page = "' + this.maxPage + '" class="active" >' + this.maxPage + '</a></li>';
            } else {
                html += '<li><a data-page = "' + this.maxPage + '" class="" >' + this.maxPage + '</a></li>';
            }
        }
        html += '</ul>';
        return html;

    };
    this.show = function (page) {
        if (page > this.maxPage) {
            this.show(0);
        }
        var html = '';
        var pagination = this.show_pagination(page);
        var start = page * this.length1page;
        var end = start + this.length1page;
        if (this.data.length < end) {
            end = this.data.length;
        }


        html += '<div class="pag-top" >';
        html += pagination;
        html += '</div>';

        for (var i = start; i < end; i++) {
//            html += '<img src="' + this.data[i]['image'] + '"/>';
            html += '<div class="item" data-id="' + i + '">';
            html += '<img src="' + this.data[i]['image'] + '"/>';
            html += '<div class="profile">';
//        <!--<span>-->
            html += '<div class="word">' + this.data[i]['word'] + '<small>' + this.data[i]['spell'] + '</small><i class="fa fa-headphones" aria-hidden="true"></i></div>';
            html += '<div class="thongtin">';
//            ' . $this->chucvu . '<br/>
            html += 'Mean: ' + this.data[i]['mean'] + '<br>';

//            html += '<div class="col-12">';
            html += 'Example:<br/>';
//            if (this.data[i]['examples']) {
                html += '<div class="example">' + this.data[i]['example'] + '</div><div class="mean_example">' + this.data[i]['mean_ex'] + '</div>';
//            }
            html += '</div>';
            html += '</div>';
            html += '</div>';
        }

        html += '<div class="pag-bottom" >';
        html += pagination;
        html += '</div>';
        this.view(html);
        this.add_av();
    };
    this.view = function (html) {
        this.objView.html(html);
    };
    this.action = function () {
        this.maxPage = Math.ceil(this.data.length / this.length1page);
        if (this.check()) {
            this.show(0);
        } else {
            this.view(this.emty);
        }
    };
    this.add_av = function () {
        var curent = this;
        $('.pagination').on('click', 'li a:not(.active)', function () {
            var page = $(this).data('page');
            curent.show(page - 1);
        });
        $('.word').on('click', 'i', function () {
            var id = $(this).parents('.item').data('id');
            playSound(curent.data[id]['sound']);

        });
    };
    return this;
}