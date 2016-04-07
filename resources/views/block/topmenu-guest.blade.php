
<ul>
    <li class="<?php echo isset($home)?'active':'' ?>"><a href="{!! route('getHome') !!}" >Trang chủ</a></li>
    <li class="<?php echo isset($login)?'active':'' ?>"><a href="{!! route('getLogin') !!}">Đăng nhập</a></li>
    <li class="<?php echo isset($register)?'active':'' ?>"><a href="{!! route('getRegister') !!}">Đăng kí</a></li>
</ul>