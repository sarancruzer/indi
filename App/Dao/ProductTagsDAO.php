<?php
namespace App\Dao;

use App\Entities;
use App\Resources\DbResource as DbResource;

use App\Entities\ProductTags as ProductTags;
/**
* Class ProductTagsDAO
* @package App\Dao
*
* Create By : Arun.M
*/

class ProductTagsDAO extends DbResource
{
	
	/**
	 * To get ProductTags List
	 * @return mixed
	 */
	public function ProductTagsList($filter)
	{
		
   
		try{
 			$query = $this->entityManager->createQueryBuilder()
			->select('p.id','tm.name', 'tm.description', 'tm.image_path', 'tm.contact_number', 'tm.email')
			->from('App\Entities\ProductTags', 'p')
			->leftJoin('App\Entities\TagMaster', 'tm', 'WITH', 'tm.id = p.tag_id');
			 
			if(isset($filter->product_id))
			$query->andWhere('p.product_id =:product_id')->setParameter('product_id', $filter->product_id);
			if(isset($filter->status))
			$query->andWhere('p.status=:status')->setParameter('status', $filter->status);
			else
			$query->andWhere('p.status=:status')->setParameter('status', STATUS_ACTIVE);

			$query = $query->getQuery();
			
			$product_reviews_list = $query->getArrayResult();
			return array('result'=>'success','product_tags_list' => $product_reviews_list);
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
 
	
	
	
	/**
	* To add product_Reviews
	**/
	public function ProductTagsSave($product_reviews_request)
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
			$objproduct_Reviews = new ProductTags();
			$objproduct_Reviews->setProductId($product_reviews_request->product_id);
			$objproduct_Reviews->setTagId($product_reviews_request->tag_id);
			$objproduct_Reviews->setStatus('0');
			$em->persist($objproduct_Reviews);  
			$em->flush();
			return array('result'=>'success','product_reviews_id' => $objproduct_Reviews->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	/**
	* To update producttags
	**/
	public function ProductTagsUpdate($user_request)
	{
		try{
			
			$em = $this->entityManager;
			$objuser = $em->getRepository(ProductTags::class)->find($user_request->id);
			if(!$objuser)
			return array('result'=>'fail','errorDescription'=>'Invalid ID');	
			$objuser->setStatus($user_request->status);
			$em->merge($objuser);  
			$em->flush();
			return array('result'=>'success','message' => "status updated successfully");
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}			
	}
	

	/**
	* To delete product_Reviews
	**/
	public function ProductTagsDelete($product_Reviewss_request)
	{
		try
		{
			$em = $this->entityManager;
			$product_Reviews_exist = $em->getRepository(ProductTags::class)->findOneBy(['id' => $product_reviews_request->id]);

			if(!empty($product_Reviews_exist))
			{
				$em->remove($product_Reviews_exist);
				$em->flush();
			}
			return array('result'=>'success' ,'message'=>'ProductTags Removed successfully');
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
	
}
