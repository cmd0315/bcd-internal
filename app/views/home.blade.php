@extends('layout.master')

@section('content')
	<div id="headerwrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1>BCD Online Forms</h1>
					@if(Auth::check())
						{{ View::make('account.dashboard') }}
		            @else
		          		<a href="{{ URL::route('account-sign-in') }}"><button type="button" class="btn btn-lg btn-warning" id="signin" name="signin">Sign in</button></a>
		            @endif
				</div><!-- .col-lg-6 -->
			</div><!-- /row -->
		</div><!-- /container -->
	</div><!-- /headerwrap -->
@stop