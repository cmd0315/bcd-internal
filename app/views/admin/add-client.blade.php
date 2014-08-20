@extends('layout.inner-pages-master')

@section('content')
<div class="row mt">
  <div class="col-lg-6 col-lg-offset-3">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin-client-add-post') }}">
      <div class="row">
        <h4>Client Details</h4>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="client_id" class="col-sm-4 control-label">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="client_id" name="client_id"{{ (Input::old('client_id')) ? ' value ="' . Input::old('client_id') . '"' : '' }}>
              @if($errors->has('client_id'))
                <p class="bg-danger">{{ $errors->first('client_id') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="client_name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="client_name" name="client_name"{{ (Input::old('client_name')) ? ' value ="' . Input::old('client_name') . '"' : '' }}>
              @if($errors->has('client_name'))
                <p class="bg-danger">{{ $errors->first('client_name') }}</p>
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
      <div class="row mt">
        <div class="col-lg-12 text-center">
          <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Submit</button>
    <a href="{{ URL::route('admin-client-manage') }}"><button type="button" class="btn btn-info btn-lg">Manage Client Records</button></a>
        </div>
      </div><!-- /row -->
      {{ Form::token() }}
    </form><!-- /form -->
  </div><!-- /col-lg-6 -->
</div><!-- .row -->
@stop