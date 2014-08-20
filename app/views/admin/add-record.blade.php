@extends('layout.inner-pages-master')

@section('sub-heading')
  <h3>Which set of records do you want to update?</h3>
@stop

@section('content')
<div class="row mt centered">
  <div class="col-lg-4 dashboard-options">
      {{ HTML::image("img/add-record.png", "Employee", array('class' => 'thumb')) }}
      <h4>Employee</h4>
      <a href="{{ URL::route('account-create') }}">Add</a> | <a href="{{ URL::route('admin-manage-employee') }}">Manage</a>
  </div><!--/col-lg-4 -->
  <div class="col-lg-4 dashboard-options">
    {{ HTML::image("img/departments.png", "Department", array('class' => 'thumb')) }}
    <h4>Department</h4>
    <a href="{{ URL::route('admin-department-add') }}">Add</a> | <a href="{{ URL::route('admin-manage-department') }}">Manage</a>
  </div><!--/col-lg-4 -->
  <div class="col-lg-4 dashboard-options">
    {{ HTML::image("img/clients.png", "Client", array('class' => 'thumb')) }}
    <h4>Client</h4>
    <a href="{{ URL::route('admin-client-add') }}">Add</a> | <a href="{{ URL::route('admin-client-manage') }}">Manage</a>
  </div><!--/col-lg-4 -->
</div><!-- /row -->
@stop

@section('scripts')
// <script>
// $( document ).ready(function() {
//     alert( "ready!" );
// });
</script>
@stop