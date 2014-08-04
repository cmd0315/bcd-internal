<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BCD Internal</title>
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/main.css') }}
</head>
<body>
	<div id="wrap">
		@include('layout.navigation')
		
		
		@yield('content')


		<div id="push"></div>

	</div> <!-- #wrap -->
	<div id="footer">
		<footer>
			<p> BCD Pinpoint Direct Marketing Inc. &copy; 2014 </p>
		</footer>
	</div> <!-- #footer -->


	<!-- js -->
	{{ HTML::script('https://code.jquery.com/jquery-1.10.2.min.js"') }}
	{{ HTML::script('js/bootstrap.min.js') }}
</body>
</html>
