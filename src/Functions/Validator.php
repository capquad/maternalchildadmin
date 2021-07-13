<?php

namespace Functions;

/**
 * Validator class: helper class for simple authentication and authorization
 */
class Validator
{
	/**
	 * Validate: validate and authorize login. If not logged in redirect to login page
	 */
	static function Authorize(): void
	{
		if ($_SERVER['SCRIPT_NAME'] !== '/login.php' and $_SERVER['SCRIPT_NAME'] !== '/api/login.php') {
			if (@$_SESSION['login'] !== true) {
				// echo "Not logged in.";
				// exit();
				header("Location: /login.php");
			}
		}
	}

	static function cleanup(string $string): string
	{
		return trim(htmlspecialchars($string));
	}

	/**
	 * validateString: validate strings with regexp
	 */
	static function validateString(string $string): string|false
	{
		$string = Validator::cleanup($string);
		if (empty($string)) {
			return false;
		}
		if (preg_match('/^[a-zA-Z-\' @$><\?0-9!_]+$/', $string)) {
			return $string;
		}
		return false;
	}

	/**
	 * validateDate: validate dates with regexp
	 */
	static function validateDate(string $date): string|false
	{
		$date = Validator::cleanup($date);
		if (preg_match("/^((19|20)\d{2})-((0|1)\d)-((0|1|2|3)\d)$/", $date)) {
			return $date;
		}
		return false;
	}

	/**
	 * validateOption: validate string by checking existence in array of options
	 */
	static function validateOption(string $needle, array $list): string|false
	{
		$needle = Validator::cleanup($needle);
		if (in_array($needle, $list, true)) {
			return $needle;
		}
		return false;
	}

	/**
	 * validateEmail: validate email with regex
	 */
	static function validateEmail(string $email): string|false
	{
		$email = Validator::cleanup($email);
		if (preg_match('/^.+@.+\..+$/', $email)) {
			return $email;
		}
		return false;
	}

	/**
	 * validatePhone: valide phone numbers with regex
	 */
	static function validatePhone(string $phone): string|false
	{
		$phone = Validator::cleanup($phone);
		// return $phone;
		if (preg_match("/
			^
			(\+\d+)?
			\s?
			(\(\d{3}\)|(\d{3}))
			\s?
			(\d{3}|\d{4})
			\s?
			(-)?
			(\d{4})
		$/x", $phone)) {
			return $phone;
		}
		return false;
	}

	/**
	 * validateCardNumber: validate a patient's card number
	 */
	static function validateCardNumber(string $number): string | bool
	{
		$number = Validator::cleanup($number);
		if (preg_match('/^.{3}-\d{6,7}$/', $number)) {
			return $number;
		}
		return false;
	}

	/**
	 * validateInteger: validate and return a number string
	 */
	static function validateInteger(string $int): bool|int
	{
		$int = Validator::cleanup($int);
		if (preg_match('/^\d+$/', $int)) {
			return (int) $int;
		}
		return false;
	}
}
