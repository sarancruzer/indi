<?php
namespace App\Dao;

use App\Entities;

use App\Entities\DropDownMaster as DropDownMaster;
use App\Resources\DbResource as DbResource;

/**
* Class CommunityDAO
* @package App\Dao
* Dao class for CommunityAdd
*/

class CommunityDAO extends DbResource{
	
	
	/*CommunityAdd
	06/07/2018 created by muthu
	*/
	
	public function communityAdd($community_details)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('dm')
			->from('App\Entities\DropDownMaster', 'dm')			
			->Where('dm.name=:name')->setParameter('name', $community_details->name)
			->AndWhere('dm.type=:type')->setParameter('type', 'community');
			
			$query = $query->getQuery();
			
			$community = $query->getArrayResult();
			if(count($community)>0)
			return array('result'=>'fail','errorDescription'=>'Community name already exists');
			
			$em = $this->entityManager;
			$Master = new DropDownMaster();
			$Master->setName($community_details->name);
			$Master->setDescription($community_details->description);
			$Master->setStatus('1');
			$Master->setType('community');
			$em->persist($Master);  
			$em->flush();
			
			return array('result'=>'success');
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	
	/*communityList
	16/07/2018 created by muthu
	*/
	
	public function communityList(){
		
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('dm.id','dm.name as itemName','dm.icon')
			->from('App\Entities\DropDownMaster', 'dm')
			->Where('dm.type=:type')->setParameter('type', 'community');
			
			$query = $query->getQuery();
			
			$community = $query->getArrayResult();
			return array('result'=>'success','data' => $community);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
}
