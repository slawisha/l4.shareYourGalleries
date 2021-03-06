@extends('layouts.master')

@section('content')

  <div class="col-md-8">
    <div class="row">
    @if( !$images->isEmpty() )
      @foreach ($images as $image)
        <div class="col-xs-6 col-md-3">
          <a href="{{ URL::asset('gallery') . '/' . $gallery->url . $image->url}}" class="thumbnail gallery-image">
            <img src="{{ URL::asset('gallery') . '/' . $gallery->url . $image->url}}" width="160" height="100" >
          </a>
        </div>
      @endforeach
    @else
      <p class="alert alert-info">Gallery has no images</p>
    @endif
    </div>     
  </div>
  @include('partials.aside')
  <ul class="tags col-md-12">
      <span class="btn btn-default">Tags:</span>
      @if( ! $galleryTags->isEmpty() )
        @foreach($galleryTags as $tag)
          <li>{{ link_to_route('tags.search', $tag->name, ['name'=>$tag->name], ['class'=>'btn btn-info']) }}</li>
        @endforeach
      @else
        <li>untagged</li>
      @endif
  </ul>
  <div class="navigation col-md-12">
    {{ link_to_route('users.galleries.index','View your galleries',['userId'=>Auth::user()->id], ['class'=>'btn btn-warning']) }}
    {{ link_to_route('members.index','View friends galleries', null, ['class'=>'btn btn-warning']) }}
  </div>
   
@stop