<?php
namespace App\Services;

use App\Dao\FacilityDAO as FacilityDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;


/**
* Class FacilityAdd
* @package App\Services
* Service class for ProductAdd
*/
class FacilityService
{
		
		
		/*FacilityAdd
		06/07/2018 created by muthu
		*/
		
		public function FacilityAdd($category_details){
			$err_msg=[];
			if(trim(isset($category_details->name)?$category_details->name:'')=='')
			$err_msg[]='Facility name is required';
			if(trim(isset($category_details->description)?$category_details->description:'')=='')
			$err_msg[]='Description is required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$facility_dao = new FacilityDAO();
				$facility      = $facility_dao->facilityAdd($category_details);
				if(!empty($facility)){
				return $response->encode_response(['status' => 'success', 'data' => $facility]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}
			}
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
		}	
		
		/*facilityList
		16/07/2018 created by muthu
		*/
		
		public function facilityList(){
			$facility_list = array();
			$dao_request = new FacilityDAO();
			$facility_list = $dao_request->facilityList();
			$response = new ResponseHandler();
			if(count($facility_list)>0){
				return $response->encode_response(['status' => 'success', 'facility_list' => $facility_list]);
			}else{
				return $response->encode_response(['status' => 'failure', 'facility_list' => '','message' => 'Invalid details']);
			}
		}
		
}
