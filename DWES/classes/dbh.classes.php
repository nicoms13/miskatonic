<?php

class Dbh {

	public static $connection;

	private function __construct() {

	}

	public function connect() {
		if (!isset(self::$connection)) {
			try {
				$username = "root";
				$password = "";
				$dbh = new PDO('mysql:host=localhost;dbname=loginmiskatonic', $username, $password);
			}
			catch (PDOException $e) {
				die();
			}
		}

		return $dbh;
	}

}