@extends('layout.master')

@section('content')
  <div class="container">
    <div class="row mt centered">
        <div class="col-lg-6 col-lg-offset-3">
      <h1>Add Department</h1>
      @if(Session::has('global'))
        <p class="text-danger emphasize"> {{ Session::get('global') }} </p>
      @endif

        </div>
      </div><!-- /row -->
    <div class="row mt">
      <div class="col-lg-6 col-lg-offset-3">
        <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin-add-department-post') }}">
          <div class="row">
            <h4>Department Details</h4>
            <div class="col-lg-12">
              <div class="form-group">
                <label for="department" class="col-sm-4 control-label">Department Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="department" name="department">
                  @if($errors->has('department'))
                    <p class="bg-danger">{{ $errors->first('department') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="date_added" class="col-sm-4 control-label">Date Added</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="date_added" name="date_added" value="{{ date('Y-m-d') }}" readonly>
                </div>
              </div>
            </div>
          </div><!-- /row -->
          <div class="row">
            <div class="col-lg-2 col-lg-offset-10">
              <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Add</button>
            </div>
          </div><!-- /row -->
          {{ Form::token() }}
        </form><!-- /form -->
      </div><!-- /col-lg-6 -->
    </div><!-- .row -->
  </div><!-- .container -->
</div>
@stop