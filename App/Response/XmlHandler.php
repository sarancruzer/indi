<?php 
namespace App\Response;

use App\Response\ResponseFormatter as ResponseFormatter;

class XmlHandler implements ResponseFormatter 
{
    public function encode($value, $options = 0) {
       echo 'xml';
	   exit;
    }

    public function decode($json, $assoc = false) {
        $result = json_decode($json, $assoc);
		return $result;
    }
}