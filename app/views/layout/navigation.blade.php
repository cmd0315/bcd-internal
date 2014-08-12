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
            	<li>
					<a href="#"><span class="badge pull-right">2</span>Messages</a>
				</li>
            	<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{e(Auth::user()->employee->first_name)}} <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
            	<li><a href="{{ URL::route('account-change-account-details')}}">Change Account Details</a></li>
		            <li class="divider"></li>
            		<li><a href="{{ URL::route('account-sign-out')}}">Sign out</a></li>
		          </ul>
		        </li>
            @else
          		<li><a href="{{ URL::route('account-sign-in')}}">Sign in</a></li>
            	<li><a href="#">Guidelines</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
	</div><!-- .container -->
</div> <!-- .navbar -->	