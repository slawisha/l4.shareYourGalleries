@extends('layouts.master')

@section('content')
	<h3 class="username bg bg-info">Please register:</h3>
	{{Form::open(['route' => 'users.store','role'=>'form']) }}
	<div class="form-group">
	{{ Form::label('username', 'Username') }}
	{{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'johnsmith'])}}
	{{ $errors->first('username','<div class="error">:message</div>') }}
	</div>
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
	{{ Form::submit('Register', array('class'=>'btn btn-primary submit'))}}
	</div>
	{{ Form::close() }}
@stop