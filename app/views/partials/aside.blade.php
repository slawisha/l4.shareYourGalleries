<aside class="col-md-4">
  @if($userShares)
  	<div class="panel panel-info">
	  	<div class="panel-heading">Sharing galleries with:</div>
	  	<ul class="list-group">
	  	@foreach ($userShares as $user)
	  		<li class="list-group-item">{{ $user }}</li>
	  	@endforeach	  	
	  	</ul>
  	</div>
  @endif
 </aside>