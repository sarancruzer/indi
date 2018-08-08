<?php
namespace App\Services;

ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

use App\Dao\AuthDAO as AuthDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Components\MailComponent as MailComponent;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;

class AuthService
{
	
	public function authToken()
	{
		$username = 'indigenous';
		$password = '123456';
		$token = array();
		$dao_request = new AuthDAO();
		$user_list_response = $dao_request->getToken($username,$password);

		$response = new ResponseHandler();
		if(count($token)>0){
			return $response->encode_response(['status' => 'success', 'token' => $token,'message' => '']);
		}else{
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}
}
