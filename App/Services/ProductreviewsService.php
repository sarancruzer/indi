<?php
namespace App\Services;

use App\Request\RequestHandler as RequestHandler;
use App\Response\ResponseHandler as ResponseHandler;

use App\Dao\ProductReviewsDAO as ProductReviewsDAO;

/**
* Class ProductReviewsService
* @package App\Services
*  Service class for user detail
*/
class ProductreviewsService
{
	/**
	* @to fetch the available Product Reviews list.
	* @output mixed
	**/
	public function productreviewsList($filter)
	{
		$err_msg=[];
		if(trim(isset($filter->product_id)?$filter->product_id:'')=='')
		$err_msg[]='Product is required';
		$user_list_response = array();
		$dao_request = new ProductReviewsDAO();
		$user_list_response = $dao_request->ProductReviewsList($filter);
		// call to dao to validate the user details
$response = new ResponseHandler();
		
	if(empty($err_msg))
	{	if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'product_reviews' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'product_reviews' => '','message' => 'Invalid details']);
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
	
	public function productreviewsSave($arrPost)
	{
		$err_msg=[];
		if(trim(isset($arrPost->product_id)?$arrPost->product_id:'')=='')
		$err_msg[]='Product is required';
		if(trim(isset($arrPost->title)?$arrPost->title:'')=='')
		$err_msg[]='Title is required';
		if(trim(isset($arrPost->description)?$arrPost->description:'')=='')
		$err_msg[]='Description is required';
		if(trim(isset($arrPost->rating)?$arrPost->rating:'')=='')
		$err_msg[]='Rating is required';
		if(trim(isset($arrPost->logged_user_id)?$arrPost->logged_user_id:'')=='')
		$err_msg[]='logged_user_id is required';
		$response = new ResponseHandler();
		if(empty($err_msg))
		{
			$user_dao = new ProductReviewsDAO();
			//echo '<pre>';print_r($arrPost);die;
			$resUser = $user_dao->ProductReviewsSave($arrPost);
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
	* To delete ProductReviews
	* @input array
	* @output json response
	**/
	public function productreviewsDelete($request)
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
