var ListItems = {
    init: function () {

        var self = this;
        var Item = $(".list-wrap ul input").last().attr("name");
        var pos1 = Item.indexOf("[");
        var pos2 = Item.indexOf("]");
        var ItemId = Number(Item.slice(pos1 + 1, pos2)) + 1;

        $(".list-wrap .form-group .add").on('click', function () {
            self.addListItem(this, ItemId);
            ItemId = ItemId + 1;
        });

        $(".list-wrap .form-group .remove").on('click', function () {
            self.removeListItem(this, ItemId);
            ItemId = ItemId - 1;
        });

        //khởi tạo các giá trị đầu
        $(".remove").hide();
    },
    addListItem: function (el, id) {
        var Data = $(el).attr('data-insert-html'),
                parent = $(el).parent().parent().parent(),
                insertData = Data.replace(/id/gi, id);
        var insertPoint = parent.find('li').last();
        parent.find(".remove").show();

        $('<li class="new-item">' + insertData + '</li>').insertAfter(insertPoint);

    },
    removeListItem: function (el) {
        var parent = $(el).parent().parent().parent();
        var elToRemove = parent.find("li.new-item").last();
        elToRemove.on('animationend', function () {
            elToRemove.remove();
        });

        elToRemove.toggleClass("remove-item new-item");
        if (!parent.find("li.new-item").length) {
            parent.find(".remove").hide();
        }

    }

};

var showhide = {
    init: function () {
        var sh_id = $('.showhide').attr('showhide_id');
        if ($('.showhide').prop('checked') == true) {
            $('#' + sh_id).show();
        } else {
            $('#' + sh_id).hide();
        }
        $('.showhide').on('click', function () {
            var sh_id = $(this).attr('showhide_id');
            if ($(this).prop('checked') == true) {
                $('#' + sh_id).show();
            } else {
                $('#' + sh_id).hide();
            }
        });
    }
};


ListItems.init();
showhide.init();