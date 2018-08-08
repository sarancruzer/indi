<?php
namespace App\Services;
error_reporting(E_ALL); ini_set("display_errors", 1); 
use App\Request\RequestHandler as RequestHandler;
use App\Response\ResponseHandler as ResponseHandler;
use App\Dao\BlockoutDatesDAO as BlockoutDatesDAO;

/**
* Class ProductReviewsService
* @package App\Services
*  Service class for user detail
*/
class BlockoutdatesService
{
	/**
	* @to fetch the available list.
	* @output mixed
	**/
	public function blockoutdatesList($filter)
	{
		
		$err_msg=[];
		if(trim(isset($filter->product_id)?$filter->product_id:'')=='')
		$err_msg[]='Product is required';
		$user_list_response = array();
		$dao_request = new BlockoutDatesDAO();
		$user_list_response = $dao_request->BlockoutDatesList($filter);
		// call to dao to validate the user details
$response = new ResponseHandler();
		
	if(empty($err_msg))
	{	if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'blockout_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'blockout_details' => '','message' => 'Invalid details']);
		}
	}
	else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	      
	/**
	* @to fetch the available list.
	* @output mixed
	**/
	public function blockoutdatessupplierList($filter)
	{
		$err_msg=[]; 
		if(trim(isset($filter->supplier_id)?$filter->supplier_id:'')=='')
		$err_msg[]='Supplier ID is required';
		$user_list_response = array();
		$dao_request = new BlockoutDatesDAO();
		$user_list_response = $dao_request->SupplierBlockoutDatesList($filter);
		// call to dao to validate the user details
$response = new ResponseHandler();
		
	if(empty($err_msg))
	{	if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'blockout_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'blockout_details' => '','message' => 'Invalid details']);
		}
	}
	else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	
	/**
	* @to fetch the available list.
	* @output mixed
	**/
	public function blockoutdatesSupplier($filter)
	{
		$err_msg=[]; 
		if(trim(isset($filter->supplier_id)?$filter->supplier_id:'')=='')
		$err_msg[]='Supplier ID is required';
		$user_list_response = array();
		$dao_request = new BlockoutDatesDAO();
		$user_list_response = $dao_request->SupplierBlockoutDates($filter);
		// call to dao to validate the user details
$response = new ResponseHandler();
		
	if(empty($err_msg))
	{	if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success', 'blockout_details' => $user_list_response,'message' => '']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'blockout_details' => '','message' => 'Invalid details']);
		}
	}
	else
		return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
	}
	 
	public function blockoutdatesSupplieradd($category_details){
		 	  $err_msg=[];
			if(trim(isset($category_details->supplier_id)?$category_details->supplier_id:'')=='')
			$err_msg[]='Supplier ID is required';
			if(trim(isset($category_details->type)?$category_details->type:'')=='')
			$err_msg[]='Type is required';
			if(trim(isset($category_details->value)?$category_details->value:'')=='')
			$err_msg[]='Value is required'; 
			$response = new ResponseHandler();
			 if(empty($err_msg)){
				$category_dao = new BlockoutDatesDAO();
				$category      = $category_dao->BlockoutDatesSupplierAdd($category_details);
				if(!empty($category)){
				return $response->encode_response(['status' => 'success', 'data' => $category]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}  
			} 
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
		}	
		
		/**
	* To delete user
	* @input array
	* @output json response
	**/
	public function blockoutdatesSupplierdelete($request)
	{
		$response = new ResponseHandler();
		// echo $request->supplier_id;
		 $err_msg=[];
			if(trim(isset($request->supplier_id)?$request->supplier_id:'')=='')
			$err_msg[]='Supplier ID is required';
			if(trim(isset($request->type)?$request->type:'')=='')
			$err_msg[]='Type is required';
			if(trim(isset($request->value)?$request->value:'')=='')
			$err_msg[]='Value is required'; 
			$response = new ResponseHandler();
			 if(empty($err_msg)){
				$user_list_response = array();
				$category_dao = new BlockoutDatesDAO();
				$user_list_response      = $category_dao->BlockoutDatesSupplierDelete($request);
						
				
				
				 
				if(count($user_list_response)>0){
					// success call
					return $response->encode_response(['status' => 'success','result' => $user_list_response ]);
				}else{
					// invalid user
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid details']);
				}
			} 
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
		}		
}
