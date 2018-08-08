<?php
namespace App\Dao;

use App\Entities;

use App\Entities\User as User;
use App\Resources\DbResource as DbResource;

use \PHPMailer\PHPMailer\PHPMailer;
/**
* Class LoginDAO
* @package App\Dao
* Dao class for login
*/

class LoginDAO extends DbResource{
	
	/**
	* @to validate the login parameters using orm.
	* @input post request
	* @output mixed
	**/	
	
	/*userLogin
	05/07/2018 created by muthu
	*/
	
	public function login($email,$password)
	{
		
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('u.email','rm.role','u.password','u.status','u.id','u.business_name','u.contact_number')
			->from('App\Entities\User', 'u')
			->leftJoin('App\Entities\RoleMaster', 'rm', 'WITH', ' rm.id = u.role_id')
			->andWhere('u.email=:un')->setParameter('un', $email)
			->getQuery();
			
			$user_details = $query->getArrayResult();
			if($user_details){
				$verify_password = password_verify($password,$user_details[0]['password']);
				if($user_details[0]['status'] == 0){
					return array('result'=>0,'user_details' => '','user_details'=>'Your account not activated yet');
				}	
				else if($verify_password == 1){
					unset($user_details[0]['password']);
					unset($user_details[0]['status']);
					return array('result'=>1,'user_details' => $user_details,'errorDescription' => 'Email and password has been wrong');
				}
				else{
				  return array('result'=>0,'user_details' => '','user_details'=>'Email and password has been wrong');
				}  
			}else{
				return array('result'=>'fail','user_details' => '','user_details'=>'Invalid details');
			}
		}catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
	}
	
	/*userActivate
	11/07/2018 created by muthu
	*/
	
	public function loginActivate($key){
		try{
		 
           $query = $this->entityManager->createQueryBuilder()->select('u')
			->from('App\Entities\User', 'u')
			->andWhere('u.activation_key=:ak')->setParameter('ak', $key)
			->getQuery();
			
		   $user_details = $query->getArrayResult();
		   if($user_details){
			   if($user_details[0]['status'] == 0){
					$em = $this->entityManager;
					$user_update = $em->getRepository(User::class)->find($user_details[0]['id']);
					$user_update->setStatus(1);
					$em->merge($user_update);
					$em->flush();
					return array('result'=>'success','message' => "Account activated successfully");
			   }else{
				   return array('result'=>'fail','message' => 'Your account already activated');
			   }	
				
			}
		}catch(Exception $e) {
			return array('result'=>'fail','user_id' => '','errorDescription'=>$e->getMessage());
		}			
		
	}
	/*userChangePassword
	05/07/2018 created by muthu
	*/
	
	public function change_user_password($id,$password,$new_password,$confirm_password)
	{
		try{
 			$query = $this->entityManager->createQueryBuilder()->select('u.id','u.password')
			->from('App\Entities\User', 'u')
			->andWhere('u.id=:un')->setParameter('un', $id)
			->getQuery();
			
			$user_details = $query->getArrayResult();
			if($user_details){
				$verify_password = password_verify($password,$user_details[0]['password']);
				if($verify_password ==1 && ($new_password==$confirm_password)){
					$em = $this->entityManager;
					$user_update = $em->getRepository(User::class)->find($user_details[0]['id']);
					$user_update->setPassword(password_hash($new_password, PASSWORD_BCRYPT));
					$em->merge($user_update);
					$em->flush();
					return array('result'=>1,'user_details' => $user_details,'errorDescription' => '');
				}else{
					return array('result'=>0,'user_details' => '','user_details'=>'Invalid old password');
				}
				
			}	
			 else{
				 
				return array('result'=>0,'user_details' => '','user_details'=>'Invalid details');
			}	
			
		}catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
	}
	
	/*userForgotPassword
	05/07/2018 created by muthu
	*/
	
	public function forgot_password($email){
		
		
		try{
 			$query = $this->entityManager->createQueryBuilder()->select('u.id')
			->from('App\Entities\User', 'u')
			->andWhere('u.email=:un')->setParameter('un', $email)
			->getQuery();
			
			$user_details = $query->getArrayResult();
			
			if($user_details){
					$forgt_password_key = sha1(mt_rand(10000,99999).time().$email);
					$em = $this->entityManager;
					$user_update = $em->getRepository(User::class)->find($user_details[0]['id']);
					$user_update->setForgotpasswordkey($forgt_password_key);
					$em->merge($user_update);
					$em->flush();
				
			 	return array('result'=>1,'user_details' => base64_encode($forgt_password_key),'errorDescription' => '');
			}	
			 else{
				return array('result'=>0,'user_details' => '','user_details'=>'Invalid details');
			}		
			
		}catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
		
	}
	
	/*updateNewPassword
	05/07/2018 created by muthu
	*/
	
	public function updateNewPassword($pwd,$key){
		try{
 			$query = $this->entityManager->createQueryBuilder()->select('u.id')
			->from('App\Entities\User', 'u')
			->andWhere('u.forgot_password_key=:pk')->setParameter('pk', $key)
			->getQuery();
			
			$user_details = $query->getArrayResult();
			if($user_details){
					$em = $this->entityManager;
					$user_update = $em->getRepository(User::class)->find($user_details[0]['id']);
					$user_update->setPassword(password_hash($pwd, PASSWORD_BCRYPT));
					$em->merge($user_update);
					$em->flush();
				
			 	return array('result'=>1,'user_details' => "Password changed successfully",'errorDescription' => '');
			}	
			 else{
				return array('result'=>0,'user_details' => '','user_details'=>'Invalid details');
			}	
			
		}catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
		
	}
	
	public function listSupplier(){
		
		try{
 			$query = $this->entityManager->createQueryBuilder()->select('u.id', 'u.first_name', 'u.last_name', 'u.business_name', 'rm.role',  'u.email')
			->from('App\Entities\User','u')			
			->leftJoin('App\Entities\RoleMaster', 'rm', 'WITH', ' rm.id = u.role_id')
			->Where('u.id=:user_id')->setParameter('user_id', $user_id);
			$query = $query->getQuery();
			 	return array('result'=>1,'user_details' => "Password changed successfully",'errorDescription' => '');
			
			
		}catch(Exception $e) {

			throw new Exception($e->getMessage());
		}
		
	}
	

}
