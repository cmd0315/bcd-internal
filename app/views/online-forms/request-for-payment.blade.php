@extends('layout.form-master')

@section('content')
	<form class="form" role="form" method="POST" action="{{ URL::route('request-for-payment-post') }}">
		<div class="row-fluid form-header">
			<h2 class="form-title">REQUEST FOR PAYMENT</h2>
			<h4 class="form-number">No. 2342</h4>
		</div>
		<div class="row-fluid">
			<div class="col-lg-8 form-inputs">
				<div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 first">
							<label for="payee" class="col-sm-2 control-label form-label">Payee</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="payee" name="payee"{{ (Input::old('payee')) ? ' value ="' . Input::old('payee') . '"' : '' }} placeholder="Name of Payee">
								@if($errors->has('payee'))
									<p class="bg-danger">{{ $errors->first('payee') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<label for="particulars" class="col-sm-2 control-label form-label">Particulars</label>
					<div class="col-sm-10">
						<textarea class="form-control" id="particulars" name="particulars"{{ (Input::old('particulars')) ? ' value ="' . Input::old('particulars') . '"' : '' }} rows="10" placeholder="Request Particulars"></textarea>
						@if($errors->has('particulars'))
							<p class="bg-danger">{{ $errors->first('particulars') }}</p>
						@endif
					</div>
	            </div>
			</div>
			<div class="col-lg-4 form-inputs right">
				<div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 first">
							<label for="date_requested" class="col-sm-2 control-label form-label">Date</label>
							<div class="col-sm-10">
								<input type="date" class="form-control" id="date_requested" name="date_requested"{{ (Input::old('date_requested')) ? ' value ="' . Input::old('date_requested') . '"' : '' }}>
								@if($errors->has('date_requested'))
									<p class="bg-danger">{{ $errors->first('date_requested') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<label for="total_amount" class="col-sm-3 control-label form-label">Amount</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="total_amount" name="total_amount"{{ (Input::old('total_amount')) ? ' value ="' . Input::old('total_amount') . '"' : '' }} placeholder="Total Amount">
						@if($errors->has('total_amount'))
							<p class="bg-danger">{{ $errors->first('total_amount') }}</p>
						@endif
					</div>
	            </div>
			</div>
		</div>
		<div class="row-fluid form-divider">
			<div class="col-lg-4 form-inputs form-meta">
				<div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 meta-firsts">
							<label for="client" class="col-sm-5 control-label form-label">Charge to (Client/Project)</label>
							<div class="col-sm-7">
								{{ Form::select('client', $clients, Input::old('client'), array('class' => 'form-control')) }}
								@if($errors->has('client'))
									<p class="bg-danger">{{ $errors->first('client') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 meta-firsts">
							<label for="check_num" class="col-sm-4 control-label form-label">C.E. No.</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="check_num" name="check_num"{{ (Input::old('check_num')) ? ' value ="' . Input::old('check_num') . '"' : '' }} placeholder="Check Number">
								@if($errors->has('check_num'))
									<p class="bg-danger">{{ $errors->first('check_num') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	           	<div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 meta-firsts">
							<label for="date_needed" class="col-sm-4 control-label form-label">Date Needed</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" id="date_needed" name="date_needed"{{ (Input::old('date_needed')) ? ' value ="' . Input::old('date_needed') . '"' : '' }}>
								@if($errors->has('date_needed'))
									<p class="bg-danger">{{ $errors->first('date_needed') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12">
							<label for="received_by" class="col-sm-4 control-label form-label">Received By</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="received_by" name="received_by"{{ (Input::old('received_by')) ? ' value ="' . Input::old('received_by') . '"' : '' }} placeholder="Name of Receiver">
								@if($errors->has('received_by'))
									<p class="bg-danger">{{ $errors->first('received_by') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
			</div>
			<div class="col-lg-4 col-lg-offset-1 form-inputs form-meta">
				<div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 meta-firsts">
							<label for="requested_by" class="col-sm-5 control-label form-label">Requested By</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="requested_by" name="requested_by"{{ (Input::old('requested_by')) ? ' value ="' . Input::old('requested_by') . '"' : '' }} placeholder="Name of Requestor">
								@if($errors->has('requested_by'))
									<p class="bg-danger">{{ $errors->first('requested_by') }}</p>
								@endif
							</div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<div class="row-fluid">
						<div class="col-lg-12 meta-firsts">
							<label for="department" class="col-sm-4 control-label form-label">Department</label>
							<div class="col-sm-8">
			                  	{{ Form::select('department', $departments, Input::old('department'), array('class' => 'form-control')) }}
			                  @if($errors->has('department'))
			                  	<p class="bg-danger">{{ $errors->first('department') }}</p>
			                  @endif
			                </div>
						</div>
					</div>
	            </div>
	            <div class="form-group">
					<label for="approved_by" class="col-sm-5 control-label form-label">Approved By</label>
					<div class="col-sm-7">
						<input type="text" class="form-control" id="approved_by" name="approved_by"{{ (Input::old('approved_by')) ? ' value ="' . Input::old('approved_by') . '"' : '' }} placeholder="Name of Approver">
						@if($errors->has('approved_by'))
							<p class="bg-danger">{{ $errors->first('approved_by') }}</p>
						@endif
					</div>
	            </div>
			</div>
			<div class="col-lg-3">
				@include('layout.partials.bcd-ci')
			</div>
		</div>
		<div class="row-fluid mt">
			<div class="col-lg-1 col-lg-offset-11">
			  <button type="submit" class="btn btn-lg btn-warning" id="submit_form" name="submit_form">Submit</button>
			</div>
		</div><!-- /row -->
    	{{ Form::token() }}
	</form>
@stop
@section('scripts')
$('#rfp-link').css('color', '#f05926');
@stop