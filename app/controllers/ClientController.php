<?php

	class ClientController extends BaseController {
		/*view add client form */
		public function getAddClient() {
			return 	View::make('admin.add-client', array('pageTitle' => 'Add Client'));
		}

		/*post add client form */
		public function postAddClient() {
			$validator = Validator::make(Input::all(),
				array(
					'client_id' => 'required|max:10|min:3|unique:clients',
					'client_name' => 'required|max:20|min:2|unique:clients'
				)
			);

			if($validator->fails()) {
				//Redirect to signin page
				return 	Redirect::route('admin-client-add')
						->withErrors($validator)
						->withInput();
			}
			else {
				//Create department
				$client_id 		= Input::get('client_id');
				$client_name 	= Input::get('client_name');

				//Add to departments table
				$client = Client::create(array(
					'client_id' => $client_id,
					'client_name' => $client_name,
					'status' => 1
				));

				if($client) {
					return 	Redirect::route('admin-client-add')
							->with('global', 'Client Record Added!');
				}
				else {
						return 	Redirect::route('admin-client-add')
								->with('global', 'Failed to add client record');
				}

			}
		}

		public function getEditClient($clientID) {
			$client = Client::where('client_id', $clientID);

			if($client->count()){
				$client = $client->first();

				return 	View::make('profile.client', array('pageTitle' => 'Edit Client Information'))
						->with('client', $client);
			}

			return App::abort(400);
		}

		public function postEditClient($clientID) {
			$validator = Validator::make(Input::all(), 
				array(
					'client_name' => 'required|max:20|min:2'
				)
			);

			$return_msg = "";
			if($validator->fails()) {
				return 	Redirect::route('admin-client-edit', array('clientID' => $clientID))
						->withErrors($validator)
						->withInput();
			}
			else {
				$client_id 		= Input::get('client_id');
				$client_name 	= Input::get('client_name');
				
				$client = Client::where('client_id', $clientID)->first();		
				$client_exists = Client::where('client_id', '!=', $client_id)->where('client_name', $client_name)->first();

				if($client->count() && !($client_exists)){
					$client->client_name = $client_name;

					if($client->save()){
						$return_msg ="Department information is updated!";
					}
					else{
						$return_msg = "Failed to update client information! Error on saving the changes";
					}
				}
				else{
					$return_msg = 'Failed to update the client information! Error on finding the client record or client record with similar name already exists!';
				}

				return 	Redirect::route('admin-client-edit', array('clientID' => $client_id))
						->with('global', $return_msg);
			}
		}
	}