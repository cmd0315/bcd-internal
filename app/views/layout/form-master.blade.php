<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>BCD Internal</title>
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/main.css') }}
</head>
<body>
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
