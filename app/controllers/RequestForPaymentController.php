<?php

class RequestForPaymentController extends BaseController {
	
	public function getForm() {
		return 	View::make('online-forms.request-for-payment', array('pageTitle' => 'Request for Payment'))
				->with("departments", Department::orderBy('department')->lists('department', 'department_id'))
				->with("clients", Client::orderBy('client_name')->lists('client_name', 'client_id'));

	}

	public function postForm() {
		$validator = Validator::make(Input::all(),
			array(
				'payee' => 'required|max:250|min:2|alpha',
				'particulars' => 'required|min:2',
				'date_requested' => 'required',
				'total_amount' => 'required|numeric',
				'client' => 'required',
				'check_num' => 'required|numeric',
				'requested_by' => 'required|max:250|min:2|alpha',
				'department' => 'required',
				'approved_by' => 'alpha',
				'received_by' => 'alpha'
			)
		);

		if($validator->fails()) {
			return 	Redirect::route('request-for-payment')
					->withErrors($validator)
					->withInput();
		}
		else {
			//Get form values
			$payee 				= Input::get('payee');
			$particulars 		= Input::get('particulars');
			$date_requested 	= Input::get('date_requested');
			$total_amount 		= Input::get('total_amount');
			$client 			= Input::get('client');
			$check_num 			= Input::get('check_num');
			$requested_by 		= Input::get('requested_by');
			$department_id 		= Input::get('department');
			$date_needed 		= Input::get('date_needed');
			$approved_by 		= Input::get('approved_by');
			$received_by 		= Input::get('received_by');

			// $form_num = $this->generateFormNum();
			$old_form_num = OnlineForm::orderBy('id', 'DESC')->pluck('form_num');
			$old_form_num = substr($old_form_num, 3);
			$new_form_num = $old_form_num + 1;
			$form_num = 'OF-' . $new_form_num;

			$username = Auth::user()->username;

			$onlineForm = OnlineForm::create(array(
				'form_num' => $form_num,
				'category' => 'RFP',
				'created_by' => $username
			));

			// //Add to rfps table
			$rFP = RequestForPayment::create(array(
				'form_num' => $form_num,
				'payee' => $payee,
				'particulars' => $particulars,
				'date_requested' => $date_requested,
				'total_amount' => $total_amount,
				'client' => $client,
				'check_num' => $check_num,
				'requested_by' => $requested_by,
				'department_id' => $department_id,
				'date_needed' => $date_needed,
				'approved_by' => $approved_by,
				'received_by' => $received_by
			));

			$return_msg = "";

			if($onlineForm) {
				if($rFP) {
					$return_msg = "Request for Payment form is successfully submitted. View all submitted forms " . "<a href=\"#\">" . "here.</a>";
				}
				else {
					$return_msg = "Failed to create request for payment!";
				}
			}
			else {
				$return_msg = "Failed to create online form!";
			}

			return 	Redirect::route('request-for-payment')
					->with('global', $return_msg);
		}
	}

	public function generateFormNum() {
		$generated_id = "D-" . strtoupper(RandomNumberGenerator::generateRandomString(4));

		$number_exists = RequestForPayment::where('form_num', $generated_id)->get();

		if($number_exists->count()) {
			generateID();
		}
		else{
			return $generated_id;
		}
	}

}
