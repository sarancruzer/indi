<?php
namespace App\Dao;

ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

use App\Entities;

use App\Entities\IndigenousToken as IndigenousToken;
use App\Resources\DbResource as DbResource;


class AuthDAO extends DbResource{
	
	
	/*FacilityAdd
	06/07/2018 created by muthu
	*/
	
	public function getToken($username,$password)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('u')
			->from('App\Entities\IndigenousToken','u')			
			->Where('u.username=:username')->setParameter('username', $username)
			->AndWhere('u.password=:password')->setParameter('password', $password);
			
			$query = $query->getQuery();
			
			$token = $query->getArrayResult();
			
			return array('result'=>$token);
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	
}
