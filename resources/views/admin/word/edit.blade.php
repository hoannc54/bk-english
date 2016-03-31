@extends('admin.template')

@section('main-title','Quản lý từ vựng')

@section('sub-title','Chỉnh sửa từ')

@section('content')
<form class="form-horizontal" role="form" action="{!! route('admin.word.postEdit',$data->id) !!}" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="word">Từ:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="word" name="word" placeholder="Nhập từ" required="required" value="{!! old('word', isset($data)?$data->word:NULL) !!}">
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2">Từ loại:</label>
        <?php 
        if(isset($data)){
            $ar = explode(' ', $data->type);
        } else {
            $ar=[];
        }
        ?>
        <div class="col-sm-8">
            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="n" {!! in_array('n', $ar)?'checked="checked"':NULL !!}>Danh từ</label>
            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="v" {!! in_array('v', $ar)?'checked="checked"':NULL !!}>Động từ</label>
            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="adj" {!! in_array('adj', $ar)?'checked="checked"':NULL !!}>Tính từ</label>
            <label class="checkbox-inline"><input type="checkbox" name="type[]" value="adv" {!! in_array('adv', $ar)?'checked="checked"':NULL !!}>Trạng từ</label>
        </div>
    </div>
    
    <div class="form-group">
        <label class="control-label col-sm-2" for="spell">Phát âm:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="spell" name="spell" placeholder="Nhập phát âm" required="required" value="{!! old('spell', isset($data)?$data->spell:NULL) !!}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="means">Nghĩa:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="means" name="means" placeholder="Nhập nghĩa" required="required" value="{!! old('mean', isset($data)?$data->mean:NULL) !!}">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="parent">Từ gốc:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="parent" name="parent" placeholder="Nhập từ gốc" value="{!! old('parent', isset($parent)?$parent->word:NULL) !!}">
        </div>
    </div>
    
    <div class="form-group">
        <div class="col-sm-offset-7">
            <button type="submit" class="btn btn-default">Sửa</button>
            <button type="reset" class="btn btn-success">Reset</button>
        </div>
    </div>
    <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
</form>
@stop
