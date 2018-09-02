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

	public function create() {
		$query = "INSERT INTO " . $this->table_name . "
			SET
				id = :id,
				netid = :netid,
				name = :name,
				added_by_id = :added_by_id,
				add_date = :add_date,
				active = :active";

		// Prepare query
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->netid = htmlspecialchars(strip_tags($this->netid));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->added_by_id = htmlspecialchars(strip_tags($this->added_by_id));
		$this->add_date = htmlspecialchars(strip_tags($this->add_date));
		$this->active = htmlspecialchars(strip_tags($this->active));

		// Do the thing!
		return $stmt->execute();
	}






}

?>
