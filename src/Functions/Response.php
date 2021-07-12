<?php

namespace Functions;

class Response
{
	/**
	 * Json: return data in json format. useful for asynchronous responses
	 */
	static function Json(array $data, int $statusCode = 200)
	{
		header("Content-type: application/json");
		http_response_code($statusCode);

		echo json_encode($data);
		exit();
	}


	/**
	 * Redirect: uses header function to redirect URL
	 */
	static function Redirect(string $location, int $statusCode = 200)
	{
		http_response_code($statusCode);
		header("Location: $location");
		exit();
	}

	/**
	 * RedirectWithSession: redirect but set session variables
	 */
	static function RedirectWithSession(string $location, array $session_vars, $statusCode)
	{
		foreach ($session_vars as $var => $value) {
			$_SESSION[$var] = $value;
		}
		Response::Redirect($location, $statusCode);
	}
}
