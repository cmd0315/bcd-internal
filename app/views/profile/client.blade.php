@extends('layout.inner-pages-master')0

@section('content')
<div class="row mt">
  <div class="col-lg-6 col-lg-offset-3">
    <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('admin-client-edit-post', array('clientID' => $client_id = e($client->client_id))) }}">
      <div class="row">
        <h4>Client Profile</h4>
        <div class="col-lg-12">
          <div class="form-group">
            <label for="client_id" class="col-sm-4 control-label">ID</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="client_id" name="client_id" value="{{ $client_id }}" readonly>
              @if($errors->has('client_id'))
                <p class="bg-danger">{{ $errors->first('client_id') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="client_name" class="col-sm-4 control-label">Name</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="client_name" name="client_name" value="{{ e($client->client_name) }}">
              @if($errors->has('client_name'))
                <p class="bg-danger">{{ $errors->first('client_name') }}</p>
              @endif
            </div>
          </div>
          <div class="form-group">
            <label for="date_added" class="col-sm-4 control-label">Date Added</label>
            <div class="col-sm-8">
              <input type="date" class="form-control" id="date_added" name="date_added" value="{{ e(date('Y-m-d',strtotime($client->created_at))) }}" readonly>
            </div>
          </div>
        </div>
      </div><!-- /row -->
      <div class="row mt">
        <div class="col-lg-12 text-center">
          <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Save Changes</button>
        </div>
      </div><!-- /row -->
      {{ Form::token() }}
    </form><!-- /form -->
  </div><!-- /col-lg-6 -->
</div><!-- .row -->
@stop