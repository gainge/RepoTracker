<?php
class TA {
	// Database connection and table name
	private $conn;
	private $table_name = "ta";

	// Object properties
	public $id;
	public $netid;
	public $name;
	public $added_by_id;
	public $add_date;
	public $active;

	// Constructor with $db Database connection
	public function __construct($db) {
		$this->conn = $db;
	}






}

?>
