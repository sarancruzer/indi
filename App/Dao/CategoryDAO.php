<?php
namespace App\Dao;
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

use App\Entities;

use App\Entities\DropDownMaster as DropDownMaster;
use App\Resources\DbResource as DbResource;

/**
* Class CategoryDAO
* @package App\Dao
* Dao class for CategoryAdd
*/

class CategoryDAO extends DbResource{
	
	
	/*CategoryAdd
	06/07/2018 created by muthu
	*/
	
	public function categoryAdd($category_details)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('dm')
			->from('App\Entities\DropDownMaster', 'dm')			
			->Where('dm.name=:name')->setParameter('name', $category_details->name)
			->AndWhere('dm.type=:type')->setParameter('type', 'category');
			
			$query = $query->getQuery();
			
			$category = $query->getArrayResult();
			if(count($category)>0)
			return array('result'=>'fail','errorDescription'=>'Category name already exists');
			
			$em = $this->entityManager;
			$Master = new DropDownMaster();
			$Master->setName($category_details->name);
			$Master->setDescription($category_details->description);
			$Master->setIcon($category_details->icon);
			$Master->setStatus('1');
			$Master->setType('category');
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
	
	public function categoryList($category){
		
	//	$module = $category->module;
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('dm.id','dm.name as itemName','dm.icon','dm.module')
			->from('App\Entities\DropDownMaster', 'dm')
		    ->Where('dm.module=:module')->setParameter('module', $category->module)
			->andWhere('dm.type=:type')->setParameter('type', 'category');
			
			$query = $query->getQuery();
			
			$category_list = $query->getArrayResult();
			return array('result'=>'success','data' => $category_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
}
