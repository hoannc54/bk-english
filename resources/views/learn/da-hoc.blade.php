@extends('template')

@section('main-title','Các từ đã học')

@section('content')
<div id="show"></div>
@endsection


@section('script')
@parent
<script src="{!! url('public/js/learn.js') !!}"></script>
<script src="{!! url('public/js/play-sound.js') !!}"></script>
<script>
    $(document).ready(function () {
    var notlearn_option = {
    url: '{{ route("getLearnedAjax") }}',
            view: $('#show')
    };
    var learned = new learn();
    learned.init(notlearn_option);
    });
</script>
@stop


@section('style')
@parent


<style>
</style>
@stop
