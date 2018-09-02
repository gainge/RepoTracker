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

		// Bind the values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":netid", $this->netid);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":added_by_id", $this->added_by_id);
		$stmt->bindParam(":add_date", $this->add_date);
		$stmt->bindParam(":active", $this->active);

		// Do the thing!
		return $stmt->execute();
	}

	public function delete() {
		// delete query
    	$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// Sanitize
    	$this->id=htmlspecialchars(strip_tags($this->id));

		// Bind the data
		$stmt->bindParam(1, $this->id);

		// Do it dude
		return $stmt->execute();
	}

	public function read() {	// Reads all them suckers
		// Select all query
		$query = "SELECT * FROM " . $this->table_name . " ORDER BY name DESC";

		// Prepare query statement
		$stmt = $this->conn->prepare($query);

		// Execute the statement
		$stmt->execute();

		return $stmt;
	}

	public function update() {
		$query = "UPDATE " . $this->table_name . "
				SET
					netid = :netid,
					name = :name,
					added_by_id = :added_by_id,
					add_date = :add_date,
					active = :active
				WHERE
					id = :id";

		 // Prepare statement!
		 $stmt = $this->conn->prepare($query);

		// Sanitize
 		$this->id = htmlspecialchars(strip_tags($this->id));
 		$this->netid = htmlspecialchars(strip_tags($this->netid));
 		$this->name = htmlspecialchars(strip_tags($this->name));
 		$this->added_by_id = htmlspecialchars(strip_tags($this->added_by_id));
 		$this->add_date = htmlspecialchars(strip_tags($this->add_date));
 		$this->active = htmlspecialchars(strip_tags($this->active));

		// bind the data
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":netid", $this->netid);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":added_by_id", $this->added_by_id);
		$stmt->bindParam(":add_date", $this->add_date);
		$stmt->bindParam(":active", $this->active);

		// Return the result
		return $stmt->execute();
	}






}

?>
