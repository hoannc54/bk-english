<div class="list-wrap" id="{!! $list_id or NULL !!}">
    <ul class="effeckt-list" id="list" data-effeckt-type="expand-in">
        <li>{!! $list_data or "Phần tử" !!}</li>
    </ul>
    <div class="form-group">
        <div class="col-sm-offset-1">
            <a class="add btn btn-primary" data-insert-html='{!! $list_data_add or "Phần tử" !!}'>
                Add
            </a>
            <a class="remove btn btn-default">Remove</a>
        </div>
    </div>
</div>