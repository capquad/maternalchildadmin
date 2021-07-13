<?php

namespace Database;

use mysqli;

/**
 * Database class: abstracts common database functions 
 */
class Database
{
	private $database;
	private $user;
	private $passwd;
	private $host;
	/**
	 * $this->cxn: connection variable, holds the mysqli object
	 */
	private $cxn;

	/**
	 * @constructor
	 */
	function __construct()
	{
		$this->database = $_ENV['DATABASE'];
		$this->user = $_ENV['DATABASE_USER'];
		$this->host = $_ENV['DATABASE_HOST'];
		$this->passwd = $_ENV['DATABASE_PASSWD'];
	}

	function connect()
	{
		$cxn = mysqli_connect($this->host, $this->user, $this->passwd);
		if ($cxn) {
			if (mysqli_select_db($cxn, $this->database)) {
				$this->cxn = $cxn;
				return true;
			}
			return false;
		}
		return false;
	}

	/**
	 * Check table existence in the selected database
	 */
	private function tableExists(string $table)
	{
		$table = mysqli_real_escape_string($this->cxn, $table);

		$query = "SHOW TABLES LIKE '$table';";

		$result = mysqli_query($this->cxn, $query);
		// print_r(mysqli_fetch_array($result, MYSQLI_NUM));
		if ($result) {
			return true;
		}
		return false;
	}

	/**
	 * select($table, $rows, $where, $limit)
	 * @param {string} table
	 * @param {string} rows - comma separated string list of rows to be selected
	 * @param {string} where - where condition to be executed
	 */
	function select(string $table, ?string $rows = null, ?string $where = null)
	{
		if ($this->tableExists($table)) {
			if (!$rows) {
				$rows = '*';
			}

			$sql = "SELECT $rows FROM $table";
			if ($where) {
				$sql .= " WHERE $where";
			}
			$sql .= ";";
			$query = $this->runQuery($sql);

			return mysqli_fetch_all($query, MYSQLI_ASSOC);
		}
	}

	/**
	 * insert($table, $data)
	 * @param string $table - table for values to be inserted
	 * @param array $data - array encoded column and values of data to be entered.
	 * @return bool
	 */
	function insert(string $table, array $data): bool|string
	{
		if ($this->tableExists($table)) {
			$sql = "INSERT INTO $table ";

			$data = array_map(function ($value) {
				return "'$value'";
			}, $data);

			$sql .= "(" . join(',', array_keys($data)) . ")";
			$sql .= "VALUES (" . join(',', array_values($data)) . ")";

			// return $sql;

			$query = $this->runQuery($sql);
			if ($query) {
				return @mysqli_insert_id($this->cxn);
			}
		}
		return false;
	}

	/**
	 * update - updates a record in a table
	 */
	function update(string $table, array $data, ?string $where = null): bool|string
	{
		if ($this->tableExists($table)) {
			$sql = "UPDATE IGNORE $table SET ";
			$kvpairs = array_map(function ($key, $value) {
				return "$key='$value'";
			}, array_keys($data), array_values($data));

			$sql .= join(",", $kvpairs);

			if ($where) {
				$sql .= " WHERE $where";
			}

			$query = $this->runQuery($sql);
			if ($query) {
				return true;
			}
		}
		return false;
	}

	function getError()
	{
		return @mysqli_error($this->cxn);
	}

	private function runQuery($sql)
	{
		return @mysqli_query($this->cxn, $sql);
	}
}
