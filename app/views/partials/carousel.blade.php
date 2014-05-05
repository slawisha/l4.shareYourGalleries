
<div id="home-carousel" class="carousel slide" data-ride="carousel">

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="{{ URL::asset('slider') . '/0.jpg'}}" alt="..." class="">
      <div class="carousel-caption">
       <h3>Welcome to Share your Gallery service</h3>
       <p>Create and share your galleries with your friends</p>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/1.jpg'}}" alt="..." class="">
      <div class="carousel-caption">
       <h3>Register</h3>
       <p>Just fill a form. It's free</p>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/2.jpg'}}" alt="..." class="">
      <div class="carousel-caption">
       <h3>Create galleries and upload images</h3>
       <p>Editable galleries, sortable images</p>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
    <div class="item">
      <img src="{{ URL::asset('slider') . '/3.jpg'}}" alt="..." class="">
      <div class="carousel-caption">
       <h3>Share your galleries</h3>
       <p>Choose friends to share galleries with</p>
      </div><!--end carousel-caption-->
    </div><!--end item active -->
  </div><!--end carousel-inner-->
  <!-- Controls -->
  <a class="carousel-control left-arrow" href="#home-carousel" data-slide="prev">
    <span class="fa fa-chevron-left"></span>
  </a>
  <a class="carousel-control right-arrow" href="#home-carousel" data-slide="next">
    <span class="fa fa-chevron-right "></span>
  </a>
</div>