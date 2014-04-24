@extends('layouts.master')

@section('content')
  
  <div class="col-md-8">
    <h3 class="username bg bg-info">Create gallery</h3>
    {{ Form::open(['route' => ['users.galleries.store','userId'=>Auth::user()->id], 'files' => true]) }}
    <div class="form-group">
      {{ Form::label('gallery_name', 'Gallery name') }}
      {{ Form::text('gallery_name', null, ['class' => 'form-control', 'placeholder' => 'name your gallery'])}}
      {{ $errors->first('name','<div class="error">:message</div>') }}
    </div>
    <div class="form-group">
      {{ Form::label('gallery_description', 'Gallery description') }}
      {{ Form::textarea('gallery_description', null, ['class' => 'form-control', 'placeholder' => 'gallery description'])}}
    </div>
    <div class="form-group">
      {{ Form::label('gallery_tags', 'Tags') }}
      {{ Form::text('gallery_tags', null, ['class' => 'form-control', 'placeholder' => 'comma separated list'])}}
    </div>
    <div class="form-group">
      {{ Form::label('images','Upload your images') }}
      {{ Form::file('images[]',['multiple' =>''])}}
      {{ $errors->first('images','<div class="error">:message</div>') }}
    </div>
    <div class="form-group">
      {{ Form::submit('Upload', ['class'=>'btn btn-primary']) }}
    </div>
  {{ Form::close()}}
  </div>
  @include('partials.aside')
@stop