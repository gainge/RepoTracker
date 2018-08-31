<?php
class Database {

	// Define some cool variables my guy
	// private $host = "127.0.0.1";
	private $host = "localhost";
	private $port = "8000";
	private $db_name = "api_db";
	private $username = "";
	private $password = "";
	public $conn;

	// Get the database connection
	public function getConnection() {
		$this->conn = null;

		try {
			$this->conn = new PDO("sqlite:../../api_db.db");
		} catch (PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}

		// Give the database back, or whatever
		return $this->conn;
	}
}
?>
