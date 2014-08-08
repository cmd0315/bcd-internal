@extends('layout.master')

@section('content')
  <div class="container">
    <div class="row mt centered">
        <div class="col-lg-6 col-lg-offset-3">
          <h1>Manage Department</h1>
          @if(Session::has('global'))
            <p class="text-danger emphasize"> {{ Session::get('global') }} </p>
          @endif
        </div>
      </div><!-- /row -->
    <div class="row mt">
      <div class="col-lg-6 col-lg-offset-3">
        <h4>List of Departments ({{$departments->count()}}) </h4>
        <table class="table table-condensed table-hover">
          <thead>
            <tr>
              <td>#</td>
              <td>Name</td>
              <td>Last Updated At</td>
              <td>Created At</td>
            </tr>
          </thead>
          <tbody>
          <?php $counter=0; ?>
          @foreach($departments as $department)
            @if($department->status === 1)
              <tr>
                <td>{{ ++$counter }}</td>
                <td> {{ e($department->department) }} </td>
                <td> {{ e(date("Y-m-d H:i a",strtotime($department->updated_at))) }} </td>
                <td> {{ e(date("Y-m-d H:i a",strtotime($department->created_at))) }} </td>
              </tr>
            @endif
          @endforeach
          </tbody>
        </table>
      </div><!-- /col-lg-6 -->
    </div><!-- .row -->
    <div class="row">
      <div class="col-lg-4 col-lg-offset-8">
        <button type="button" class="btn btn-primary btn-lg">Edit</button>
        <button type="button" class="btn btn-danger btn-lg">Delete</button>
      </div>
    </div>
  </div><!-- .container -->
</div>
@stop