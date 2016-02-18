<?php
$example_manage = 'active';
?>
@extends('admin.template')

@section('main-title','Danh sách từ')

@section('content')
<?php
if (count($data) == 0) {
    echo '<h4>Danh sách trống!</h4>';
} else {
    ?>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Câu ví dụ</th>
                <th>Nghĩa</th>
                <th>Edit</th>
                <th>Delete</th>
                <th><label class="checkbox-inline"><input type="checkbox"> Check All</label></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id = 1;

            foreach ($data as $item) {
                ?>
                <tr class="">
                    <td>{!! $id !!}</td>
                    <td>{!! $item->example !!}</td>
                    <td>{!! $item->mean !!}</td>
                    <td><a href="{!! route('admin.example.getEdit', $item['id']) !!}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td><a href="{!! route('admin.example.getDelete', $item['id']) !!}"><span class="glyphicon glyphicon-remove"></span></a></td>
                    <td><input type="checkbox"></td>
                </tr><?php
                $id ++;
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
@endsection


