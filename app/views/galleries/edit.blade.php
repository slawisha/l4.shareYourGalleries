@extends('layouts.master')

@section('content')
  <div class="col-md-8">
    <h3 class="username bg bg-info">Edit gallery</h3>
    {{ Form::open(['route' => ['users.galleries.update', 'userId'=>$gallery->user->id, 'galleryId'=>$gallery->id], 'method'=>'put', 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('gallery_name', 'Gallery name') }}
      {{ Form::text('gallery_name', $gallery->name, ['class' => 'form-control', 'placeholder' => 'name your gallery'])}}
    </div>
    <div class="form-group">
      {{ Form::label('gallery_description', 'Gallery description') }}
      {{ Form::textarea('gallery_description', $gallery->description, ['class' => 'form-control', 'placeholder' => 'gallery description'])}}
    </div>
    <div class="form-group">
      {{ Form::label('gallery_tags', 'Tags') }}
      {{ Form::text('gallery_tags', $galleryTags, ['class' => 'form-control', 'placeholder' => 'comma separated list'])}}
    </div>
    <div class="form-group">
        <div class="row image-list">
          @foreach ($images as $image)
            <div class="col-xs-6 col-md-3 image-in-list">
              <a href="{{ URL::asset('gallery') . '/' . $gallery->url . $image->url}}" class="thumbnail gallery-image">
                <img src="{{ URL::asset('gallery') . '/' . $gallery->url . $image->url}}" width="160" height="100" alt="{{ $image->id}}" >
              </a>
             <span class="delete-image"><i class="fa fa-trash-o"></i></span>
             <span class="image-order">{{ $image->order }}</span>
            </div>
          @endforeach
    </div>  
    </div>
       <div class="form-group">
      {{ Form::label('images','Upload more images') }}
      {{ Form::file('images[]',['multiple' =>''])}}
    </div>
    <div class="form-group">
      {{ Form::submit('Save', ['class'=>'btn btn-primary']);}}
    </div>
  {{ Form::close()}}
  </div>
  @include('partials.aside')
@stop