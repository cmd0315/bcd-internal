@include('layout.partials.header')
	<div id="wrap" class="form-wrap">
		<div class="container-fluid">
			<div class="row">
				@include('layout.form-navigation')
				<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				  @yield('content')

				</div>
			</div><!-- .row -->
		</div> <!-- .container -->

		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')