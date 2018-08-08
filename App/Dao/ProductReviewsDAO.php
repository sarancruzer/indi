<?php
namespace App\Dao;

use App\Entities;
use App\Resources\DbResource as DbResource;

use App\Entities\ProductReviews as ProductReviews;
/**
* Class ProductReviewsDAO
* @package App\Dao
*
* Create By : Arun.M
*/

class ProductReviewsDAO extends DbResource
{
	
	/**
	 * To get ProductReviews List
	 * @return mixed
	 */
	public function ProductReviewsList($filter)
	{
		

		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p')
			->from('App\Entities\ProductReviews', 'p');
			
			if(isset($filter->product_id))
			$query->andWhere('p.product_id =:product_id')->setParameter('product_id', $filter->product_id);
			$query->andWhere('p.status=:status')->setParameter('status', STATUS_ACTIVE);

			$query = $query->getQuery();
			
			$product_reviews_list = $query->getArrayResult();
			return array('result'=>'success','product_reviews_list' => $product_reviews_list);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}

	
	
	
	/**
	* To add product_Reviews
	**/
	public function ProductReviewsSave($product_reviews_request)
	{
		try{
			$query = $this->entityManager->createQueryBuilder()->select('p')
			->from('App\Entities\Products', 'p')			
			->Where('p.id=:product_id')->setParameter('product_id', $product_reviews_request->product_id);
			$query = $query->getQuery();
			
			$product_Reviews_detail = $query->getArrayResult();
			if(count($product_Reviews_detail)==0)
			return array('result'=>'fail','errorDescription'=>'Invalid Product');
			
		
			$em = $this->entityManager;
			$objproduct_Reviews = new ProductReviews();
			$objproduct_Reviews->setProductId($product_reviews_request->product_id);
			$objproduct_Reviews->setTitle($product_reviews_request->title);
			$objproduct_Reviews->setDescription($product_reviews_request->description);
			$objproduct_Reviews->setRating($product_reviews_request->rating);
			$objproduct_Reviews->setRatedBy(($product_reviews_request->logged_user_id));
			$objproduct_Reviews->setRatedOn(new \DateTime("now"));
			$objproduct_Reviews->setStatus(STATUS_ACTIVE);
			$em->persist($objproduct_Reviews);  
			$em->flush();
			return array('result'=>'success','product_reviews_id' => $objproduct_Reviews->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	

	/**
	* To delete product_Reviews
	**/
	public function ProductReviewsDelete($product_Reviewss_request)
	{
		try
		{
			$em = $this->entityManager;
			$product_Reviews_exist = $em->getRepository(ProductReviews::class)->findOneBy(['id' => $product_reviews_request->id]);

			if(!empty($product_Reviews_exist))
			{
				$em->remove($product_Reviews_exist);
				$em->flush();
			}
			return array('result'=>'success' ,'message'=>'ProductReviews Removed successfully');
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
	
}
