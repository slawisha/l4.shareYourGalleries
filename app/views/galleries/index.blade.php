@extends('layouts.master')

@section('content')
	<div class="col-md-8">
	@if( !empty($galleries) )
		<table class="table table-bordered">
	  		<tr class="info"><th>Gallery Name</th><th>Gallery Url</th><th>Action</th></tr>
				@foreach($galleries as $gallery)
				<tr>
					<td>{{ $gallery->name }}</td>
					<td>{{ link_to_route('users.galleries.show', 'View',['userId'=>$userId, 'id'=>$gallery->id], ['class' => 'btn btn-success']) }}</td>
					<td>
						{{ link_to_route('users.galleries.edit', 'Edit', ['userId'=>$userId,'id' => $gallery->id], ['class' => 'btn btn-info pull-left', 'style' => 'margin-right:20px;'])}}
						{{ Form::open(['route'=> ['users.galleries.destroy', 'userId'=>$userId, 'id'=> $gallery->id], 'method' => 'delete' ])}}							
						      {{ Form::submit('Delete', ['class'=>'btn btn-danger pull-left']);}}
						{{ Form::close()}}
					</td>
				</tr>
				@endforeach
	    </table>
	@else
		<h3>You haven't uploaded gallery yet</h3>
	@endif
	    {{ link_to_route('users.galleries.create', 'Create new gallery', ['userId'=>$userId])}}
	</div>
    @include('partials.aside')
@stop