<?php 
namespace App\Request;
use App\Request\JsonHandler as JsonHandler;

class RequestHandler {
	protected $request_type;
	
	public function __construct()
	{
		 $this->request_type = new JsonHandler;
	}
	
	public function parse($value){
		return $this->request_type->parser($value);
	}
}