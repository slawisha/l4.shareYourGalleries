@extends('layouts.master')

@section('content')
	<h3>Reset your password</h3>
	{{ Form::open()}}
	<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'johnsmith@something.com'])}}
	{{ $errors->first('email','<div class="error">:message</div>') }}
	</div>
	<div class="form-group">
	{{ Form::submit('Reset', array('class'=>'btn btn-primary submit'))}}
	</div>
	{{ Form::close() }}

	@if( Session::has('error') )
		<p class="error">{{ Session::get('error') }}</p>
	@elseif ( Session::has('status'))
		<p class="success">{{ Session::get('status') }}</p>
	@endif
@stop