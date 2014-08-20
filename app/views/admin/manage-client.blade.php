@extends('layout.inner-pages-master')

@section('content')
<div class="row mt">
  <div class="col-lg-8 col-lg-offset-2">
    <h4>List of Clients ({{$clients->count()}}) </h4>
    <table class="table table-condensed table-hover">
      <thead>
        <tr>
          <td>#</td>
          <td>Client ID</td>
          <td>Name</td>
          <td>Last Updated At</td>
          <td>Created At</td>
          <td></td>
        </tr>
      </thead>
      <tbody>
      <?php $counter=0; ?>
      @foreach($clients as $client)
        @if($client->status === 1)
          <tr>
            <td>{{ ++$counter }}</td>
            <td> <a href="{{ URL::route('admin-client-edit', array('clientID' => $client_id = e($client->client_id))) }}"> {{ $client_id }} </td>
            <td> {{ $client_name = e($client->client_name) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($client->updated_at))) }} </td>
            <td> {{ e(date("Y-m-d H:i a",strtotime($client->created_at))) }} </td>
            <td><a  href="#" class="delete-item">x</a></td>
          </tr>
        @endif
      @endforeach
      </tbody>
    </table>
  </div><!-- /col-lg-6 -->
</div><!-- .row -->
<div class="row">
  <div class="col-lg-12 text-center">
    <a href="{{ URL::route('admin-client-add') }}"><button type="button" class="btn btn-warning btn-lg">Add Client</button></a>
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