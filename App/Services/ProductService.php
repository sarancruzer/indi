<?php
namespace App\Services;
ini_set('display_errors',1);
ini_set('error_reporting',E_ALL);
use App\Dao\ProductDAO as ProductDAO;
use App\Response\ResponseHandler as ResponseHandler;
use App\Response\JsonHandler as JsonHandler;
use App\Response\XmlHandler as XmlHandler;


/**
* Class LoginService
* @package App\Services
* Service class for ProductAdd
*/
class ProductService
{
		
		/*ProductAdd
		09/07/2018 created by muthu
		*/
		
		
		public function productAdd($product_details){
			$err_msg=[];
			if(trim(isset($product_details->name)?$product_details->name:'')=='')
			$err_msg[]='Product name is required';
			if(trim(isset($product_details->info)?$product_details->info:'')=='')
			$err_msg[]='Product info is required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$product_dao = new ProductDAO();
				$product      = $product_dao->productAdd($product_details);
				if($product['result'] == 'success'){
				return $response->encode_response(['status' => 'success', 'data' => $product]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}
			}
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);
			
			
		}
		
		
		public function ProductStatusupdate($product_details){
			
			 $product_dao = new ProductDAO();
			 $product      = $product_dao->ProductStatusupdate($product_details);
			 $response = new ResponseHandler();
			 return $response->encode_response(['status' => 'success', 'message' => 'Product updated']);
			
		}
		
		
		public function productUpdate($product_details){
			$err_msg=[];
			if(trim(isset($product_details->name)?$product_details->name:'')=='')
			$err_msg[]='Product name is required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
				$product_dao = new ProductDAO();
				$product      = $product_dao->productUpdate($product_details);
				if(!empty($product)){
				return $response->encode_response(['status' => 'success', 'data' => $product]);
				}else{
					return $response->encode_response(['status' => 'failure', 'message' => 'Invalid process']);
				}
			}
			else
			return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);
			
			
		}
		
		// public function productImage(){
				// echo "<pre>";print_r($_FILES);exit;
				
				// $con=file_get_contents($_POST['filename']);
				// $en=base64_decode($con);
				// echo $en;exit;
			 // if(is_array($_FILES)) {
				// $file = $_FILES['product']['tmp_name']; 
				// $sourceProperties = getimagesize($file);
				// $fileNewName = time();
				// $folderPath = __DIR__. '/product_images/';
				// $ext = pathinfo($_FILES['product']['name'], PATHINFO_EXTENSION);
				// $imageType = $sourceProperties[2];
			
				// switch ($imageType) {
					
					// case IMAGETYPE_PNG:
						// $imageResourceId = imagecreatefrompng($file); 
						// $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
						// imagepng($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);
						// break;

					// case IMAGETYPE_GIF:
						// $imageResourceId = imagecreatefromgif($file); 
						// $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
						// imagegif($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);
						// break;

					// case IMAGETYPE_JPEG:
						// $imageResourceId = imagecreatefromjpeg($file); 
						// $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
						// imagejpeg($targetLayer,$folderPath. $fileNewName. "_thumbnail.". $ext);
						// break;
						
					

					// default:
						// echo "Invalid Image type.";
						// exit;
						// break;

				// }

				// move_uploaded_file($file, $folderPath. $fileNewName. ".". $ext);
				// echo "Image Uploaded with created thumbnail Successfully.";

			// }else{

