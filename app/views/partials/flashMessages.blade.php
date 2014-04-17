 @if(Session::has('flash_message'))
  	<div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('flash_message') }}
    </div>
@endif