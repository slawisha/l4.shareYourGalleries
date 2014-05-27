@extends('layouts.master')

@section('content')
<div class="col-md-12">
	@if( ! $galleries->isEmpty() )
		<table class="table table-bordered">
	  		<tr class="info"><th>Gallery Name</th><th>Gallery Owner</th><th>Gallery Url</th><th>Action</th></tr>
				@foreach($galleries as $gallery)
				<tr>
					<td>{{ $gallery->name }}</td>
					<td>{{ $gallery->user->username }}</td>
					<td>{{ link_to_route('users.galleries.show', 'View',['userId'=>$gallery->user->id, 'id'=>$gallery->id], ['class' => 'btn btn-success']) }}</td>
					<td>
						{{ link_to_route('users.galleries.edit', 'Edit', ['userId'=>$gallery->user->id,'id' => $gallery->id], ['class' => 'btn btn-info pull-left', 'style' => 'margin-right:20px;'])}}
						{{ Form::open(['route'=> ['users.galleries.destroy', 'userId'=>$gallery->user->id, 'id'=> $gallery->id], 'method' => 'delete' ])}}							
						      {{ Form::submit('Delete', ['class'=>'btn btn-danger pull-left']);}}
						{{ Form::close()}}
					</td>
				</tr>
				@endforeach
	    </table>
	@else
		<h3>No gallery has been uploaded yet</h3>
	@endif
</div>
@stop
