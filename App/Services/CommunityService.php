<?php
namespace App\Services;

use App\Dao\CommunityDAO as CommunityDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;


/**
* Class CommunityAdd
* @package App\Services
* Service class for CommunityAdd
*/
class CommunityService
{
		
		
		/*CommunityAdd
		06/07/2018 created by muthu
		*/
		
		public function communityAdd($community_details){
			$err_msg=[];
			if(trim(isset($community_details->name)?$community_details->name:'')=='')
			$err_msg[]='Community name is required';
			if(trim(isset($community_details->description)?$community_details->description:'')=='')
			$err_msg[]='Description is required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$facility_dao = new CommunityDAO();
				$facility      = $facility_dao->communityAdd($community_details);
				if(!empty($facility)){
				return $response->encode_response(['status' => 'success', 'data' => $facility]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}
			}
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
		}	
		
		
		/*communityList
		16/07/2018 created by muthu
		*/
		
		public function communityList(){
			$community_list = array();
			$dao_request = new CommunityDAO();
			$community_list = $dao_request->communityList();
			$response = new ResponseHandler();
			if(count($community_list)>0){
				return $response->encode_response(['status' => 'success', 'community_list' => $community_list]);
			}else{
				return $response->encode_response(['status' => 'failure', 'community_list' => '','message' => 'Invalid details']);
			}
		}
}
