@include('layout.partials.header')
	<div id="wrap">
		@include('layout.navigation')
		@yield('content')

		<div id="push"></div>

	</div> <!-- #wrap -->
@include('layout.partials.footer')
