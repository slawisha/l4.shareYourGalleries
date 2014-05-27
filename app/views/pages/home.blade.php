@extends('layouts.master')
@section('carousel')
	@include('partials.carousel') 
@stop
@section('content')
  <div class="row instruct">   
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
  <div class="share center">
      <a href="https://twitter.com/share" class="twitter-share-button" data-text="Create and share galleries" data-size="large" data-hashtags="gallery">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </div>
@stop