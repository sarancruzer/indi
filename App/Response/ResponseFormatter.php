<?php 
namespace App\Response;

interface  ResponseFormatter {
	public function encode($value);
	public function decode($value);
}