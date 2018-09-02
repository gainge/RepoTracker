<?php
class Pattern {
	// Database connection and table name
	private $conn;
	private $table_name = "pattern";

	// Object properties
	public $id;
	public $body;
	public $repository_id;
	public $project_id;
	public $file_name;
	public $submission_date;
	public $ta_id;
	public $active;

	// Constructor with $db Database connection
	public function __construct($db) {
		$this->conn = $db;
	}



}
?>
