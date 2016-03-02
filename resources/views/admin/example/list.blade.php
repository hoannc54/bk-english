<?php
$example_manage = 'active';
?>
@extends('admin.template')

@section('main-title','Danh sách câu ví dụ')

@section('content')
<?php
if (count($data) == 0) {
    echo '<h4>Danh sách trống!</h4>';
} else {
    ?>
    <table class="table table-hover list">
        <thead>
            <tr>
                <th>STT</th>
                <th>Câu ví dụ</th>
                <th>Nghĩa</th>
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
                    <td>{!! $item->example !!}</td>
                    <td>{!! $item->mean !!}</td>
                    <td><a href="{!! route('admin.example.getEdit', $item['id']) !!}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td>
                        <form action="{!! route('admin.example.postDelete') !!}" method="post" class="f_delete">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                            <input type="hidden" name="ids" value="{!! $item['id'] !!}"/>
                            <input type="hidden" name="action" value="delete"/>
                            <span class="glyphicon glyphicon-remove b_delete action"></span>
                        </form>
                    </td>
                    <td><input class="item" type="checkbox" id="{!! $item['id'] !!}"></td>
                </tr>
                <?php
                $id ++;
            }
            ?>
            <tr>
                <td colspan="6">
                    <form action="{!! route('admin.example.postDelete') !!}" method="post" class="f_delete">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                        <input type="hidden" id="id_all" name="ids" value=""/>
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


