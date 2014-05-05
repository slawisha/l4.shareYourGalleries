@extends('layouts.master')

@section('content')
	<div class="col-md-8 col-md-offset-2">
	<h3 class="username bg bg-info">Gallery sharing:</h3>
		@if($users)
		<table class="table table-bordered">
	  		<tr class="info"><th>Username</th><th>Status</th></tr>
				@foreach ($users as $user) 
					<tr>
					<td>{{ $user->username }}</td>
					@if( in_array($user->id, $userSharesIds) )
						<td>
						{{ Form::open(['route' => ['users.sharings.destroy', 'userId'=>Auth::user()->id,'userShareid' => $user->id],'method'=>'delete'])}}
							
      							{{ Form::submit('Sharing', ['class'=>'btn btn-info']);}}
    						
						{{ Form::close()}}
						</td>
					@else
						<td>
							{{ Form::open(['route' => ['users.sharings.store', 'userShareid' => $user->id],'method'=>'post'])}}
							
      							{{ Form::submit('Share', ['class'=>'btn btn-success']);}}
    						
							{{ Form::close()}}
						</td>
					@endif
					</tr>
				@endforeach
		</table>
		@endif
@stop