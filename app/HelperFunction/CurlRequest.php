<?php

namespace App\HelperFunction;

use Ixudra\Curl\Facades\Curl;

class CurlRequest{

	public function get($link, $header=null, $type=null){
        return Curl::to($link)
        ->withHeaders([$header])
        ->withContentType($type)
->get();
	}

	public function getWithData($link, $value = array(), $header=null, $type=null){
        return Curl::to($link)
            ->withData($value)
                    ->withHeaders([$header])
                    ->withContentType($type)
            ->get();
	}

	public function postWithData($link, $value = array(), $header=null, $type=null){
		$response = Curl::to($link)
        ->withData($value)
		->withHeaders([$header])
		->withContentType($type)
        ->post();
        return $response;
	}

	public function postJsonData($link, $value= array(), $header=null, $type=null){
		$response = Curl::to($link)
		->withData($value)
		->asJson()
		->withHeaders([$header])
		->withContentType($type)
		->post();
		return $response;
	}

	public function getAsJson($link, $header=null, $type=null){
        return Curl::to($link)->asJson()
             ->withHeaders([$header])
             ->withContentType($type)
        ->get();
	}

	public function getJsonData($link, $value  = [], $header=null, $type=null){
        return Curl::to($link)
            ->withData($value)
            ->asJson()
            ->withHeaders([$header])
            ->withContentType($type)
        ->get();
	}
}
