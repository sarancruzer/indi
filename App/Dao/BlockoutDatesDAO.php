<?php
namespace App\Dao;
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);
use App\Entities;
use App\Resources\DbResource as DbResource;

use App\Entities\ProductBlockOutDates as ProductBlockOutDates;
use App\Entities\SupplierBlockOutDates as SupplierBlockOutDates;
/**  
* Class BlockoutDatesDAO
* @package App\Dao
*
* Create By : Arun.M
*/ 

class BlockoutDatesDAO extends DbResource
{
	
	/**
	 * To get BlockoutDates List
	 * @return mixed
	 */
	public function BlockoutDatesList($filter)
	{
		

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p.type as title','p.value as start')
			->from('App\Entities\ProductBlockOutDates', 'p');
			
			if(isset($filter->product_id))
			$query->andWhere('p.product_id =:product_id')->setParameter('product_id', $filter->product_id);
			$query->andWhere('p.status=:status')->setParameter('status', STATUS_ACTIVE);
 
			$query = $query->getQuery();
			 
			$blockout_date_list = $query->getArrayResult();
			
			return array('result'=>'success','blockout_date_list' => $blockout_date_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
function dateRange($begin, $end, $interval = null)
{
    $begin = new \DateTime($begin);
    $end = new \DateTime($end);
     $end = $end->modify('+1 day');
    $interval = new \DateInterval($interval ? $interval : 'P1D');

    return iterator_to_array(new \DatePeriod($begin, $interval, $end));
}

	/**
	 * To get SupplierBlockoutDatesList List
	 * @return mixed
	 */
	public function SupplierBlockoutDatesList($filter)
	{
		 

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p.type as title','p.value as start')
			->from('App\Entities\ProductBlockOutDates', 'p')
			->join('App\Entities\Products', 'pr')->distinct('p.value','p.type');
			
			if(isset($filter->supplier_id))
			$query->andWhere('pr.supplier_id =:supplier_id')->setParameter('supplier_id', $filter->supplier_id);
			$query->andWhere('p.status=:status')->setParameter('status', STATUS_ACTIVE);

			$query = $query->getQuery();
			
			$blockout_date_list = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()
			->select('p.type as title','p.value as start','p.to_value as end_date')
			->from('App\Entities\SupplierBlockOutDates', 'p');
			  
			$query->Where('p.status=:status')->setParameter('status', STATUS_ACTIVE);
			if(isset($filter->supplier_id))
			$query->andWhere('p.supplier_id =:supplier_id')->setParameter('supplier_id', $filter->supplier_id);
			
			$query = $query->getQuery();  
			
			$supplier_blockout_date_list = $query->getArrayResult();
			 
			
			return array('result'=>'success','blockout_date_list' => $blockout_date_list,'supplier_blockout_date_list'=>$supplier_blockout_date_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
 
	/**
	 * To get SupplierBlockoutDates List
	 * @return mixed
	 */
	public function SupplierBlockoutDates($filter)
	{
		 

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p.type','p.value','p.to_value')
			->from('App\Entities\SupplierBlockOutDates', 'p')
			 ->distinct('p.value','p.type');
			
			$query->Where('p.status=:status')->setParameter('status', STATUS_ACTIVE);
			if(isset($filter->supplier_id))
			$query->andWhere('p.supplier_id =:supplier_id')->setParameter('supplier_id', $filter->supplier_id);
			
			$query = $query->getQuery();
			
			$blockout_date_list = $query->getArrayResult();
			
			
			return array('result'=>'success','blockout_date_list' => $blockout_date_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}

	
	public function blockoutdatesSupplieradd($category_details)
	{
		try{
						
			$em = $this->entityManager;
			$Master = new SupplierBlockOutDates();
			$Master->setSupplierId($category_details->supplier_id);
			$Master->setType($category_details->type);
			$Master->setValue($category_details->value);
			if(isset($category_details->to_value)) 
			$Master->setToValue($category_details->to_value);
			$Master->setStatus('1');
			$em->persist($Master);  
			$em->flush();
			  
			return array('result'=>'success');
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}  
	public function BlockoutDatesSupplierDelete($filter)
	{
		try 
		{	
			$query = $this->entityManager->createQueryBuilder()
			->select('p')
			->from('App\Entities\SupplierBlockOutDates', 'p')
			->Where('p.type=:type')->setParameter('type', $filter->type)
			->andWhere('p.supplier_id =:supplier_id')->setParameter('supplier_id', $filter->supplier_id)
			->andWhere('p.value =:value')->setParameter('value', $filter->value);
			
			$query = $query->getQuery();
			
			$blockout_date_list = $query->getArrayResult();
			$em = $this->entityManager;
			$objuser = $em->getRepository(SupplierBlockOutDates::class)->find($blockout_date_list[0]['id']);
			
			if(!empty($objuser))
			{
				$em->remove($objuser);
				$em->flush();
			}
			return array('result'=>'success','message' => "User deleted successfully");
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
}
