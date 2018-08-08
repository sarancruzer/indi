<?php
namespace App\Services;
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);

use App\Dao\CategoryDAO as CategoryDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;


/**
* Class categoryAdd
* @package App\Services
* Service class for ProductAdd
*/
class CategoryService
{
		
		
		/*categoryAdd
		06/07/2018 created by muthu
		*/
		
		public function categoryAdd($category_details){
			$err_msg=[];
			if(trim(isset($category_details->name)?$category_details->name:'')=='')
			$err_msg[]='Category name is required';
			if(trim(isset($category_details->description)?$category_details->description:'')=='')
			$err_msg[]='Description is required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$category_dao = new CategoryDAO();
				$category      = $category_dao->categoryAdd($category_details);
				if(!empty($category)){
				return $response->encode_response(['status' => 'success', 'data' => $category]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}
			}
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);	
		}	
		
		
		/*categoryIcon
		09/07/2018 created by muthu
		*/
		
		public function categoryIcon($icon){
			
			if(is_array($_FILES)) {
				$file = $_FILES['icon']['tmp_name']; 
				$sourceProperties = getimagesize($file);
				$fileNewName = time();
				$folderPath = $_SERVER['SERVER_NAME']. '/indigenours_tour/App/Services/Category_icons/';
				$ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
				move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
				echo "Image Uploaded with created Successfully.";

			}
		}
		
		
		/*categoryList
		16/07/2018 created by muthu
		*/
		
		public function categorylist($category){
			$category_list = array();
			$dao_request = new CategoryDAO();
			$category_list = $dao_request->categoryList($category);
			$response = new ResponseHandler();
			if(count($category_list)>0){
				return $response->encode_response(['status' => 'success', 'category_list' => $category_list]);
			}else{
				return $response->encode_response(['status' => 'failure', 'category_list' => '','message' => 'Invalid details']);
			}
		}
		
}
