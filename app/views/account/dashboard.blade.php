@extends('layout.master')

@section('content')
	<div class="container">
    <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Dashboard</h1>
        @if(Session::has('global'))
          <p class="text-info emphasize"> {{ Session::get('global') }} </p><br/>
        @endif
        <h3>Hi, {{ Auth::user()->username }} ! <br/> What Do You Want to Do?</h3>

      </div>
    </div><!-- /row -->
    
    <div class="row mt centered">
      <div class="col-lg-4 dashboard-options">
        <a href="{{ URL::route('online-forms') }}">
          {{ HTML::image("img/create-form.png", "Create Form", array('class' => 'thumb')) }}
          <h4>Create Request</h4>
          <p>Create request from selected forms</p>
        </a>
      </div><!--/col-lg-4 -->

      <div class="col-lg-4 dashboard-options">
        <a href="view-check-voucher-records..php">
          {{ HTML::image("img/search-records.png", "Search Records", array('class' => 'thumb')) }}
          <h4>Search Records</h4>
          <p>View records</p>
        </a>
      </div><!--/col-lg-4 -->
    </div><!-- /row -->
  </div>
@stop