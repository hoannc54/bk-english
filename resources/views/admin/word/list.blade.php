@extends('admin.template')

@section('main-title','Quản lý tự vựng')

@section('sub-title','Danh sách từ')

@section('content')
<?php
if (count($data) == 0) {
    echo '<h4>Không có từ nào trong danh sách</h4>';
} else {
    ?>
    <table class="table table-hover list">
        <thead>
            <tr>
                <th>STT</th>
                <th>Word</th>
                <th>Spell</th>
                <th>Means</th>
                <th>Parent</th>
                <th>Examples</th>
                <th>Edit</th>
                <th>Delete</th>
                <th><input type="checkbox" class="check-all"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id = 1;

            foreach ($data as $item) {
                if ($item->parent_id == 0) {
                    ?>
                    <tr class="">
                        <td>{!! $id !!}</td>
                        <td>
                            <div
                                data-src-mp3="{!! url($item->sound) !!}" 
                                title="play sound" style="cursor: pointer" onclick="playSound($(this));">{!! $item->word !!}
                                <!-- End of DIV sound audio_play_button pron-uk icon-audio-->
                            </div>
                        </td>
                        <td>{!! $item->spell !!}</td>
                        <td>{!! $item->mean !!}</td>
                        <td>None</td>
                        <?php
                        $examples = $item->examples()->get();
                        ?>
                        <td>
                            <ul class="list-group">
                                <?php foreach ($examples as $ex) { ?>
                                    <li><a href="" title="{!! $ex->mean !!}">{!! $ex->example !!}</a></li>
                                <?php } ?>
                            </ul>
                        </td>
                        <?php
                        ?>
                        <td><a href="{!! route('admin.word.getEdit', $item['id']) !!}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td>
                            <form action="{!! route('admin.word.postDelete') !!}" method="post" class="f_delete">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                <input type="hidden" name="ids" value="{!! $item['id'] !!}"/>
                                <input type="hidden" name="action" value="delete"/>
                                <span class="glyphicon glyphicon-remove b_delete action"></span>
                            </form>
                        </td>

                        <td><input type="checkbox" class="item" id="{!! $item['id'] !!}"></td>
                    </tr>
                    <?php
                    $id++;

                    foreach ($data as $item_chil) {
                        if ($item_chil->parent_id == $item->id) {
                            ?>
                            <tr class="success">
                                <td>{!! $id !!}</td>
                                <td>{!! $item_chil->word !!}</td>
                                <td>{!! $item_chil->spell !!}</td>
                                <td>{!! $item_chil->mean !!}</td>
                                <td>{!! $item->word !!}</td>
                                <?php
                                $chil_examples = $item_chil->examples()->get();
                                ?>
                                <td>
                                    <ul class="list-group">
                                        <?php foreach ($chil_examples as $chil_ex) { ?>
                                            <li><a href="" title="{!! $chil_ex->mean !!}">{!! $chil_ex->example !!}</a></li>
                                        <?php } ?>
                                    </ul>
                                </td>
                                <td><a href="{!! route('admin.word.getEdit', $item_chil['id']) !!}"><span class="glyphicon glyphicon-edit"></span></a></td>
                                <td>
                                    <form action="{!! route('admin.word.postDelete') !!}" method="post" class="f_delete">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
                                        <input type="hidden" name="ids" value="{!! $item_chil['id'] !!}"/>
                                        <input type="hidden" name="action" value="delete"/>
                                        <span class="glyphicon glyphicon-remove b_delete action"></span>
                                    </form>
                                </td>
                                <td><input type="checkbox" class="item" id="{!! $item_chil['id'] !!}"></td>
                            </tr>
                            <?php
                            $id++;
                        }
                    }
                }
            }
            ?>

            <tr>
                <td colspan="9">
                    <form action="{!! route('admin.word.postDelete') !!}" method="post" class="f_delete">
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


