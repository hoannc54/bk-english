<ul>
    <li class="<?php echo isset($home) ? 'active' : '' ?>"><a href="{!! route('getHome') !!}" >Trang chủ</a></li>

    <?php
    if (Auth::user()->level == 1) {
        echo '<li><a href="' . route('admin.home') . '">Trang quản lý</a></li>';
    }
    ?>

    <li class="<?php echo isset($homnay) ? 'active' : '' ?>"><a href='#'>Bài học hôm nay</a>
        <ul>
            <li><a href='#'>Phương pháp học 1</a></li>
            <li><a href='#'>Phương pháp học 2</a></li>
        </ul>
    </li>
    <li class="<?php echo isset($dahoc) ? 'active' : '' ?>"><a href='#'>Hộp từ đã học</a></li>
    <li class="<?php echo isset($dathuoc) ? 'active' : '' ?>"><a href='#'>Hộp từ đã thuộc</a></li>
    <li class="<?php echo isset($thongtin) ? 'active' : '' ?>"><a href='#'>Cá nhân</a>
        <ul>
            <li><a href='#'>Thông tin</a></li>
            <li><a href="{!! route('getLogout') !!}">Đăng xuất</a></li>
        </ul>
    </li>
</ul>