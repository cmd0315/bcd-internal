@extends('layout.master')

@section('content')
<div class="container">
    <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Add Employee Account</h1>
        <h3>Fill up the form below to create an account for employee</h3>

      </div>
    </div><!-- /row -->
    <div class="row mt">
      <div class="col-lg-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('account-create-post') }}">
          <div class="row">
            <h4>Account Details</h4>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="username" name="username"{{ (Input::old('username')) ? ' value ="' . Input::old('username') . '"' : '' }}>
                  @if($errors->has('username'))
                  	<p class="bg-danger">{{ $errors->first('username') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="date_created" class="col-sm-2 control-label">Date</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="date_created" name="date_created" value="{{ date('Y-m-d') }}" readonly>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password" name="password">
                  @if($errors->has('password'))
                  	<p class="bg-danger">{{ $errors->first('password') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="password_again" class="col-sm-2 control-label">Retype Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="password_again" name="password_again">
                  @if($errors->has('password_again'))
                  	<p class="bg-danger">{{ $errors->first('password_again') }}</p>
                  @endif
                </div>
              </div>
            </div>
          </div><!-- /row -->
          <div class="row">
            <h4>Employee Information</h4>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" name="name"{{ (Input::old('name')) ? ' value ="' . Input::old('name') . '"' : '' }}>
                  @if($errors->has('name'))
                  	<p class="bg-danger">{{ $errors->first('name') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email"{{ (Input::old('email')) ? ' value ="' . Input::old('email') . '"' : '' }}>
                  @if($errors->has('email'))
                  	<p class="bg-danger">{{ $errors->first('email') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="mobile" class="col-sm-2 control-label">Mobile Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="mobile" name="mobile"{{ (Input::old('mobile')) ? ' value ="' . Input::old('mobile') . '"' : '' }}>
                  @if($errors->has('mobile'))
                  	<p class="bg-danger">{{ $errors->first('mobile') }}</p>
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label for="department" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-10">
                  	<select class="form-control" id="inputDepartment" name="department">
                  		<option></option>
                      @foreach($departments as $department)
	                     <option value="{{ $department->department }}">{{ $department->department }}</option>
                      @endforeach
	                </select>
                  @if($errors->has('department'))
                  	<p class="bg-danger">{{ $errors->first('department') }}</p>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label for="position" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                  <select class="form-control" id="position" name="position">
                  		<option></option>
	                    <option value="0">Member</option>
	                    <option value="1">Head</option>
	               </select>
                  @if($errors->has('position'))
                  	<p class="bg-danger">{{ $errors->first('position') }}</p>
                  @endif
                </div>
              </div>
            </div>
          </div><!-- /row -->
          <div class="row">
            <div class="col-lg-1 col-lg-offset-11">
              <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Submit</button>
            </div>
          </div><!-- /row -->
        </div>
        {{ Form::token() }}
        </form><!-- /form -->
      </div>
    </div><!-- /row -->
  </div>
@stop