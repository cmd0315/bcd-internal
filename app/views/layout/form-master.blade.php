@include('layout.partials.header')
	<div id="wrap2" class="form-wrap">
		<!-- top navbar -->
	    <div class="navbar navbar-default navbar-main navbar-fixed-top" role="navigation">
	       <div class="container-fluid">
	    	<div class="navbar-header">
	           <button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".sidebar-nav">
	             <span class="icon-bar"></span>
	             <span class="icon-bar"></span>
	             <span class="icon-bar"></span>
	           </button>
	           <a class="navbar-brand" id="navbar-brand1" href="#">{{ HTML::image("img/bcd-logo.png", "Logo", array('class' => 'img-responsive')) }}</a>
	    	</div>
	       </div>
	    </div>
		<div class="container-fluid">
			<div class="row row-offcanvas row-offcanvas-left">
				@include('layout.form-navigation')
				<div class="col-xs-12 col-sm-10 main">
					@if(Session::has('global'))
						<div class="row-fluid form-msg">
							<div class="col-lg-12 text-center">
								<div class="alert alert-danger">
									<a href="#" class="close" data-dismiss="alert">&times;</a>
									<p class="text-info emphasize"> {{ Session::get('global') }} </p>
								</div>
							</div>
						</div>
					@endif
				  @yield('content')

				</div>
			</div><!-- .row -->
		</div> <!-- .container -->

	</div> <!-- #wrap -->
	<div id="footer2"></div> <!-- #footer2 -->


	<!-- js -->
	{{ HTML::script('https://code.jquery.com/jquery-1.10.2.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
	<script>
	$('document').ready(function() {
		$('[data-toggle=offcanvas]').click(function() {
			$('.row-offcanvas').toggleClass('visible');
		});
		@yield('scripts')
	});
</script>
</body>
</html>