<!DOCTYPE html>
<html>
  <head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/superfish.css') }}" >  
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" >  
    <link rel="stylesheet" href="{{ URL::asset('css/colorbox.css') }}" >  
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	  <div id="wrapper">
      @include('partials.navigation')   	
    	<div class="container">
      <div class="row" id="content">
      @include('partials.flashMessages')
    	@yield('content')
      </div>
    	</div><!-- end .container -->
      @include('partials.footer')
    </div><!-- end wrapper --> 
    <script type="text/javascript">var PUBLICPATH = "{{ URL::to('/') }}"</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('js/hoverIntent.js') }}"></script>
    <script src="{{ URL::asset('js/superfish.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.colorbox-min.js') }}"></script>
    <script src="{{ URL::asset('js/script.js') }}"></script>
  </body>
</html>