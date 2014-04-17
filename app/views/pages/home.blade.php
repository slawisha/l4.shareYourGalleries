@extends('layouts.master')

@section('content')
	<div id="home-carousel" class="carousel slide col-md-8 col-md-offset-2" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{ URL::asset('slider') . '/0.jpg'}}" alt="..." class="img-thumbnail">
      <div class="carousel-caption">
       <h3>Welcome to Share your Gallery service</h3>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/1.jpg'}}" alt="..." class="img-thumbnail">
      <div class="carousel-caption">
       <h3>Step 1: Register</h3>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/2.jpg'}}" alt="..." class="img-thumbnail">
      <div class="carousel-caption">
       <h3>Step 2: Create galleries and upload images</h3>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/3.jpg'}}" alt="..." class="img-thumbnail">
      <div class="carousel-caption">
       <h3>Step 3: Choose friends to share galleries with</h3>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
  </div><!--end carousel-inner-->

  <!-- Controls -->
 
</div>
@stop