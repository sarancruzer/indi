<?php
namespace App\Dao;

use App\Entities;
use App\Resources\DbResource as DbResource;

use App\Entities\SupplierReviews as SupplierReviews;
/**
* Class SupplierReviewsDAO
* @package App\Dao
*
* Create By : Arun.M
*/

class SupplierReviewsDAO extends DbResource
{
	
	/**
	 * To get SupplierReviews List
	 * @return mixed
	 */
	public function SupplierReviewsList($filter)
	{
		

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p')
			->from('App\Entities\SupplierReviews', 'p');
			
			if(isset($filter->supplier_id))
			$query->andWhere('p.supplier_id =:supplier_id')->setParameter('supplier_id', $filter->supplier_id);
			$query->andWhere('p.status=:status')->setParameter('status', STATUS_ACTIVE);

			$query = $query->getQuery();
			
			$supplier_reviews_list = $query->getArrayResult();
			return array('result'=>'success','supplier_reviews_list' => $supplier_reviews_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}

	
	
	
	/**
	* To add supplier_Reviews
	**/
	public function SupplierReviewsSave($supplier_reviews_request)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('p')
			->from('App\Entities\Suppliers', 'p')			
			->Where('p.id=:supplier_id')->setParameter('supplier_id', $supplier_reviews_request->supplier_id);
			$query = $query->getQuery();
			
			$supplier_Reviews_detail = $query->getArrayResult();
			if(count($supplier_Reviews_detail)==0)
			return array('result'=>'fail','errorDescription'=>'Invalid Supplier');
			
		
			$em = $this->entityManager;
			$objsupplier_Reviews = new supplierReviews();
			$objsupplier_Reviews->setsupplierId($supplier_reviews_request->supplier_id);
			$objsupplier_Reviews->setTitle($supplier_reviews_request->title);
			$objsupplier_Reviews->setDescription($supplier_reviews_request->description);
			$objsupplier_Reviews->setRating($supplier_reviews_request->rating);
			$objsupplier_Reviews->setRatedBy(($supplier_reviews_request->logged_user_id));
			$objsupplier_Reviews->setRatedOn(new \DateTime("now"));
			$objsupplier_Reviews->setStatus(STATUS_ACTIVE);
			$em->persist($objsupplier_Reviews);  
			$em->flush();
			return array('result'=>'success','supplier_reviews_id' => $objsupplier_Reviews->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	

	/**
	* To delete supplier_Reviews
	**/
	public function SupplierReviewsDelete($supplier_Reviewss_request)
	{
		try
		{
			$em = $this->entityManager;
			$supplier_Reviews_exist = $em->getRepository(SupplierReviews::class)->findOneBy(['id' => $supplier_reviews_request->id]);

			if(!empty($supplier_Reviews_exist))
			{
				$em->remove($supplier_Reviews_exist);
				$em->flush();
			}
			return array('result'=>'success' ,'message'=>'SupplierReviews Removed successfully');
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
	
}
