<?php
namespace App\Dao;

/*ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);*/

use App\Entities;
use App\Resources\DbResource as DbResource;
use App\Response\ResponseHandler as ResponseHandler;
use App\Entities\User as User;
use App\Entities\SuplierModule as SuplierModule;
use \Firebase\JWT\JWT;
/**
* Class usersDAO
* @package App\Dao
* 
*/

class UserDAO extends DbResource
{
	
	/**
	 * To get user List
	 * @return mixed
	 */
	public function userList($filter)
	{

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('u.id', 'u.first_name', 'u.last_name', 'u.business_name', 'rm.role',  'u.email','u.contact_number','u.is_deleted','u.role_id','u.prfl_img')
			->from('App\Entities\User', 'u')
			->leftJoin('App\Entities\RoleMaster', 'rm', 'WITH', ' rm.id = u.role_id');
			
			if(isset($filter->role))
			$query->andWhere('rm.role = :role')->setParameter('role', $filter->role);
			if(isset($filter->email))
			$query->andWhere('u.email LIKE :email')->setParameter('email', '%'.$filter->email.'%');
			$query->andWhere('u.is_deleted = :is_deleted')->setParameter('is_deleted', 0);
			$query->andWhere('u.role_id = :role_id')->setParameter('role_id', 1);
			/*if(isset($filter->status))
			$query->andWhere('u.status=:status')->setParameter('status', $filter->status);
			else
			$query->andWhere('u.status=:status')->setParameter('status', STATUS_ACTIVE);*/

			$query = $query->getQuery();
			
			$users_list = $query->getArrayResult();
			
			
			
			return array('result'=>'success','users_list' => $users_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}

	
	/**
	 * To get Particular user Details
	 * @param  int $user_id
	 * @return mixed
	 */
	public function userGet($user_id)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('u.id', 'u.first_name', 'u.last_name', 'u.business_name','u.email','u.contact_number','u.role_id','u.prfl_img')
			->from('App\Entities\User','u')			
			//->leftJoin('App\Entities\RoleMaster', 'rm', 'WITH', ' rm.id = u.role_id')
			->Where('u.id=:id')->setParameter('id', $user_id);
			$query = $query->getQuery();
			
			$user_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('b')
			->from('App\Entities\SupplierBlockOutDates', 'b')			
			->Where('b.supplier_id=:supplier_id')->setParameter('supplier_id', $user_id);
			$query = $query->getQuery();
			
			$blockout_detail = $query->getArrayResult();
			
			
			$users = array();
			foreach($user_detail as $users_li){
				$users_li['prfl_img'] =$users_li['prfl_img']?$users_li['prfl_img']:"noimage.png";
				$users[] = $users_li;
			}
			return array('result'=>'sucess','user_detail' => $users,'blockoutdates_detail' => $blockout_detail);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>'Invalid Link');
		}
	}

	
	
	/**
	* To add users
	**/
	public function userSave($user_request)
	{
			try{
			$query = $this->entityManager->createQueryBuilder()->select('u')
			->from('App\Entities\User', 'u')			
			->Where('u.email=:email')->setParameter('email', $user_request->email);
			$query = $query->getQuery();
			$user_detail = $query->getArrayResult();
			if(count($user_detail)>0)
			return array('result'=>'fail','msg'=>'Email already Exists');
			
			/*$query = $this->entityManager->createQueryBuilder()->select('rm')
			->from('App\Entities\RoleMaster', 'rm')			
			->Where('rm.id=:id')->setParameter('id', $user_request->role)
			->AndWhere('rm.status=:status')->setParameter('status', STATUS_ACTIVE);
			$query = $query->getQuery();
			
			$role = $query->getArrayResult();
			if(count($role)==0)
			return array('result'=>'fail','errorDescription'=>'Invalid Role');*/
			$generated_key = sha1(mt_rand(10000,99999).time().$user_request->email);
			$auth_code = $this->getRandomNo(RANDOM_DIGIT_COUNT);
			$em = $this->entityManager;
			$objuser = new User();
			if(isset($user_request->business_name))
			$objuser->setBusinessName($user_request->business_name);
			if(isset($user_request->first_name))
			$objuser->setFirstName($user_request->first_name);
			if(isset($user_request->last_name))
			$objuser->setLastName($user_request->last_name);
			$objuser->setEmail($user_request->email);
			$objuser->setPassword(password_hash($user_request->password, PASSWORD_BCRYPT));
			$objuser->setRoleId($user_request->role_id);
			$objuser->setAuthKey($auth_code);
			$objuser->setContactnumber($user_request->contact_number);
			$objuser->setActivationKey($generated_key);
			$objuser->setStatus(0);
			$objuser->setIsDeleted(0);
			$objuser->setCreatedOn(new \DateTime("now"));
			$em->persist($objuser);  
			$em->flush();
			
			if($user_request->role_id == 2){
			
				if($objuser->getId()){
					$supplier_id = $objuser->getId();
						$em = $this->entityManager; 
						$supplier_module = new SuplierModule();
						$supplier_module->setSupplierId($supplier_id);
						$supplier_module->setModule('indigenous_tour');
						$supplier_module->setStatus('1');
						$em->persist($supplier_module);  
						$em->flush();
				}
			}	
			
			
			return array('result'=>'success','user_id' => $objuser->getId(),"activation_key"=>$generated_key);
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	/**
	* To update users
	**/
	public function userUpdate($user_request)
	{
		try{
			if(isset($user_request->email))
			{
				$query = $this->entityManager->createQueryBuilder()->select('u')
				->from('App\Entities\User', 'u')			
				->Where('u.email=:email')->setParameter('email', $user_request->email)
				->AndWhere('u.id!=:id')->setParameter('id', $user_request->id);
				$query = $query->getQuery();
				
				$user_detail = $query->getArrayResult();
				 if(count($user_detail)>0)
				 return array('result'=>'fail','user_id' => '','errorDescription'=>'Email already Exists');
			}
			$em = $this->entityManager;
			$objuser = $em->getRepository(User::class)->find($user_request->id);
				
			
			if(isset($user_request->first_name))
			$objuser->setFirstName($user_request->first_name);
			if(isset($user_request->last_name))
			$objuser->setLastName($user_request->last_name);
			if(isset($user_request->contact_number))
			$objuser->setContactnumber($user_request->contact_number);
			if(isset($user_request->email))
			$objuser->setEmail($user_request->email);
			$objuser->setUpdatedOn(new \DateTime("now"));
			$em->merge($objuser);  
			$em->flush();
			return array('result'=>'success','user_id' => $objuser->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','user_id' => '','errorDescription'=>$e->getMessage());
		}			
	}
	
	
	/*userExist
	11/07/2018 created by muthu
	*/
	
	public function userExist($user_request){
		try{
			if(isset($user_request->email))
			{
				$query = $this->entityManager->createQueryBuilder()->select('u')
				->from('App\Entities\User', 'u')			
				->Where('u.email=:email')->setParameter('email', $user_request->email);
				
				$query = $query->getQuery();
				
				$user_detail = $query->getArrayResult();
				 if(count($user_detail)>0)
				 return array('result'=>'fail','errorDescription'=>'Email already Exists');
			}
		}catch(Exception $e) {
			return array('result'=>'fail','user_id' => '','errorDescription'=>"");
		}	
		
	}
	
	
	
	function getRandomNo($no, $str = "", $chr = 'ACESFHJKB0MNP19RTZUVGWXY4937D') {
		$chr .= uniqid();
		$length = strlen($chr);
		while($no --) {
			$str .= $chr{mt_rand(0, $length- 1)};
		}
		$encoded_uniq_id = md5($str);
		
		$em = $this->entityManager;
		$user_code_exist = $em->getRepository(user::class)->findOneBy(['auth_key' => $encoded_uniq_id]); 
		$em->flush();
		
		if(empty($user_code_exist)){
			return $str;
		}else{
			$this->getRandomNo(RANDOM_DIGIT_COUNT);
		}
	}	
	
	

	public function userDelete($id)
	{
		try
		{	
			$em = $this->entityManager;
			$objuser = $em->getRepository(User::class)->find($id);
			$objuser->setIsDeleted(1);
			$em->merge($objuser);
			$em->flush();
			return array('result'=>'success','message' => "User deleted successfully");
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
	/**
	 * To get roles List
	 * @return array
	 */
	public function userRoles($filter)
	{
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('rm')
			->from('App\Entities\RoleMaster', 'rm')
			->andWhere('rm.status=:status')->setParameter('status', STATUS_ACTIVE);

			$query = $query->getQuery();
			
			$users_list = $query->getArrayResult();
			return array('result'=>'success','roles_list' => $users_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}

	public function supplierList($filter)
	{
		try{
			
			$query1 = $this->entityManager->createQueryBuilder()
			->select('count(p.id)')
			->from('App\Entities\Products', 'p')		
			->Where('p.supplier_id=u.id');
			$query1 = $query1->getDQL();
			
		
		//	SELECT count(*),module FROM `products` WHERE supplier_id=5 and module="art" GROUP by module
			
 			$query = $this->entityManager->createQueryBuilder()
			->select('u.id','u.first_name','u.last_name','u.business_name','rm.role','u.email','u.contact_number','u.is_deleted','u.role_id','sm.module','u.prfl_img')
			->addSelect('(' . $query1 . ') as product_count')
			->from('App\Entities\User', 'u')
			->leftJoin('App\Entities\RoleMaster', 'rm', 'WITH', ' rm.id = u.role_id')
			->leftJoin('App\Entities\SuplierModule', 'sm', 'WITH', ' sm.supplier_id = u.id')
			
			->Where('u.role_id = :role_id');
	
			
			if(isset($filter->role))
			$query->andWhere('rm.name LIKE :name')->setParameter('name', '%'.$filter->role.'%');
			if($filter->module!='')
			$query->andWhere('sm.module = :module')->setParameter('module', $filter->module);

			$query->setParameter('role_id', 2);
			
			$query = $query->getQuery();
			
			$supplier_List = $query->getArrayResult();
			
			$suppliers = array();
			foreach($supplier_List as $suppliers_li){
				$suppliers_li['prfl_img'] =$suppliers_li['prfl_img']?$suppliers_li['prfl_img']:"noimage.png";
				$suppliers[] = $suppliers_li;
			}
			
			
			
			return array('result'=>'success','supplier_List' => $suppliers);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
	public function userSupplieradd($user_request)
	{
		try{
			
			$query = $this->entityManager->createQueryBuilder()->select('u')
			->from('App\Entities\User', 'u')			
			->Where('u.email=:email')->setParameter('email', $user_request->email);
			$query = $query->getQuery();
			$user_detail = $query->getArrayResult();
			if(count($user_detail)>0)
			return array('result'=>'fail','msg'=>'Email already Exists');
			
			
			$generated_key = sha1(mt_rand(10000,99999).time().$user_request->email);
			$auth_code = $this->getRandomNo(RANDOM_DIGIT_COUNT);
			$em = $this->entityManager;
			$objuser = new User();
			if(isset($user_request->business_name))
			$objuser->setBusinessName($user_request->business_name);
			$objuser->setEmail($user_request->email);
			if(isset($user_request->prfl_img)){
				$objuser->setPrflImg($user_request->prfl_img);
			}
			$objuser->setPassword(password_hash($user_request->password, PASSWORD_BCRYPT));
			$objuser->setRoleId($user_request->role);
			$objuser->setAuthKey($auth_code);
			$objuser->setContactnumber($user_request->contact_number);
			$objuser->setActivationKey($generated_key);
			$objuser->setStatus(0);
			$objuser->setIsDeleted(0);
			$objuser->setCreatedOn(new \DateTime("now"));
			$em->persist($objuser);  
			$em->flush();
			
			if($objuser->getId()){
				$supplier_id = $objuser->getId();
				foreach($user_request->module as $key=>$value){
					$em = $this->entityManager; 
					$supplier_module = new SuplierModule();
					$supplier_module->setSupplierId($supplier_id);
					$supplier_module->setModule($value->id);
					$supplier_module->setStatus('1');
					$em->persist($supplier_module);  
					$em->flush();
				}
			}	
			
			
			return array('result'=>'success','user_id' => $objuser->getId(),"activation_key"=>$generated_key);
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	
	public function userSupplierupdate($user_request)
	{
		try{
			$em = $this->entityManager;
			$objuser = $em->getRepository(User::class)->find($user_request->id);
				
			if(isset($user_request->business_name))
			$objuser->setBusinessName($user_request->business_name);
			if(isset($user_request->contact_number))
			$objuser->setContactnumber($user_request->contact_number);
			if(isset($user_request->email))
			$objuser->setEmail($user_request->email);
			if(isset($user_request->prfl_img))
			$objuser->setPrflImg($user_request->prfl_img);
			$objuser->setUpdatedOn(new \DateTime("now"));
			$em->merge($objuser);  
			$em->flush();
			return array('result'=>'success','user_id' => $objuser->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}

	
}
