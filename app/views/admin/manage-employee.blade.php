@extends('layout.inner-pages-master')

@section('content')
<div class="row mt">
  <div class="col-lg-12">
    <h4>List of Employees ({{$employees->count()}}) </h4>
    <table class="table table-condensed table-hover" id="employee-table">
      <thead>
        <tr>
          <td>#</td>
          <td>Name</td>
          <td>Username</td>
          <td>Department</td>
          <td>Position</td>
          <td>Email</td>
          <td>Mobile</td>
          <td>Last Updated At</td>
          <td>Date Joined</td>
        </tr>
      </thead>
      <tbody>
      <?php $counter=0; ?>
      @foreach($employees as $employee)
          <tr>
            <td>{{ ++$counter }}</td>
            <?php $username = $employee->username; ?>
            <td> <a href="{{ URL::route('profile-employee', array('username' => $username)) }}">{{ e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }} </a></td>
            <td> {{ $username }} </td>
            <td> {{ e($employee->department->department) }} </td>

            @if(($employee_position = e($employee->position)) === 2) 
              <td>System Admin</td>
            @elseif($employee_position === 1)
              <td>Head</td>
            @else
              <td>Member</td>
            @endif

            <td> {{ e($employee->email) }} </td>
            <td> {{ e($employee->mobile) }} </td>
            <td> {{ e($employee->account->updated_at) }} </td>
            <td> {{ e($employee->account->created_at) }} </td>
          </tr>
      @endforeach
      </tbody>
    </table>
  </div><!-- /col-lg-6 -->
</div><!-- .row -->
<div class="row mt">
  <div class="col-lg-12 text-center">
    <a href="{{ URL::route('account-create-post') }}"><button type="button" class="btn btn-lg btn-warning">Add Employee</button></a>
  </div>
</div>
@stop