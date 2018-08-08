<?php 
namespace App\Request;

use App\Request\iRequestParser as RequestParser;

class JsonHandler implements RequestParser 
{
    public function parser($value,$options=true) {
        $result = json_decode($value, $options);
		return (array)$result;
    }
}