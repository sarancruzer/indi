<?php
namespace App\Services;

use App\Request\RequestHandler as RequestHandler;
use App\Response\ResponseHandler as ResponseHandler;

use App\Dao\ProductTagsDAO as ProductTagsDAO;

/**
* Class ProductTagsService
* @package App\Services
*  Service class for user detail
*/
class ProducttagsService
{
	/**
	* @to fetch the available Product Reviews list.
	* @output mixed
	**/
	public function producttagsList($filter)
	{
		$err_msg=[];
		if(trim(isset($filter->product_id)?$filter->product_id:'')=='')
		$err_msg[]='Product is required';
		$user_list_response = array();
		$dao_request = new ProductTagsDAO();
		$user_list_response = $dao_request->ProductTagsList($filter);
		// call to dao to validate the user details
$response = new ResponseHandler();
		
	if(empty($err_msg))
	{	if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'product_tags' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'product_tags' => '','message' => 'Invalid details']);
		}
	}
	else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	/**
	* To add Product Reviews for the product
	* @input array
	* @output json response
	**/
	
	public function ProductTagsSave($arrPost)
	{
		$err_msg=[];
		if(trim(isset($arrPost->product_id)?$arrPost->product_id:'')=='')
		$err_msg[]='Product is required';
		if(trim(isset($arrPost->tag_id)?$arrPost->tag_id:'')=='')
		$err_msg[]='Tag is required';
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new ProductTagsDAO();
			//echo '<pre>';print_r($arrPost);die;
			$resUser = $user_dao->ProductTagsSave($arrPost);
			// print_r($resUser);die;
			if(!empty($resUser)){
				// success call
				return $response->encode_response(['status' => 'success', 'data' => $resUser]);
			}else{
				// invalid 
				return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	
	/**
	* To update user
	* @input array
	* @output json response
	**/
	
	public function producttagsUpdate($arrPost)
	{
		$err_msg=[];
		
		if(trim(isset($arrPost->id)?$arrPost->id:'')=='')
		$err_msg[]='ID is required';
		// if(trim(isset($arrPost->tag_id)?$arrPost->tag_id:'')=='')
		// $err_msg[]='Tag ID is required';
		
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new ProductTagsDAO();
			// echo '<pre>';print_r($arrPost);die;
			$resUser = $user_dao->ProductTagsUpdate($arrPost);
			// print_r($resUser);die;
			if(!empty($resUser)){
				// success call
				return $response->encode_response(['status' => 'success', 'data' => $resUser]);
			}else{
				// invalid 
				return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
			}
		}
		else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	
	
	/**
	* To delete ProductTags
	* @input array
	* @output json response
	**/
	public function ProductTagsDelete($request)
	{
		$response = new ResponseHandler();
		if(!isset($request->id)){
			// success call
			return $response->encode_response(['status' => 'failure','message' => 'ID Required']);
		}
		
		$user_list_response = array();
		$dao_request = new UserDAO();
		$user_list_response = $dao_request->userDelete($request);
		// call to dao to validate the user details

		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'message' => 'Product Review removed successfully']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'message' => 'Invalid details']);
		}
	}	
	
}
