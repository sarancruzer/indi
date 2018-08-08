<?php
namespace App\Services;

use App\Dao\LoginDAO as LoginDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Components\MailComponent as MailComponent;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;


/**
* Class LoginService
* @package App\Services
* Service class for login
*/
class LoginService
{
		
		/*userLogin
		05/07/2018 created by muthu
		*/
		public function loginuser($login_details){
			
			$email    = $login_details->email;
			$password = $login_details->password;
			$err_msg=[];
			if(trim(isset($email)?$email:'')=='')
			$err_msg[]='Email is required';
			if(trim(isset($password)?$password:'')=='')
			$err_msg[]='Password is required';
			$response = new ResponseHandler();
			if(empty($err_msg))
			{
				$login_dao = new LoginDAO();
				$response  = new ResponseHandler(); 
				
				$login_response = $login_dao->login($email,$password);
				if(isset($login_response['result']) && $login_response['result'] == 1)
				{
					return $response->encode_response(['status' => 'success', 'message' => 'Login Successfully','login_details'=>$login_response['user_details'][0]]);
				}
				else if($login_response['result']=='fail')
				{
					return $response->encode_response(['status' => 'failure', 'message' => $login_response['user_details']]);
				}
				else
				{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid details']);
				}
				
			}else{
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
			}
			
		}
		
		/*userChangePassword
		05/07/2018 created by muthu
		*/
		
		public function loginchangePassword($login_details){
			$id             = $login_details->id;
			$password          = $login_details->old_password;
			$new_password      = $login_details->new_password;
			$confirm_password  = $login_details->confirm_password;
			
			$err_msg=[];
			
			if(trim(isset($password)?$password:'')=='')
			$err_msg[]='old password is required';
			if(trim(isset($new_password)?$new_password:'')=='')
			$err_msg[]='new password is required';
			else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,15}$/',$new_password)) 
			$err_msg[]='Password length should be mininum 8 and maximum 15 characters.Password must include at least one number,one CAPS and one symbol!';
			if(trim(isset($confirm_password)?$confirm_password:'')=='')
			$err_msg[]='Confirm password is required';
			else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,15}$/',$confirm_password)) 
			$err_msg[]='Password length should be mininum 8 and maximum 15 characters.Password must include at least one number,one CAPS and one symbol!';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				
				$login_dao = new LoginDAO();
				$response  = new ResponseHandler(); 
				$change_password = $login_dao->change_user_password($id,$password,$new_password,$confirm_password);
				if((isset($change_password['result']) && $change_password['result'] == 1) && ($new_password == $confirm_password))
				{
					return $response->encode_response(['status' => 'success', 'message' => 'Password changed Successfully']);
				}else if($new_password != $confirm_password){
					return $response->encode_response(['status' => 'failure', 'message' => 'new password and confirm password mismatch']);
				}
				else
				{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid old Password']);
				}
				
			}else{
				return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
			}
		}
		
			
			/*userActivate
		11/07/2018 created by muthu
		*/
		public function loginActivation($key){
			$key = $key->key;
			$user_dao = new LoginDAO();
			$resUser = $user_dao->loginActivate($key);
			$response = new ResponseHandler();
			if($resUser['result'] =='success'){
				return $response->encode_response(['result' => 'success', 'message' => "Account activated successfully"]);
			}else{
				return $response->encode_response(['result' => 'fail', 'message' =>"Your account alreday activated"]);
			}
			
		}
		
		/*userForgotPassword
		05/07/2018 created by muthu
		*/
		
		public function loginforgotPassword($login_details){
			
			
			$email          = $login_details->email;
			
			$err_msg=[];
			if(trim(isset($email)?$email:'')=='')
			$err_msg[]='Email is required';
			
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$login_dao = new LoginDAO();
				$response  = new ResponseHandler(); 
				$forgot_password = $login_dao->forgot_password($email);
				if($forgot_password['result'] == 1)
				{
					$message_replace = array(
					    		'user_name'=> $email,
								'user_email'=> $email,
					    		'loginurl'=> SITE_URL.'/login/forgot_password?key='.$forgot_password['user_details']
					    	);
					$subject_replace = '';
					$slug = 'forgot_password';
					$mail_config = new MailComponent();
					$send_status = $mail_config->sendEmail($slug, $email, $subject_replace, $message_replace);
							
				}
				else
				{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid details']);
				}
				
			}else{
				return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
			}
			
		}
		
		/*loginActivate
		16/07/2018 created by muthu
		*/
		
		public function loginActivate($arrPost){
			
			$key = base64_decode($_GET['key']);
			$err_msg=[];
			if(trim(isset($arrPost->new_password)?$arrPost->new_password:'')=='')
			$err_msg[]='Password is required';
			else
			{
				$pwd=$arrPost->new_password;
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
			if(trim(isset($arrPost->confirm_password)?$arrPost->confirm_password:'')==''){
				$err_msg[]='Confirm password is required';
			}	
			if($arrPost->confirm_password!='' || $arrPost->confirm_password!=''){
				if($pwd != $arrPost->confirm_password)
				$err_msg[]='New password and confirm password did not match';
			}
			
			$response = new ResponseHandler();
			if(empty($err_msg)){
				
				$login_dao = new loginDAO();
				$resUser  = $login_dao->updateNewPassword($pwd,$key);
				return $response->encode_response(['status' => 'success', 'message' =>$resUser['user_details']]);
				
			}else{
				return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
			}
			
		}
		
		public function listSupplier(){
			
				$login_dao = new LoginDAO();
				$response  = new ResponseHandler(); 
				
				$login_response = $login_dao->listSupplier();
			
		}
		
}
