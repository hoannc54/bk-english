<?php
$trang_chu = route('getHome');
$hom_nay = route('getHome');
$chua_hoc = route('getHome');
$da_thuoc = route('getHome');
//$ca_nhan = route('admin');
//echo $ca_nhan;
$url_curent = URL::current();
$a = substr($url_curent, 0, strlen($trang_chu));
$link = NULL;
if(strcmp($a, $trang_chu)==0){
    $link='trangchu';
}
?>
<ul>
    <li class="<?php echo $link=='trangchu' ? 'active' : '' ?>"><a href="{!! route('getHome') !!}" >Trang chủ</a></li>

    <?php
    if (Auth::user()->level == 1) {
        echo '<li><a href="' . route('admin.home') . '">Trang quản lý</a></li>';
    }
    ?>

    <li class="<?php echo isset($homnay) ? 'active' : '' ?>"><a href="{!! route('getLearningList') !!}">Bài học hôm nay</a>
<!--        <ul>
            <li><a href="{!! route('getLearningList') !!}">Danh sách từ</a></li>
            <li><a href='#'>Phương pháp học 1</a></li>
            <li><a href='#'>Phương pháp học 2</a></li>
        </ul>-->
    </li>
    <li class="<?php echo isset($dahoc) ? 'active' : '' ?>"><a href="{!! route('getNotLearn') !!}">Hộp từ chưa học</a></li>
    <li class="<?php echo isset($dathuoc) ? 'active' : '' ?>"><a href="{!! route('getLearned') !!}">Hộp từ đã thuộc</a></li>
    <li class="<?php echo isset($thongtin) ? 'active' : '' ?>"><a>Cá nhân</a>
        <ul>
            <li><a href='#'>Thông tin</a></li>
            <li><a href="{!! route('getLogout') !!}">Đăng xuất</a></li>
        </ul>
    </li>
</ul>