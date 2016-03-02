@extends('template')

@section('main-title')
	Đăng ký
@stop

@section('content')
	{{--Thông báo lỗi--}}
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form action="{{ url('/auth/register') }}" method="POST" >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="group">
			<label class="col-4" for="name">Họ và tên:</label>
			<input class="col-7 form-control" type="text" name="name" value="{{ old('name') }}">
		</div>
		<div class="group">
			<label class="col-4" for="name">Email:</label>
			<input class="col-7 form-control" type="text" name="email" value="{{ old('email') }}">
		</div>
		<div class="group">
			<label class="col-4" for="pass">Mật khẩu:</label>
			<input class="col-7 form-control" type="password" name="password">
		</div>
		<div class="group">
			<label class="col-4" for="pass">Nhập lại mật khẩu:</label>
			<input class="col-7 form-control" type="password" name="password_confirmation">
		</div>

		<div class="group col-7 col-offset-4" >
			<input class="button" type="submit" value="Đăng ký"/>
		</div>
	</form>
@stop



