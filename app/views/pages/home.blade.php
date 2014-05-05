@extends('layouts.master')
@section('carousel')
	@include('partials.carousel') 
@stop
@section('content')
  <div class="instruct">   
    <div class="col-md-4 center"> 
        <img src="{{ URL::asset('instruct') . '/register.jpg'}}" alt="..." class="thumbnail img-center">
      <h4>Step 1: Register</h4>
    </div>
    <div class="col-md-4 center">     
        <img src="{{ URL::asset('instruct') . '/create.jpg'}}" alt="..." class="thumbnail img-center">
      <h4>Step 2: Create galleries</h4>
    </div>
    <div class="col-md-4 center">  
        <img src="{{ URL::asset('instruct') . '/share.jpg'}}" alt="..." class="thumbnail img-center"> 
      <h4>Step 3: Share</h4>
    </div>
  </div>

@stop