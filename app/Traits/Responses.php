<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

trait Responses
{
	public function handleResponse($data, $status = 200, $headers = [])
	{
		$json_status = config('status.http_codes.success') == $status 
						? 	'data'
						:	'error';

		$array_data = [
			'status'	=>	$status,
			'message'	=>	'Successful',
			'data'		=>	$data
		];

		if ($data instanceof ModelNotFoundException 
			|| $data instanceof Exception) {
			$array_data = $this->exceptionResponse($data, $status);
		}

		$response = [
            $json_status => $array_data
        ];

		return response()->json($response, $status, $headers);

	}

	public function exceptionResponse($e, $status)
	{
		return [
			'status'	=>	$status,
			'message'	=>	$e->getMessage()
		];
	}
}