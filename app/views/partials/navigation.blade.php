<header>
  <nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ Url::to('/')}}">Share Your Galleries</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    @if (Auth::check() && !is_admin())
      <ul class="menu sf-menu sf-navbar">
        <li>{{ link_to_route('members.index', 'Galleries') }}</li>
        <li><a href="#">Manage</a>
            <ul class="sub-menu">
                <li>{{ link_to_route('users.galleries.index', 'Galleries',['userId' => Auth::user()->id]) }}</li>
                <li>{{ link_to_route('users.sharings.index', 'Share', ['userId' => Auth::user()->id]) }}</li>
            </ul>
        </li>
      </ul>
    @endif
    @if( is_admin() )
      <ul class="menu sf-menu sf-navbar">
        <li>{{ link_to_route('users.index', 'Users') }}</li>
        <li>{{ link_to_route('galleries.all', 'Galleries') }}</li>
      </ul>
    @endif
      
      <ul class="nav navbar-nav navbar-right">
      @if (Auth::guest())
        <li>{{ link_to_route('login', 'Login') }}</li>
        <li>{{ link_to_route('register', 'Register') }}</li>
      @else
         <li><a href="#">{{ 'Loged in as ' . Auth::user()->username }}</a></li>
         <li>{{ link_to_route('logout', 'Logout') }} </li>
         {{ Form::open(['route'=>'search', 'class'=>'navbar-form navbar-right'])}}
            <div class="form-group">
              <input type="text" name="search-term" class="form-control" placeholder="Search">
              <i class="fa fa-search"></i>
            </div>
         {{ Form::close() }}
      @endif       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</header>