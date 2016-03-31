<?php
$user_manage = 'active';
?>
@extends('admin.template')

@section('main-title','Danh sách thành viên')

@section('content')
<?php
if (!isset($data) || count($data) == 0) {
    echo '<h4>Không có thành viên nào</h4>';
} else {
    ?>
    <table class="table table-hover list">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên đăng nhập</th>
                <th>Email</th>
                <th>Cấp độ</th>
                <th>Edit</th>
                <th>Delete</th>
                <th><input type="checkbox" class="check-all"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id = 1;

            foreach ($data as $item) {
                ?>
                <tr>
                    <td>{!! $id !!}</td>
                    <td>{!! $item->name !!}</td>
                    <td>{!! $item->email !!}</td>
                    <td><?php if($item->level==2) echo 'Admin'; else echo 'Member'; ?></td>
                    <td><a href="{!! route('admin.user.getEdit', $item['id']) !!}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td>
                        <form action="{!! route('admin.user.postDelete') !!}" method="post" class="f_delete">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <input type="hidden" name="ids" value="{!! $item->id !!}"/>
                            <input type="hidden" name="action" value="delete"/>
                            <span class="glyphicon glyphicon-remove b_delete action"></span>
                        </form>
                    </td>

                    <td><input type="checkbox" class="item" id="{!! $item->id !!}"></td>
                </tr>
                <?php
                $id++;
            }
            ?>

            <tr>
                <td colspan="9">
                    <form action="{!! route('admin.user.postDelete') !!}" method="post" class="f_delete">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <input type="hidden" id="id_all" name="ids" value="1"/>
                        <input type="hidden" name="action" value="delete"/>
                        <div id="sb_all" class="col-xs-offset-9 action">Xóa các mục đã chọn <span class="glyphicon glyphicon-trash"></span></div>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>
@endsection


