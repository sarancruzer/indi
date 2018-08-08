<?php
namespace App\Dao;

use App\Entities;

use App\Entities\DropDownMaster as DropDownMaster;
use App\Resources\DbResource as DbResource;

/**
* Class CategoryDAO
* @package App\Dao
* Dao class for CategoryAdd
*/

class FacilityDAO extends DbResource{
	
	
	/*FacilityAdd
	06/07/2018 created by muthu
	*/
	
	public function facilityAdd($facility_details)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('dm')
			->from('App\Entities\DropDownMaster', 'dm')			
			->Where('dm.name=:name')->setParameter('name', $facility_details->name)
			->AndWhere('dm.type=:type')->setParameter('type', 'facility');
			
			$query = $query->getQuery();
			
			$facility = $query->getArrayResult();
			if(count($facility)>0)
			return array('result'=>'fail','errorDescription'=>'Facility name already exists');
			
			$em = $this->entityManager;
			$Master = new DropDownMaster();
			$Master->setName($facility_details->name);
			$Master->setDescription($facility_details->description);
			$Master->setStatus('1');
			$Master->setType('facility');
			$em->persist($Master);  
			$em->flush();
			
			return array('result'=>'success');
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	
	/*categoryList
	16/07/2018 created by muthu
	*/
	
	public function facilityList(){
		
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('dm.id','dm.name as itemName','dm.icon')
			->from('App\Entities\DropDownMaster', 'dm')
			->Where('dm.type=:type')->setParameter('type', 'facility');
			
			$query = $query->getQuery();
			
			$facility_list = $query->getArrayResult();
			return array('result'=>'success','data' => $facility_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
}
