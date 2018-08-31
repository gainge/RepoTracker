<?php
class Database {

	// Define some cool variables my guy
	private $host = "localhost";
	private $db_name = "api_db";
	private $username = "root";
	private $password = "password";
	public $conn;

	// Get the database connection
	public function getConnection() {
		$this->conn = null;

		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->exec("set names utf8");
		} catch (PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}

		// Give the database back, or whatever
		return $this->conn;
	}
}
?>
