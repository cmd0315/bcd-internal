@include('layout.partials.header')
	<div id="wrap">
		@include('layout.navigation')

		@include('layout.partials.title-heading')
			@yield('content')
			</div><!-- .container -->
		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
