<?php 
namespace App\Response;

use App\Response\ResponseFormatter as ResponseFormatter;

class JsonHandler implements ResponseFormatter 
{
    public function encode($value, $options = 0) {
        $result = json_encode($value, $options);
		return $result;
    }

    public function decode($json, $assoc = true) {
        $result = json_decode($json, $assoc);
		return $result;
    }
}