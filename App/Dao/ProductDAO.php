<?php
namespace App\Dao;
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

use App\Entities;

use App\Entities\Products as Products;
use App\Entities\ProductCategory as ProductCategory;
use App\Entities\ProductFacility as ProductFacility;
use App\Entities\ProductPhotos as ProductPhotos;
use App\Entities\DropDownMaster as DropDownMaster;
use App\Entities\RoleMaster as RoleMaster;
use App\Entities\TagMaster as TagMaster;
use App\Entities\ProductTags as ProductTags;
use App\Entities\ProductTimeSlots as ProductTimeSlots;
use App\Entities\ProductBlockOutDates as ProductBlockOutDates;
use App\Entities\ProductCommunityGroup as ProductCommunityGroup;

use App\Resources\DbResource as DbResource;

/**
* Class ProductDAO
* @package App\Dao
* Dao class for ProductAdd
*/

class ProductDAO extends DbResource{
	
	
	/*ProductAdd
	09/07/2018 created by muthu
	*/
	
	public function productAdd($product_details){
		try{
			/*$query = $this->entityManager->createQueryBuilder()->select('p')
			->from('App\Entities\Products', 'p')			
			->Where('p.name=:name')->setParameter('name', $product_details->name);
			$query = $query->getQuery();
			
			$product = $query->getArrayResult();
			if(count($product)>0)
			return array('result'=>'fail','errorDescription'=>'Product name already exists');*/
			
			$em = $this->entityManager;
			$products = new Products();
			if(isset($product_details->name)){
				$products->setName($product_details->name);
			}
			if(isset($product_details->info)){
				$products->setInfo($product_details->info);
			}
			$products->setModule($product_details->module);
			if(isset($product_details->whattobring)){
				$products->setWhatToBring($product_details->whattobring);
			}
			if(isset($product_details->under_18_allowed)){
				$products->setUnder18Allowed($product_details->under_18_allowed);
			}
			if(isset($product_details->conditions)){
				$products->setConditions($product_details->conditions);
			}
			if(isset($product_details->fineprint)){
				$products->setFinePrint($product_details->fineprint);
			}
			if(isset($product_details->rules)){
				$products->setRules($product_details->rules);
			}
			if(isset($product_details->session_member)){
				$products->setSessionMember($product_details->session_member);
			}
			if(isset($product_details->min_people)){
				$products->setMinPeople($product_details->min_people);
			}
			if(isset($product_details->max_people)){
				$products->setMaxPeople($product_details->max_people);
			}
			if(isset($product_details->priceconfig)){
				$products->setPricingConfig($product_details->priceconfig);
			}
			if(isset($product_details->cost)){
				$products->setCost($product_details->cost);
			}
			
			if(isset($product_details->cost_type)){
				$products->setCostType($product_details->cost_type);
			}
			if(isset($product_details->duration_value)){
				$products->setDurationValue($product_details->duration_value);
			}
			if(isset($product_details->paper_and_ink)){
				$products->setPaperAndInk($product_details->paper_and_ink);
			}
			if(isset($product_details->size)){
				$products->setSize($product_details->size);
			}
			if(isset($product_details->artist)){
				$products->setArtist($product_details->artist);
			}
			if(isset($product_details->open_time)){
				$products->setOpenTime($product_details->open_time);
			}
			if(isset($product_details->copies_available)){
				$products->setCopiesAvailable($product_details->copies_available);
			}
			if(isset($product_details->close_time)){
				$products->setCloseTime($product_details->close_time);
			}
			if(isset($product_details->duration_type)){
				$products->setDurationType($product_details->duration_type);
			}
			if(isset($product_details->check_in)){
				$products->setCheckIn($product_details->check_in);
			}
			if(isset($product_details->check_out)){
				$products->setCheckOut($product_details->check_out);
			}
			
			if(isset($product_details->location)){
				$products->setLocation($product_details->location);
			}
			//$products->setLocation($product_details->location);
			
			$products->setLatitude($product_details->latitude);
			$products->setLongitude($product_details->longitude);
			$products->setSupplierId($product_details->supplier_id);
			$products->setCreatedBy(1);
			$products->setCreatedOn(new \DateTime("now"));
			$products->setStatus('-1');
			
			$em->persist($products);  
			
			$em->flush();
			
			if($products->getId()){
				$product_id = $products->getId();
				foreach($product_details->product_category as $key=>$value){
					$em = $this->entityManager;
					$product_category = new ProductCategory();
					$product_category->setProductId($product_id);
					$product_category->setCategoryId($value->id);
					$product_category->setStatus('1');
					$em->persist($product_category);  
					$em->flush();
				}
				foreach($product_details->product_image as $key=>$value){
					$em = $this->entityManager;
					$product_photo_update = $em->getRepository(ProductPhotos::class)->find($value);
					$product_photo_update->setProductId($product_id);
					$em->merge($product_photo_update);
					$em->flush();
				}	
			if($product_details->module != 'art'){	
				foreach($product_details->product_facility as $key=>$value){
					$em = $this->entityManager;
					$product_facility = new ProductFacility();
					$product_facility->setProductId($product_id);
					$product_facility->setFacilityId($value->id);
					$product_facility->setStatus('1');
					$em->persist($product_facility);  
					$em->flush();
				}
			}	
			
			if($product_details->module != 'farm_stay'){
				foreach($product_details->product_community as $key=>$value){
					$em = $this->entityManager;
					$product_community = new ProductCommunityGroup();
					$product_community->setProductId($product_id);
					$product_community->setCommunityGroupId($value->id);
					$product_community->setStatus('1');
					$em->persist($product_community);  
					$em->flush();
				}
			}	
			
			 if($product_details->module == 'indigenous_tour'){
			   if(isset($product_details->priceconfig)){
				if($product_details->priceconfig == 'hourly'){	
				foreach($product_details->timeslots as $key=>$value){
					$em = $this->entityManager;
					$product_time_slot = new ProductTimeSlots();
					$product_time_slot->setProductId($product_id);
					$product_time_slot->setTime($value->id);
					$product_time_slot->setStatus('1');
					$em->persist($product_time_slot);  
					$em->flush();
				}
			  }	
			  }
			 }			
			
			 if(isset($product_details->block_out_week)){
				foreach($product_details->block_out_week as $key=>$value){
					$em = $this->entityManager;
					$product_block_out_week = new ProductBlockOutDates();
					$product_block_out_week->setProductId($product_id);
					$product_block_out_week->setValue($value);
					$product_block_out_week->setType('day');
					$product_block_out_week->setStatus('1');
					$em->persist($product_block_out_week);  
					$em->flush();
				}
			 }
			
			if(isset($product_details->blockadddates)){
				foreach($product_details->blockadddates as $key=>$value){
					$em = $this->entityManager;
					$product_block_date = new ProductBlockOutDates();
					$product_block_date->setProductId($product_id);
					$product_block_date->setValue($value);
					$product_block_date->setType('date');
					$product_block_date->setStatus('1');
					$em->persist($product_block_date);  
					$em->flush();
				}
			 }	
				
			}
			return array('result'=>'success',"product_id"=>$products->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}	
		
	}
	
	/*ProductUpdate
	23/07/2018 created by muthu
	*/
	
	
	public function productUpdate($product_details){
		//echo "<pre>";print_r($product_details);exit;
		try{
			$em = $this->entityManager;
			$products = $em->getRepository(Products::class)->find($product_details->id);
			if(isset($product_details->name)){
				$products->setName($product_details->name);
			}
			if(isset($product_details->info)){
				$products->setInfo($product_details->name);
			}
			if(isset($product_details->whattobring)){
				$products->setWhatToBring($product_details->whattobring);
			}
			if(isset($product_details->under_18_allowed)){
				$products->setUnder18Allowed($product_details->under_18_allowed);
			}
			if(isset($product_details->conditions)){
				$products->setConditions($product_details->conditions);
			}
			if(isset($product_details->fineprint)){
				$products->setFinePrint($product_details->fineprint);
			}
			
			if(isset($product_details->session_member)){
				$products->setSessionMember($product_details->session_member);
			}
			if(isset($product_details->min_people)){
				$products->setMinPeople($product_details->min_people);
			}
			if(isset($product_details->max_people)){
				$products->setMaxPeople($product_details->max_people);
			}
			if(isset($product_details->priceconfig)){
				$products->setPricingConfig($product_details->priceconfig);
			}
			if(isset($product_details->cost)){
				$products->setCost($product_details->cost);
			}
			
			if(isset($product_details->cost_type)){
				$products->setCostType($product_details->cost_type);
			}
			if(isset($product_details->duration_value)){
				$products->setDurationValue($product_details->duration_value);
			}
			if(isset($product_details->paper_and_ink)){
				$products->setPaperAndInk($product_details->paper_and_ink);
			}
			if(isset($product_details->size)){
				$products->setSize($product_details->size);
			}
			if(isset($product_details->artist)){
				$products->setArtist($product_details->artist);
			}
			if(isset($product_details->open_time)){
				$products->setOpenTime($product_details->open_time);
			}
			if(isset($product_details->copies_available)){
				$products->setCopiesAvailable($product_details->copies_available);
			}
			if(isset($product_details->close_time)){
				$products->setCloseTime($product_details->close_time);
			}
			if(isset($product_details->duration_type)){
				$products->setDurationType($product_details->duration_type);
			}
			if(isset($product_details->check_in)){
				$products->setCheckIn($product_details->check_in);
			}
			if(isset($product_details->check_out)){
				$products->setCheckOut($product_details->check_out);
			}
			if(isset($product_details->check_in)){
				$products->setCheckIn($product_details->check_in);
			}
			if(isset($product_details->check_out)){
				$products->setCheckOut($product_details->check_out);
			}
			
			if(isset($product_details->location)){
				$products->setLocation($product_details->location);
			}
			
			
			
			$products->setLatitude($product_details->latitude);
			$products->setLongitude($product_details->longitude);
			$products->setUpdatedOn(new \DateTime("now"));
			$em->merge($products);  
			$em->flush();
			
			$product_id = $product_details->id;
			
			
			/*delete category start*/
			$entity_product=$em->getRepository('App\Entities\ProductCategory')->findBy(array('product_id'=>$product_id));
			foreach ($entity_product as $product) {
					$em->remove($product);
			}
			$em->flush();
			/*delete category end*/
			foreach($product_details->product_category as $key=>$value){
				$em = $this->entityManager;
				$product_category = new ProductCategory();
				$product_category->setProductId($product_id);
				$product_category->setCategoryId($value->id);
				$product_category->setStatus('1');
				$em->persist($product_category);  
				$em->flush();
			}
			foreach($product_details->product_image as $key=>$value){
				$em = $this->entityManager;
				$product_photo_update = $em->getRepository(ProductPhotos::class)->find($value);
				$product_photo_update->setProductId($product_id);
				$em->merge($product_photo_update);
				$em->flush();
			}	
			
			/*delete facility start*/
			$entity_facility=$em->getRepository('App\Entities\ProductFacility')->findBy(array('product_id'=>$product_id));
				foreach ($entity_facility as $product) {
					$em->remove($product);
				}
			$em->flush();
			/*delete facility end*/
			if($product_details->module != 'art'){	
				foreach($product_details->product_facility as $key=>$value){
					$em = $this->entityManager;
					$product_facility = new ProductFacility();
					$product_facility->setProductId($product_id);
					$product_facility->setFacilityId($value->id);
					$product_facility->setStatus('1');
					$em->persist($product_facility);  
					$em->flush();
				}
			}	
			
			/*delete community start*/
			$entity_community=$em->getRepository('App\Entities\ProductCommunityGroup')->findBy(array('product_id'=>$product_id));
			foreach ($entity_community as $product) {
					$em->remove($product);
			}
			$em->flush();
			/*delete community end*/
			
			if($product_details->module != 'farm_stay'){
				foreach($product_details->product_community as $key=>$value){
					$em = $this->entityManager;
					$product_community = new ProductCommunityGroup();
					$product_community->setProductId($product_id);
					$product_community->setCommunityGroupId($value->id);
					$product_community->setStatus('1');
					$em->persist($product_community);  
					$em->flush();
				}
			}	
			
			/*delete timeslots start*/
			$entity_timeslots=$em->getRepository('App\Entities\ProductTimeSlots')->findBy(array('product_id'=>$product_id));
			foreach ($entity_timeslots as $product) {
					$em->remove($product);
			}
			$em->flush();
			/*delete timeslots end*/
			
			
			if(isset($product_details->priceconfig)){
				
				if($product_details->priceconfig == 'hourly'){	
					foreach($product_details->timeslots as $key=>$value){
						$em = $this->entityManager;
						$product_time_slot = new ProductTimeSlots();
						$product_time_slot->setProductId($product_id);
						$product_time_slot->setTime($value->itemName);
						$product_time_slot->setStatus('1');
						$em->persist($product_time_slot);  
						$em->flush();
					}
				}	
			}	
			
			
			/*delete blockoutdate start*/
			$entity_blockoutdate=$em->getRepository('App\Entities\ProductBlockOutDates')->findBy(array('product_id'=>$product_id));
			foreach ($entity_blockoutdate as $product) {
					$em->remove($product);
			}
			$em->flush();
			/*delete blockoutdate end*/
			
			if(isset($product_details->priceconfig)){
				foreach($product_details->block_out_week as $key=>$value){
					$em = $this->entityManager;
					$product_block_out_week = new ProductBlockOutDates();
					$product_block_out_week->setProductId($product_id);
					$product_block_out_week->setValue($value);
					$product_block_out_week->setType('day');
					$product_block_out_week->setStatus('1');
					$em->persist($product_block_out_week);  
					$em->flush();
				}
			}		
			
			/*delete blockoutdate day*/
			$entity_blockoutday=$em->getRepository('App\Entities\ProductBlockOutDates')->findBy(array('product_id'=>$product_id));
			foreach ($entity_blockoutday as $product) {
					$em->remove($product);
			}
			$em->flush();
			/*delete blockoutdate end*/
			
		   if(isset($product_details->blockadddates)){	
			if(isset($product_details->priceconfig)){
				foreach($product_details->blockadddates as $key=>$value){
					$em = $this->entityManager;
					$product_block_out_day = new ProductBlockOutDates();
					$product_block_out_day->setProductId($product_id);
					$product_block_out_day->setValue($value);
					$product_block_out_day->setType('date');
					$product_block_out_day->setStatus('1');
					$em->persist($product_block_out_day);  
					$em->flush();
				}
			}
		  }	
			return array('result'=>'success');
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		
	}
	
	public function ProductStatusupdate($product_details){
		
		
		try{
			/*delete community start*/
			$em1 = $this->entityManager;
			$entity_community=$em1->getRepository('App\Entities\ProductCommunityGroup')->findBy(array('product_id'=>$product_details->id));
			foreach ($entity_community as $product) {
					$em1->remove($product);
			}
			$em1->flush();
			/*delete community end*/
			
				foreach($product_details->community_group as $key=>$value){
					$em = $this->entityManager;
					$community_group = new ProductCommunityGroup();
					$community_group->setProductId($product_details->id);
					$community_group->setCommunityGroupId($value->id);
					$community_group->setStatus('1');
					$em->persist($community_group);  
					$em->flush();
				}
			$em = $this->entityManager;
			$products = $em->getRepository(Products::class)->find($product_details->id);
			if(isset($product_details->status)){
				$products->setStatus($product_details->status);
			}
			$products->setUpdatedOn(new \DateTime("now"));
			$em->merge($products);  
			$em->flush();
			return array('result'=>'success');
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}	
		
	}
	
	/*ProductGet
	09/07/2018 created by muthu
	20-07-2018 updated by arun
	*/
	
	public function productGet($product_id){
		
		try{
			$query = $this->entityManager->createQueryBuilder()->select('p')
			->from('App\Entities\Products', 'p')			
			->Where('p.id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$product_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('b')
			->from('App\Entities\ProductBlockOutDates', 'b')			
			->Where('b.product_id=:product_id')->setParameter('product_id', $product_id)
			->AndWhere('b.type=:type')->setParameter('type', 'date');
			$query = $query->getQuery();
			$blockout_date = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('b')
			->from('App\Entities\ProductBlockOutDates', 'b')			
			->Where('b.product_id=:product_id')->setParameter('product_id', $product_id)
			->AndWhere('b.type=:type')->setParameter('type', 'day');
			$query = $query->getQuery();
			$blockout_day = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('b')
			->from('App\Entities\ProductPhotos', 'b')			
			->Where('b.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$photo_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('d.id','d.name as itemName','d.icon')
			->from('App\Entities\DropDownMaster', 'd')			
			->Join('App\Entities\ProductFacility', 'f', 'WITH', 'f.facility_id = d.id')
			->Where('f.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$facility_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('d.id','d.name as itemName','d.icon')
			->from('App\Entities\DropDownMaster', 'd')			
			->Join('App\Entities\ProductCategory', 'c', 'WITH', 'c.category_id = d.id')
			->Where('c.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$category_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('d.id','d.name as itemName','d.icon')
			->from('App\Entities\DropDownMaster', 'd')			
			->Join('App\Entities\ProductCommunityGroup', 'pcg', 'WITH', 'pcg.community_group_id = d.id')
			->Where('pcg.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$community_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('t')
			->from('App\Entities\TagMaster', 't')			
			->Join('App\Entities\ProductTags', 'pt', 'WITH', 'pt.tag_id = t.id')
			->Where('pt.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$tags_detail = $query->getArrayResult();
			
			$query = $this->entityManager->createQueryBuilder()->select('pts.id','pts.time as itemName')
			->from('App\Entities\ProductTimeSlots', 'pts')			
			->Where('pts.product_id=:product_id')->setParameter('product_id', $product_id);
			$query = $query->getQuery();
			$product_time_slot = $query->getArrayResult();
			
			
			
			return array('result'=>'sucess','product_detail' => $product_detail,'photo_detail'=>$photo_detail,'category_detail' => $category_detail,'facility_detail' => $facility_detail,'tags_detail' => $tags_detail ,'blockoutdates_date' => $blockout_date,'blockoutdates_day' => $blockout_day,'community_detail' => $community_detail,'product_time_slot'=>$product_time_slot);
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>'Invalid Link');
		}
	} 
	
	
	
	/*ProductView
	09/07/2018 created by muthu
	*/
	public function productList($product_list){
		
		try{

 		
			$query1 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm1.name)")
			->from('App\Entities\ProductCategory', 'pc1')		
			->leftJoin('App\Entities\DropDownMaster', 'dm1', 'WITH', 'dm1.id = pc1.category_id')
			->Where('pc1.product_id=p.id');
			$query1 = $query1->getDQL();
			
			$query2 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm.icon)")
			->from('App\Entities\ProductCategory', 'pc')		
			->leftJoin('App\Entities\DropDownMaster', 'dm', 'WITH', 'dm.id = pc.category_id')
			->Where('pc.product_id=p.id');
			$query2 = $query2->getDQL();
			
			
			
			 $query = $this->entityManager->createQueryBuilder()
			->select('p.id as product_id','p.name as Product_name','p.module','p.session_capacity','p.session_member','p.size','p.artist','p.min_people','p.under_18_allowed','pm.url as image_url')
			 ->addSelect('(' . $query1 . ') as icon')
			 ->addSelect('(' . $query2 . ') as icon_image')
			 ->from('App\Entities\Products', 'p')
			->leftJoin('App\Entities\ProductPhotos', 'pm', 'WITH', 'pm.product_id = p.id')
			->Where('p.supplier_id=:supplier_id')
			->addGroupBy('pm.product_id');

			if($product_list->module)
		    $query->AndWhere('p.module=:module')->setParameter('module', $product_list->module);			
			$query->setParameter('supplier_id', $product_list->supplier_id);	
			$query = $query->getQuery();
			
			$products_list = $query->getArrayResult();
			$products = array();
			foreach($products_list as $products_li){
				$products_li['image_url'] =$products_li['image_url']?$products_li['image_url']:"noimage.png";
				$products_li['icon_image'] = explode(",",$products_li['icon_image']);
				$products_li['icon'] = explode(",",$products_li['icon']);
				$products[] = $products_li;
			}
			return array('result'=>'success','products_list' => $products);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
	
	/*ProductView
	09/07/2018 created by muthu
	*/
	public function productListforCalendar($product_list){
		
		try{

 		
			$query1 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm1.name)")
			->from('App\Entities\ProductCategory', 'pc1')		
			->leftJoin('App\Entities\DropDownMaster', 'dm1', 'WITH', 'dm1.id = pc1.category_id')
			->Where('pc1.product_id=p.id');
			$query1 = $query1->getDQL();
			
			$query2 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm.icon)")
			->from('App\Entities\ProductCategory', 'pc')		
			->leftJoin('App\Entities\DropDownMaster', 'dm', 'WITH', 'dm.id = pc.category_id')
			->Where('pc.product_id=p.id');
			$query2 = $query2->getDQL();
			
			
			
			 $query = $this->entityManager->createQueryBuilder()
			->select('p.id as product_id','p.name as Product_name','p.module','p.session_capacity','p.session_member','p.size','p.artist','p.min_people','p.under_18_allowed','pm.url as image_url')
			 ->addSelect('(' . $query1 . ') as icon')
			 ->addSelect('(' . $query2 . ') as icon_image')
			 ->from('App\Entities\Products', 'p')
			->leftJoin('App\Entities\ProductPhotos', 'pm', 'WITH', 'pm.product_id = p.id')
			->Where('p.supplier_id=:supplier_id')
			->AndWhere('p.module!=:module')
			->addGroupBy('pm.product_id');

			if($product_list->module)
		    $query->AndWhere('p.module=:module')->setParameter('module', $product_list->module);			
			$query->setParameter('supplier_id', $product_list->supplier_id);
		    $query->setParameter('module', 'art');			
			$query = $query->getQuery();
			
			$products_list = $query->getArrayResult();
			$products = array();
			foreach($products_list as $products_li){
				$products_li['image_url'] =$products_li['image_url']?$products_li['image_url']:"noimage.png";
				$products_li['icon_image'] = explode(",",$products_li['icon_image']);
				$products_li['icon'] = explode(",",$products_li['icon']);
				$products[] = $products_li;
			}
			return array('result'=>'success','products_list' => $products);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
	/*ProductView
	09/07/2018 created by muthu
	*/
	public function productDashboard($product_list){
		
		try{

 		
			$query1 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm1.name)")
			->from('App\Entities\ProductCategory', 'pc1')		
			->leftJoin('App\Entities\DropDownMaster', 'dm1', 'WITH', 'dm1.id = pc1.category_id')
			->Where('pc1.product_id=p.id');
			$query1 = $query1->getDQL();
			
			$query2 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm.icon)")
			->from('App\Entities\ProductCategory', 'pc')		
			->leftJoin('App\Entities\DropDownMaster', 'dm', 'WITH', 'dm.id = pc.category_id')
			->Where('pc.product_id=p.id');
			$query2 = $query2->getDQL();
			
			
			 $query = $this->entityManager->createQueryBuilder()
			// $q = case when pm.url = null then c.name else pm.url end as image_url

			->select('p.id as product_id','p.name as Product_name','p.module','p.session_capacity','p.session_member','p.size','p.artist','p.min_people','p.under_18_allowed','pm.url  as image_url')
			 ->addSelect('(' . $query1 . ') as icon')
			 ->addSelect('(' . $query2 . ') as icon_image')
			 ->from('App\Entities\Products', 'p')
			->leftJoin('App\Entities\ProductPhotos', 'pm', 'WITH', 'pm.product_id = p.id')
			->Where('p.supplier_id=:supplier_id')
			->addGroupBy('pm.product_id')
			->addOrderBy('p.id', 'DESC')
			->setMaxResults(5);

			if($product_list->module)
		    $query->AndWhere('p.module=:module')->setParameter('module', $product_list->module);			
			$query->setParameter('supplier_id', $product_list->supplier_id);	
			$query = $query->getQuery();
			
			$products_list = $query->getArrayResult();
			$products = array();
			foreach($products_list as $products_li){
				$products_li['image_url'] =$products_li['image_url']?$products_li['image_url']:"noimage.png";
				$products_li['icon_image'] = explode(",",$products_li['icon_image']);
				$products_li['icon'] = explode(",",$products_li['icon']);
				$products[] = $products_li;
			}
			return array('result'=>'success','products_list' => $products);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
	
	public function produceImagedelete($id)
	{
		try
		{
			$em = $this->entityManager;
			$user_exist = $em->getRepository(ProductPhotos::class)->findOneBy(['id' => $id]);

			if(!empty($user_exist))
			{
				$em->remove($user_exist);
				$em->flush();
			}
			return array('result'=>'success' ,'message'=>'Product Photo Removed successfully');
		}
		catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
		return array('result'=>1);
	}
	
	public function productApproval(){
		
		
		try{

		
 			$query1 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm.name)")
			->from('App\Entities\ProductCategory', 'pc')		
			->leftJoin('App\Entities\DropDownMaster', 'dm', 'WITH', 'dm.id = pc.category_id')
			->Where('pc.product_id=p.id');
			$query1 = $query1->getDQL();
			
			$query2 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm1.icon)")
			->from('App\Entities\ProductCategory', 'pc1')		
			->leftJoin('App\Entities\DropDownMaster', 'dm1', 'WITH', 'dm1.id = pc1.category_id')
			->Where('pc1.product_id=p.id');
			$query2 = $query2->getDQL();
			
			$query3 = $this->entityManager->createQueryBuilder()
			->select("groupconcat(dm2.name)")
			->from('App\Entities\ProductCommunityGroup', 'pcg')		
			->leftJoin('App\Entities\DropDownMaster', 'dm2', 'WITH', 'dm2.id = pcg.community_group_id')
			->Where('pcg.product_id=p.id');
			$query3 = $query3->getDQL();
			
			 $query = $this->entityManager->createQueryBuilder()
			 //->select('p.name as Product_name','p.session_capacity','p.min_people','p.under_18_allowed','dm.name','pm.url')
			 ->select('p.name as Product_name','p.id','p.info','pm.url as image_url')
			 ->addSelect('(' . $query1 . ') as icon')
			 ->addSelect('(' . $query2 . ') as icon_image')
			  ->addSelect('(' . $query3 . ') as community')
			 ->from('App\Entities\Products', 'p')
			->leftJoin('App\Entities\ProductPhotos', 'pm', 'WITH', 'pm.product_id = p.id')
			->Where('p.status=:status')->setParameter('status', '-1')
			->addGroupBy('pm.product_id')
			->addOrderBy('p.id', 'DESC')
			->setMaxResults(5);

			
			$query = $query->getQuery();
			
			$products_list = $query->getArrayResult();
			$products = array();
			foreach($products_list as $products_li){
				$products_li['image_url'] =$products_li['image_url']?$products_li['image_url']:"noimage.png";
				$products_li['icon_image'] = explode(",",$products_li['icon_image']);
				$products_li['icon'] = explode(",",$products_li['icon']);
				$products_li['community'] = explode(",",$products_li['community']);
				$products[] = $products_li;
			}
			return array('result'=>'success','products_list' => $products);
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>$e->getMessage());
		}
	}
	
	/*Product image add
	19/07/2018 created by arun
	*/
	
	public function productImage($image_url){
		
		try{
			 $em = $this->entityManager;
					$product_photos = new ProductPhotos();
					$product_photos->setProductId(0);
					$product_photos->setUrl($image_url);
					$product_photos->setStatus('1');
					$em->persist($product_photos);  
					$em->flush();
			return array('result'=>'sucess','image_id' => $product_photos->getId());
			
		}catch(Exception $e) {
			return array('result'=>'fail','errorDescription'=>'Invalid Link');
		}
	
	}
	
}
