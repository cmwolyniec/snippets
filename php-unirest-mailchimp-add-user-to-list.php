<?php
//get user from database
$member = Member::get()->byID(1);
// add user to MailChimp list
addSubscriberToMailChimpList($member);

	private function addSubscriberToMailChimpList($member) {
		try { 
			$listid = '434115151251'; // list id from MailChimp
			$authKey = '1243124124144124'; // authentication API key
			// api uri
			$api = 'https://us12.api.mailchimp.com/3.0/lists/'.$listid.'/members';
			$headers = array('Content-Type' => 'application/json');
			// setup Unirest request
			Unirest\Request::auth('user', $authKey);
			Unirest\Request::verifyPeer(false);
			 // setup Unirest data
			$mergeFields = array('FNAME' => $member->FirstName, 'LNAME'=> $member->Surname);
			$data = array('email_address' => $member->Email, 'status' => 'subscribed', 'merge_fields' => $mergeFields);
			$body = Unirest\Request\Body::json($data);
			// post request, receive response
			$response = Unirest\Request::post($api, $headers, $body);
				
			} catch (Exception $e) {

			}
	  }

	}