<?php

namespace Functions;

class Response
{
	static function Json(array $data, int $statusCode = 200)
	{
		header("Content-type: application/json");
		http_response_code($statusCode);

		echo json_encode($data);
		exit();
	}
}
