<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    //

    public function sendResponse1($result, $message, $token) 
    { 
    	$response = [ 
    		'success' => true, 
    		'data' => $result, 
    		'message' => $message, 
    		'token' => $token, 
    	];
    	return response()->json($response, 200); 
	} 

	public function sendResponse($result, $message) 
    { 
    	$response = [ 
    		'success' => true, 
    		'data' => $result, 
    		'message' => $message, 
    	];
    	return response()->json($response, 200); 
	} 

    public function sendResponseForDownloads( $message) 
    { 
        $response = [ 
            'success' => true,  
            'message' => $message, 
        ];
        return response()->json($response, 200); 
    }


   public function sendWarning( $message) 
    { 
    	$response = [ 
    		'success' => false,  
    		'message' => $message, 
    	];
    	return response()->json($response, 401); 
	}
	/** 
	* return error response. 
	* 
	* @return \Illuminate\Http\Response 
	*/ 

	public function sendError($error, $errorMessages = [], $code = 404) 
	{ 
		$response = [ 
			'success' => false, 
			'message' => $error, 
		]; 


		if(!empty($errorMessages)){ 
			$response['data'] = $errorMessages; 
		} 

		return response()->json($response, $code); 
	} 
}
