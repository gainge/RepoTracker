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

}

?>
