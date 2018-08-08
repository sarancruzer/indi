<?php 
namespace App\Response;
use App\Response\JsonHandler as JsonHandler;

class ResponseHandler {
	protected $response_type;
	
	public function __construct()
	{
		 $this->response_type = new JsonHandler;
	}
	
	public function encode_response($value){
		return $this->response_type->encode($value);
	}
	public function decode_response($value){
		return $this->response_type->decode($value);
	}	
}