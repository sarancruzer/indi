<?php
namespace App\Services;

/*ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);*/

use App\Request\RequestHandler as RequestHandler;
use App\Response\ResponseHandler as ResponseHandler;
use App\Components\MailComponent as MailComponent;
use App\Dao\UserDAO as UserDAO;

/**
* Class UserService
* @package App\Services
* Service class for user detail
* Created By : Arun.M
*/
class UserService
{
	/**
	* @to fetch the available user list.
	* @output mixed
	**/
	public function userList($filter)
	{
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->userList($filter);
		// call to dao to validate the user details

		$response = new ResponseHandler();
		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'user_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}
	/**
	* To edit user for the survey
	* @input array
	* @output json response
	**/
	public function userget($id)
	{
		$response = new ResponseHandler();
		if(!isset($id->id)){
			// success call
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'ID Required']);
		}
		
		
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->userGet($id->id);
		// call to dao to validate the user details

		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'user_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}	
	/**
	* To add user for the survey
	* @input array
	* @output json response
	**/
	
	public function userSave($arrPost)
	{
		//echo "<pre>";print_r($arrPost);exit;
		$generatedKey = sha1(mt_rand(10000,99999).time().$arrPost->email);
		$err_msg=[];
		if(trim(isset($arrPost->business_name)?$arrPost->business_name:'')=='' && $arrPost->role=='2')
		$err_msg[]='Business name is required';
		if(trim(isset($arrPost->first_name)?$arrPost->first_name:'')=='' && $arrPost->role=='1')
		$err_msg[]='First name is required';
		if(trim(isset($arrPost->last_name)?$arrPost->last_name:'')=='' && $arrPost->role=='1')
		$err_msg[]='Last name is required';
		/*if(trim(isset($arrPost->role)?$arrPost->role:'')=='')
		$err_msg[]='Role is required';*/
		if(trim(isset($arrPost->email)?$arrPost->email:'')=='')
		$err_msg[]='Email is required';
		else if(filter_var($arrPost->email, FILTER_VALIDATE_EMAIL)== false)
		$err_msg[]='Invalid Email';
		if(trim(isset($arrPost->contact_number)?$arrPost->contact_number:'')=='')
		$err_msg[]='Contact number is required';
		else if(preg_match('/^[0-9]{10}+$/', $arrPost->contact_number)== false)
		$err_msg[]='Invalid Contact number';
		if(trim(isset($arrPost->password)?$arrPost->password:'')=='')
		$err_msg[]='Password is required';
		else
		{
			$pwd=$arrPost->password;
			if( strlen($pwd) < 8 ) {
			$err_msg[]= "Password too short!";
			}

			if( strlen($pwd) > 15 ) {
			$err_msg[]= "Password too long!";
			}

		
			if( !preg_match("#[0-9]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one number!";
			}

			if( !preg_match("#[a-z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one letter!";
			}

			if( !preg_match("#[A-Z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one CAPS!";
			}

			if( !preg_match("#\W+#", $pwd) ) {
			$err_msg[]= "Password must include at least one symbol!";
			}
		}
		if(trim(isset($arrPost->confirmpassword)?$arrPost->confirmpassword:'')=='' && $arrPost->role=='1')
		$err_msg[]='Confirm password is required';
		else if($arrPost->password != $arrPost->confirmpassword && $arrPost->role=='1')
		$err_msg[]='Password and confirm paswword did not match';
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new userDAO();
			$resUser = $user_dao->userSave($arrPost);
			if($resUser['result'] == 'success'){
			$key = base64_encode($resUser['activation_key']);	
			$message_replace = array(
					    		'user_name'=> $arrPost->email,
								'user_email'=> $arrPost->email,
					    		'loginurl'=> SITE_URL.'/Activation?key='.$key
					    	);
			$subject_replace = '';
			$slug = 'new-user-creation';
			$mail_config = new MailComponent();
			$send_status = $mail_config->sendEmail($slug, $arrPost->email, $subject_replace, $message_replace);
			return $response->encode_response(['status' => 'success', 'data' => $resUser,'msg'=>'Account created successfully']);
			}else{
				return $response->encode_response(['status' => 'error', 'message' => $resUser]);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	/*userExist
	12/07/2018 created by muthu
	*/
	public function userExist($user_request){
		$user_dao = new userDAO();
		$resUser = $user_dao->userExist($user_request);
		$response = new ResponseHandler();
		if($resUser['result'] =='fail'){
			return $response->encode_response(['result' => 'fail', 'message' => $resUser['errorDescription']]);
		}else{
			return $response->encode_response(['result' => '', 'message' =>""]);
		}
		
		
	}
	
	
	
	/**
	* To update user 
	* @input array
	* @output json response
	**/
	
	public function userUpdate($arrPost)
	{
		
		$err_msg=[];
		
		/*if(trim(isset($arrPost->id)?$arrPost->id:'')=='')
		$err_msg[]='ID is required';*/
		if(trim(isset($arrPost->business_name)?$arrPost->business_name:'')=='' && $arrPost->role=='2')
		$err_msg[]='Business name is required';
		if(trim(isset($arrPost->first_name)?$arrPost->first_name:'')=='' && $arrPost->role=='1')
		$err_msg[]='First name is required';
		if(trim(isset($arrPost->last_name)?$arrPost->last_name:'')=='' && $arrPost->role=='1')
		/*if(trim(isset($arrPost->role_id)?$arrPost->role_id:'null')=='')
		$err_msg[]='Role ID is required';*/
		if(trim(isset($arrPost->email)?$arrPost->email:'null')=='')
		$err_msg[]='Email is required';
		else if(isset($arrPost->email) && filter_var($arrPost->email, FILTER_VALIDATE_EMAIL)== false)
		$err_msg[]='Invalid Email';
		if(trim(isset($arrPost->contact_number)?$arrPost->contact_number:'null')=='')
		$err_msg[]='Contact number is required';
		else if(isset($arrPost->contact_number) && preg_match('/^[0-9]{10}+$/', $arrPost->contact_number)== false)
		$err_msg[]='Invalid Contact number';
		/*if(trim(isset($arrPost->password)?$arrPost->password:'null')=='')
		$err_msg[]='Password is required';
		else
		{
			$pwd=$arrPost->password;
			if( strlen($pwd) < 8 ) {
			$err_msg[]= "Password too short!";
			}

			if( strlen($pwd) > 15 ) {
			$err_msg[]= "Password too long!";
			}

		
			if( !preg_match("#[0-9]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one number!";
			}

			if( !preg_match("#[a-z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one letter!";
			}

			if( !preg_match("#[A-Z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one CAPS!";
			}

			if( !preg_match("#\W+#", $pwd) ) {
			$err_msg[]= "Password must include at least one symbol!";
			}
		}
		if(trim(isset($arrPost->logged_user_id)?$arrPost->logged_user_id:'')=='')
		$err_msg[]='logged_user_id is required';*/
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new userDAO();
			$resUser = $user_dao->userUpdate($arrPost);
			if(!empty($resUser)){
				// success call
				return $response->encode_response(['status' => 'success', 'data' => $resUser]);
			}else{
				// invalid 
				return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	
	/**
	* To delete user
	* @input array
	* @output json response
	**/
	public function userDelete($request)
	{
		$response = new ResponseHandler();
		
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->userDelete($request);
		
		
		
		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'user_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}	
	/**
	* @to fetch the available roles list.
	* @output mixed
	**/
	public function userRoles($filter)
	{
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->userRoles($filter);
		// call to dao to validate the user details

		$response = new ResponseHandler();
		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'user_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}
	
	public function userSupplier($filter){
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->supplierList($filter);

		$response = new ResponseHandler();
		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'user_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
		
	}
	
	
	public function userImage(){
			
			$str =((file_get_contents('php://input')));
			if (strpos($str, "image/jpeg") !== false) {
			$t=explode("image/jpeg",$str);
			$filename = md5(time()).'.jpg';
			}
			else if (strpos($str, "image/png") !== false) {
			$t=explode("image/png",$str);
			$filename = md5(time()).'.png';
			}
			else if (strpos($str, "image/gif") !== false) {
			$t=explode("image/gif",$str);
			$filename = md5(time()).'.gif';
			}
			else if (strpos($str, "image/jpeg") !== false) {
			$t=explode("image/jpeg",$str);
			$filename = md5(time()).'.jpeg';
			}
			else
				$err="Invalid Format";
			
			 $response = new ResponseHandler();
			if(isset($err))
			{
				
				return $response->encode_response(['status' => 'failure', 'message' => $err]);
			}
			else
			{
				$path="App/Services/profile_images/".$filename;
				file_put_contents($path,ltrim($t[1]));
				return $response->encode_response(['status' => 'success', 'image_Details' => $filename]);
			}
	}
	
	public function userSupplieradd($arrPost)
	{
		$generatedKey = sha1(mt_rand(10000,99999).time().$arrPost->email);
		$err_msg=[];
		/*if(trim(isset($arrPost->module)?$arrPost->module:'')=='')
		$err_msg[]='Product module is required';*/
		if(trim(isset($arrPost->business_name)?$arrPost->business_name:'')=='')
		$err_msg[]='Business name is required';
		if(trim(isset($arrPost->email)?$arrPost->email:'')=='')
		$err_msg[]='Email is required';
		else if(filter_var($arrPost->email, FILTER_VALIDATE_EMAIL)== false)
		$err_msg[]='Invalid Email';
		if(trim(isset($arrPost->contact_number)?$arrPost->contact_number:'')=='')
		$err_msg[]='Contact number is required';
		else if(preg_match('/^[0-9]{10}+$/', $arrPost->contact_number)== false)
		$err_msg[]='Invalid Contact number';
		if(trim(isset($arrPost->password)?$arrPost->password:'')=='')
		$err_msg[]='Password is required';
		else
		{
			$pwd=$arrPost->password;
			if( strlen($pwd) < 8 ) {
			$err_msg[]= "Password too short!";
			}

			if( strlen($pwd) > 15 ) {
			$err_msg[]= "Password too long!";
			}

		
			if( !preg_match("#[0-9]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one number!";
			}

			if( !preg_match("#[a-z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one letter!";
			}

			if( !preg_match("#[A-Z]+#", $pwd) ) {
			$err_msg[]= "Password must include at least one CAPS!";
			}

			if( !preg_match("#\W+#", $pwd) ) {
			$err_msg[]= "Password must include at least one symbol!";
			}
		}
		if(trim(isset($arrPost->confirmPassword)?$arrPost->confirmPassword:'')=='')
		$err_msg[]='Confirm password is required';
		else if($arrPost->password != $arrPost->confirmPassword)
		$err_msg[]='Password and confirm paswword did not match';
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new userDAO();
			$resUser = $user_dao->userSupplieradd($arrPost);
			if($resUser['result'] == 'success'){
			$key = base64_encode($resUser['activation_key']);	
			/*$message_replace = array(
					    		'user_name'=> $arrPost->first_name,
								'user_email'=> $arrPost->email,
					    		'loginurl'=> SITE_URL.'/user/Activation?key='.$key
					    	);
			$subject_replace = '';
			$slug = 'new-user-creation';
			$mail_config = new MailComponent();
			//$send_status = $mail_config->sendEmail($slug, $arrPost->email, $subject_replace, $message_replace);*/
			return $response->encode_response(['status' => 'success', 'data' => $resUser,'msg'=>'Account created successfully']);
			}else{
				return $response->encode_response(['status' => 'error', 'message' => $resUser]);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	
	public function userSupplierupdate($arrPost)
	{
		
		if(trim(isset($arrPost->business_name)?$arrPost->business_name:'')=='')
		$err_msg[]='Business name is required';
		if(trim(isset($arrPost->email)?$arrPost->email:'')=='')
		$err_msg[]='Email is required';
		if(trim(isset($arrPost->contact_number)?$arrPost->contact_number:'')=='')
		$err_msg[]='Contact number is required';
		else if(preg_match('/^[0-9]{10}+$/', $arrPost->contact_number)== false)
		$err_msg[]='Invalid Contact number';
		
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new userDAO();
			$resUser = $user_dao->userSupplierupdate($arrPost);
			if($resUser['result'] == 'success'){
			
			return $response->encode_response(['status' => 'success', 'data' => $resUser,'msg'=>'profile updated successfully']);
			}else{
				return $response->encode_response(['status' => 'error', 'message' => $resUser]);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
}
