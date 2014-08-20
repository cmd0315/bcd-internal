<div class="container">
	<div class="row mt centered">
		<div class="col-lg-6 col-lg-offset-3">
			<h1>{{$pageTitle}}</h1>
			@if(Session::has('global'))
				<div class="alert alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<p class="text-info emphasize"> {{ Session::get('global') }} </p>
				</div>
			@endif
			@yield('sub-heading')
		</div>
	</div><!-- /row -->