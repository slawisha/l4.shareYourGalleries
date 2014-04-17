@extends('layouts.master')

@section('content')
	<div class="col-md-8">
		@if($users)
		<table class="table table-bordered">
	  		<tr class="info"><th>Username</th><th>Action</th></tr>
				@foreach ($users as $user) 
					<tr>
						<td>{{ $user->username }}</td>
						<td>
						{{ Form::open(['route' => ['users.destroy', 'userId' => $user->id],'method'=>'delete'])}}		
      							{{ Form::submit('Delete', ['class'=>'btn btn-danger']);}}
						{{ Form::close()}}
						</td>
					</tr>
				@endforeach
		</table>
		@endif
	</div>
@stop