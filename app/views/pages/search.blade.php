@extends('layouts.master')

@section('content')
	<div class="col-md-8">
		<table class="table table-bordered">
	  		<tr class="info"><th>Search results</th></tr>
	  		@if( !empty($searchResults) )
				@foreach($searchResults as $result)
					@if( in_array($result->user_id, $userShareIds) )				
						<tr>							
							<td>{{ link_to_route('users.galleries.show', $result->name ,['userId'=>$result->user_id, 'id'=>$result->id]) }}</td>
						</tr>
					@endif
				@endforeach
			@endif
	    </table>
	</div>    
@stop