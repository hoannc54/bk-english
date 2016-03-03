
<ul class="nav nav-pills nav-stacked">
    <li class="{{ $home or '' }}"><a href="{!! route('admin') !!}">Trang chủ</a></li>
    <li class="{{ $word_manage or '' }}">
        <a data-toggle="collapse" href="#collapse1">Quản lý từ</a>
        <div id="collapse1" class="collapse">
            <ul class="list-group">
                <li class="list-group-item"><a href="{!! url('admin/words/add') !!}">Thêm từ mới</a></li>
                <li class="list-group-item"><a href="{!! route('admin.word.getList') !!}">Danh sách từ</a></li>
                <!--<li class="list-group-item"><a href="#">Three</a></li>-->
            </ul>
        </div>

    </li>
    <li class="{{ $example_manage or '' }}">
        <a data-toggle="collapse" href="#collapse2">Quản lý câu ví dụ</a>
        <div id="collapse2" class="collapse">
            <ul class="list-group">
                <li class="list-group-item"><a href="{!! route('admin.example.getAdd') !!}">Thêm câu mới</a></li>
                <li class="list-group-item"><a href="{!! route('admin.example.getList') !!}">Danh sách ví dụ</a></li>
                <!--<li class="list-group-item"><a href="#">Three</a></li>-->
            </ul>
        </div>

    </li>
    <li class="{{ $user_manage or '' }}">
        <a data-toggle="collapse" href="#collapse3">Quản lý thành viên</a>
        <div id="collapse3" class="collapse">
            <ul class="list-group">
                <li class="list-group-item"><a href="#">Thêm thành viên mới</a></li>
                <li class="list-group-item"><a href="#">Danh sách thành viên</a></li>
                <!--<li class="list-group-item"><a href="#">Three</a></li>-->
            </ul>
        </div>
    </li>
</ul>