@extends('layout.inner-pages-master')

@section('content')
<div class="row mt">
  <div class="col-lg-8 col-lg-offset-2">
    <h4>List of Departments ({{$departments->count()}}) </h4>
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <td>#</td>
          <td>Department ID</td>
          <td>Name</td>
          <td>Last Updated At</td>
          <td>Created At</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      <?php $counter=0; ?>
      @foreach($departments as $department)
        @if($department->status === 1)
          <tr>
            <td>{{ ++$counter }}</td>
            <td> <a href="{{ URL::route('admin-department-edit', array('departmentID' => $departmentID = e($department->department_id) )) }}"> {{ $departmentID }} </td>
            <td> {{ $departmentName = e($department->department) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($department->updated_at))) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($department->created_at))) }} </td>
            <td><a  href="{{ URL::route('admin-department-delete', $departmentName) }}" class="delete-item">x</a></td>
          </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div><!-- /col-lg-6 -->
</div><!-- .row -->
<div class="row">
  <div class="col-lg-12 text-center">
    <a href="{{ URL::route('admin-department-add') }}"><button type="button" class="btn btn-warning btn-lg">Add Department</button></a>
    <button type="button" class="btn btn-danger btn-lg" id="delete-btn" name="delete-btn">Delete</button>
  </div>
</div>
@stop

@section('scripts')
<script>
  $('document').ready(function() {
    $('#delete-btn').on('click', function() {
      $('.delete-item').css('display', 'inline-block');
    });
  });
</script>
@stop