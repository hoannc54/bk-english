<?php
$word_manage = 'active';
?>
@extends('admin.template')

@section('main-title','Danh sách từ')

@section('content')
<?php
if (count($data) == 0) {
    echo '<h4>Không có từ nào trong danh sách</h4>';
} else {
    ?>
    <table class="table table-hover">
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
                <th><label class="checkbox-inline"><input type="checkbox"> Check All</label></th>
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
                        <td><a href="{!! route('admin.word.getDelete', $item['id']) !!}"><span class="glyphicon glyphicon-remove"></span></a></td>
                        <td><input type="checkbox"></td>
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
                                <td><a href="{!! route('admin.word.getDelete', $item_chil['id']) !!}"><span class="glyphicon glyphicon-remove"></span></a></td>
                                <td><input type="checkbox"></td>
                            </tr>
                            <?php
                            $id++;
                        }
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <?php
}
?>
@endsection


