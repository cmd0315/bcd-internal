
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			  <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">{{ HTML::image("img/bcd-logo.png", "Logo") }}</a>
		</div> <!-- navbar-header -->
		<div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          		<li><a href="{{ URL::route('home')}}">Home</a></li>
            @if(Auth::check())
            	<li><a href="{{ URL::route('account-change-profile-details')}}">Change Account Details</a></li>
            	<li><a href="{{ URL::route('account-sign-out')}}">Sign out</a></li>
            @else
            	<li><a href="#">Guidelines</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
	</div><!-- .container -->
</div> <!-- .navbar -->	