@extends('layouts.master')

@section('content')
	{{ Form::open() }}
	{{ Form::hidden('token', $token) }}
	<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'johnsmith@something.com'])}}
	{{ $errors->first('email','<div class="error">:message</div>') }}
	</div>
	<div class="form-group">
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password', ['class' => 'form-control', 'placeholder' => '*********'])}}
	{{ $errors->first('password','<div class="error">:message</div>') }}
	</div>
	<div class="form-group">
	{{ Form::label('password_confirmation', 'Confirm Password') }}
	{{ Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => '*********'])}}
	{{ $errors->first('password_confirmation','<div class="error">:message</div>') }}
	</div>
	<div class="form-group">
	{{ Form::submit('Reset', array('class'=>'btn btn-primary submit'))}}
	</div>
	{{ Form::close()}}
	@if( Session::has('error') )
		<p class="error">{{ Session::get('error') }}</p>
	@endif
@stop