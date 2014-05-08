@extends('layouts.master')

@section('content')
	<div class="col-md-8">
	  		@if( ! $searchResults->isEmpty())
				@foreach($searchResults as $result)
				{{-- var_dump($result)--}}
					@if( in_array($result->user_id, $userShareIds) )										
						<div class="col-xs-3 col-md-4 center">
						 <h4 class="username bg bg-info center"> {{ $result->user->username }}</h4>	
			              <h4>{{ $result->name }}</h4> 
			        		  <p class="single-gallery">       
			          		{{ HTML::decode(link_to_route('users.galleries.show', '<i class="fa fa-camera fa-5x"></i>',['userId'=>$result->user_id, 'id'=>$result->id], ['class'=>'gallery-thumbnail'])) }}
			          		</p>
				        </div><!--end col-md-4-->
					@endif
				@endforeach
			@else
				<h4 class="username bg bg-warning">Sorry, nothing matches your criteria</h4>
			@endif
	</div>    
@stop