// }
			
		// }
		
		
		
		public function productList($product_list){
			
			$supplier_id = $product_list->supplier_id;
			
			$product_list_response = array();
			$dao_request = new ProductDAO();
			$product_list_response = $dao_request->productList($product_list);
			
			$response = new ResponseHandler();
			// echo json_encode($product_list_response, JSON_PRETTY_PRINT);
			if(count($product_list_response)>0){
				return $response->encode_response(['status' => 'success', 'product_details' => $product_list_response]);
			}else{
				return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
			}
			
		}
		
		public function productListforCalendar($product_list){
			
			$supplier_id = $product_list->supplier_id;
			
			$product_list_response = array();
			$dao_request = new ProductDAO();
			$product_list_response = $dao_request->productListforCalendar($product_list);
			
			$response = new ResponseHandler();
			// echo json_encode($product_list_response, JSON_PRETTY_PRINT);
			if(count($product_list_response)>0){
				return $response->encode_response(['status' => 'success', 'product_details' => $product_list_response]);
			}else{
				return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
			}
			
		}
		
		/**
	* To delete product image
	* @input array
	* @output json response
	**/
	public function productImagedelete($request)
	{
		
		
		$response = new ResponseHandler();
		if(!isset($request->id)){
			// success call
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'ID Required']);
		}
		$id       = $request->id;
		$user_list_response = array();
		$dao_request = new ProductDAO();
		$user_list_response = $dao_request->produceImagedelete($id);
		
		$response = new ResponseHandler();
		
		if(count($user_list_response)>0){
			// success call
			return $response->encode_response(['status' => 'success','message' => 'Deleted Successfully']);
		}else{
			// invalid user
			return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'Invalid details']);
		}
	}	
		
		
		public function productImage(){
			
			    $str =((file_get_contents('php://input')));
				if (strpos($str, "image/jpeg") !== false) {
				$t=explode("image/jpeg",$str);
				$filename = md5(time()).'.jpg';
				}
				else if (strpos($str, "image/png") !== false) {
				$t=explode("image/png",$str);
				$filename = md5(time()).'.png';
				}
				else if (strpos($str, "image/gif") !== false) {
				$t=explode("image/gif",$str);
				$filename = md5(time()).'.gif';
				}
				else if (strpos($str, "image/jpeg") !== false) {
				$t=explode("image/jpeg",$str);
				$filename = md5(time()).'.jpeg';
				}
				else
					$err="Invalid Format";
				
				 $response = new ResponseHandler();
				if(isset($err))
				{
					
					return $response->encode_response(['status' => 'failure', 'message' => $err]);
				}
				else
				{
					$path="App/Services/product_images/".$filename;
					file_put_contents($path,ltrim($t[1]));
					$product_dao = new ProductDAO();
					$product      = $product_dao->productImage($filename);
					$this->Thumbnail($path,'App/Services/product_images/thumbnail/'.$filename);
					return $response->encode_response(['status' => 'success', 'image_Details' => $product]);
				}
		}
		function Thumbnail($url, $filename, $width = 150, $height = true) {

			// download and create gd image
			$image = ImageCreateFromString(file_get_contents($url));

			// calculate resized ratio
			// Note: if $height is set to TRUE then we automatically calculate the height based on the ratio
			$height = $height === true ? (ImageSY($image) * $width / ImageSX($image)) : $height;

			// create image 
			$output = ImageCreateTrueColor($width, $height);
			ImageCopyResampled($output, $image, 0, 0, 0, 0, $width, $height, ImageSX($image), ImageSY($image));

			// save image
			ImageJPEG($output, $filename, 95); 

			// return resized image
			return $output; // if you need to use it
		}
		function imageResize($imageResourceId,$width,$height) {
			$targetWidth =250;
			$targetHeight =250;
			$targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
			imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
			return $targetLayer;

		}
		
		/*ProductGet
		09/07/2018 created by muthu
		*/
		
		public function productGet($request){
			
			$response = new ResponseHandler();
			if(!isset($request->id)){
				return $response->encode_response(['status' => 'failure', 'user_details' => '','message' => 'ID Required']);
			}
			
			$product_list_response = array();
			$dao_request = new ProductDAO();
			$product_list_response = $dao_request->productGet($request->id);

			if(count($product_list_response)>0){
				return $response->encode_response(['status' => 'success', 'product_details' => $product_list_response]);
			}else{
				return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
			}
		}	
		
		/*ProductList
		09/07/2018 created by muthu
		*/
		
		/*public function productList($product_list){
			
			$supplier_id = $product_list->supplier_id;
			
			$err_msg=[];
			if(trim(isset($supplier_id)?$supplier_id:'')=='')
			$err_msg[]='Supplier id required';
			$response = new ResponseHandler();
			if(empty($err_msg)){
			
				$product_list_response = array();
				$dao_request = new ProductDAO();
				$product_list_response = $dao_request->productList($supplier_id);
				
				if(count($product_list_response)>0){
					return $response->encode_response(['status' => 'success', 'product_details' => $product_list_response]);
				}else{
					return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
				}
			}else{
				return $response->encode_response(['status' => 'failure', 'message' =>$err_msg]);
			}
		}*/ 
		
		public function productApproval(){
			
				$response = new ResponseHandler();
			
				$product_list_approval = array();
				$dao_request = new ProductDAO();
				$product_list_approval = $dao_request->productApproval();
				
				if(count($product_list_approval)>0){
					return $response->encode_response(['status' => 'success', 'product_approval' => $product_list_approval]);
				}else{
					return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
				}
			
		}
		
		
		
		public function productDashboard($product_list){
			
			$supplier_id = $product_list->supplier_id;
			
			$product_list_response = array();
			$dao_request = new ProductDAO();
			$product_list_response = $dao_request->productDashboard($product_list);
			
			$response = new ResponseHandler();
			// echo json_encode($product_list_response, JSON_PRETTY_PRINT);
			if(count($product_list_response)>0){
				return $response->encode_response(['status' => 'success', 'product_details' => $product_list_response]);
			}else{
				return $response->encode_response(['status' => 'failure', 'product_details' => '','message' => 'Invalid details']);
			}
			
		}
		
}
