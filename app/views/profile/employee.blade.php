@extends('layout.master')

@section('content')
	<div class="container">
    <div class="row mt centered">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Edit Employee Account</h1>
        @if(Session::has('global'))
		    <p class="text-danger emphasize"> {{ Session::get('global') }} </p>
		    @endif
      </div>
    </div><!-- /row -->
    <div class="row mt">
      <div class="col-lg-12">
        <form class="form-horizontal" role="form" method="POST" action="{{ URL::route('profile-employee-edit', array('username' => $username=e($employee->username) )) }}">
          <div class="row">
            <h4>Account Details</h4>
            <div class="col-lg-6">
              <div class="row">
              	<div class="col-lg-3 col-lg-offset-1">
                	<label>Username</label>
              	</div>
                <div class="col-lg-8">
                	{{ $username }}
                </div>
              </div>
             </div>
             <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-4 col-lg-offset-1">
                	<label>Date Last Updated</label>
              	</div>
                <div class="col-lg-7">
                	{{ e($employee->account->updated_at) }}
                </div>
              </div>
            </div>
          </div><!-- /row -->
          <div class="row">
            <h4>Employee Information</h4>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-3 col-lg-offset-1">
                	<label>Name</label>
              	</div>
                <div class="col-lg-8">
                	{{ e($employee->first_name) . " " . e($employee->middle_name) . " " . e($employee->last_name) }}
                </div>
              </div>
             <div class="row">
                <div class="col-lg-3 col-lg-offset-1">
                	<label>Email</label>
              	</div>
                <div class="col-lg-8">
                	{{ e($employee->email) }}
                </div>
              </div>
              <div class="row">
                <div class="col-lg-3 col-lg-offset-1">
                	<label>Mobile Number</label>
              	</div>
                <div class="col-lg-8">
                	{{ e($employee->mobile) }}
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-lg-offset-1">
              <div class="form-group">
                <label for="department" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-9 col-lg-offset-1">
                	<select class="form-control" id="department" name="department">
                      @foreach($departments as $department)
                      	@if(e($department->department_id) == e($employee->department_id))
                      		<option value="{{ e($department->department_id) }}" selected="selected">{{ e($department->department) }}</option>
                      	@else
                      		<option value="{{ e($department->department_id) }}">{{ e($department->department) }}</option>
	                    @endif
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
                	<?php $positionList = ['0' => 'Member', '1' => 'Head', '2' => 'System Admin'];?>
           
                	<select class="form-control" id="position" name="position">
	                	@for ($pL = 0; $pL < sizeof($positionList); $pL++)
		                	@if($pL == e($employee->position))
		                		<option value="{{ $pL }}" selected="selected">{{ $positionList[$pL] }}</option>
		                	@else
		                		<option value="{{ $pL }}">{{ $positionList[$pL] }}</option>
		                	@endif
		                @endfor
		            </select>
		            @if($errors->has('position'))
	                  	<p class="bg-danger">{{ $errors->first('position') }}</p>
	                  @endif
                </div>
              </div>
            </div>
          </div><!-- /row -->
          <div class="row mt">
            <div class="col-lg-4 col-lg-offset-5">
              <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Save</button>
              <a href="{{ URL::route('admin-employee-deactivate', $username) }}"><button type="button" class="btn btn-lg btn-danger" id="submit_deactivate" name="submit_deactivate">Deactivate</button></a>
            </div>
          </div><!-- /row -->
        </div>
        {{ Form::token() }}
        </form><!-- /form -->
      </div>
    </div><!-- /row -->
  </div>
@stop

@section('scripts')
</script>
@stop