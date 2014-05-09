@extends('layouts.master')

@section('content')
  <div class="col-md-8">
    @if( !$userShareGalleries->isEmpty() )
  	@foreach (array_slice($userShareGalleries->getItems(),$userShareGalleries->getFrom()-1,$userShareGalleries->getPerPage())
         as $gallery)         
        <h4 class="username bg bg-info center"><span id="by">by</span> {{ link_to_route('user.galleries', $gallery[0][0], ['owner_id' => $gallery[0][1]]) }} <span class="pull-right count">{{count($gallery[1]) }}</span></h3>
        <div class="user-galleries">  
    		@foreach (array_chunk($gallery[1]->all(),3) as $galleryRow)
          <div class="row galleries-row"> 
            @foreach($galleryRow as $g)  
            <div class="col-xs-3 col-md-4 center">	
              <h4>{{ $g->name }}</h4> 
        		  <p class="single-gallery">       
          		{{ HTML::decode(link_to_route('users.galleries.show', '<i class="fa fa-camera fa-5x"></i>',['userId'=> $g->user_id,'id'=> $g->id], ['class'=>'gallery-thumbnail'])) }}
          		</p>
          		<p class="description">{{ $g->description}}</p>
        		</div><!--end col-md-4-->
            @endforeach
          </div> <!--end gallery-row-->
    		@endforeach
        </div>                    
  	@endforeach
    {{ $userShareGalleries->links()}}
    @else
        <h3 class="alert alert-info">Sorry, no user shares galleries with You.</h3>
    @endif 
  </div><!--end col-md-8-->
  @include('partials.aside')
@stop
