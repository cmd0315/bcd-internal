@extends('layout.inner-pages-master')

@section('sub-heading')
  <h3>Hi, {{ e(Auth::user()->employee->first_name) }} ! <br/> What Do You Want to Do?</h3>
@stop

@section('content')
    <div class="row mt centered">
      <div class="col-lg-4 dashboard-options">
        <a href="{{ URL::route('online-forms') }}">
          {{ HTML::image("img/create-form.png", "Create Request", array('class' => 'thumb')) }}
          <h4>Create Request</h4>
          <p>Create request from selected forms</p>
        </a>
      </div><!--/col-lg-4 -->
      <div class="col-lg-4 dashboard-options">
        <a href="view-check-voucher-records..php">
          {{ HTML::image("img/search-records.png", "Search Created Forms", array('class' => 'thumb')) }}
          <h4>Search Created Forms</h4>
          <p>Search and view created forms</p>
        </a>
      </div><!--/col-lg-4 -->

      <!-- Add special function for System Admin -->
      @if(Employee::where('username', e(Auth::user()->username))->pluck('position') === 2)
        <div class="col-lg-4 dashboard-options">
          <a href="{{ URL::route('admin-add-record') }}">
            {{ HTML::image("img/add-record.png", "Manage System Records", array('class' => 'thumb')) }}
            <h4>Manage System Records</h4>
            <p>Add, edit, or delete records</p>
          </a>
        </div><!--/col-lg-4 -->
      @endif
    </div><!-- /row -->
@stop