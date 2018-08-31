<?php
class Project {
	// Database connection and table name
	private $conn;
	private $table_name = "project";

	// Object properties
	public $id;
	public $name;
	public $submission_date;
	public $description;

	// Constructor with $db Database connection
	public function __construct($db) {
		$this->conn = $db;
	}

	public function read() {	// This reads them all, I guess
		// Select all query
		$query = "SELECT * FROM " . $this->table_name . " ORDER BY submission_date DESC";

		// Prepare query statement
		$stmt = $this->conn->prepare($query);

		// Execute the statement
		$stmt->execute();

		return $stmt;
	}
}
?>
