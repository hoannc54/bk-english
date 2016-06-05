@extends('template')

@section('main-title','Các từ chưa học')

@section('content')
<div id="show" style="float: left;"></div>

@endsection


@section('script')
@parent
<script src="{!! url('public/js/learn.js') !!}"></script>
<script src="{!! url('public/js/play-sound.js') !!}"></script>
<script>
    $(document).ready(function () {
    var notlearn_option = {
    url: '{{ route("getNotLearnAjax") }}',
            view: $('#show')
    };
    var notlearn = new learn();
    notlearn.init(notlearn_option);
//        $('.pagination').on('click',function () {
//            alert(this);
//        });
    });
</script>
@stop


@section('style')
@parent


<style>
</style>
@stop
