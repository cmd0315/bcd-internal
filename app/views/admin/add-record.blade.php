@extends('layout.master')

@section('content')
	<div class="container">
    <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>System Records</h1>
        @if(Session::has('global'))
          <p class="text-info emphasize"> {{ Session::get('global') }} </p><br/>
        @endif
        <h3>Which set of records do you want to update?</h3>

      </div>
    </div><!-- /row -->
    
    <div class="row mt centered">
      <div class="col-lg-4 dashboard-options">
          {{ HTML::image("img/add-record.png", "Employee", array('class' => 'thumb')) }}
          <h4>Employee</h4>
          <a href="{{ URL::route('account-create') }}">Add</a> | <a href="{{ URL::route('admin-manage-employee') }}">Manage</a>
      </div><!--/col-lg-4 -->
      <div class="col-lg-4 dashboard-options">
        {{ HTML::image("img/departments.png", "Department", array('class' => 'thumb')) }}
        <h4>Department</h4>
        <a href="{{ URL::route('admin-add-department') }}">Add</a> | <a href="{{ URL::route('admin-manage-department') }}">Manage</a>
      </div><!--/col-lg-4 -->
    </div><!-- /row -->
  </div>
@stop

@section('scripts')
// <script>
// $( document ).ready(function() {
//     alert( "ready!" );
// });
</script>
@stop