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

	public function readOne() {
		$query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// bind our ID to the prepared value
		$stmt->bindParam(1, $this->id);

		// Execute query
		$stmt->execute();

		// Get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		// Check if row is null (?)
		if (!is_null($row)) {
			// Read stuff from that puppy
			$this->name = $row["name"];
			$this->submission_date = $row["submission_date"];
			$this->description = $row["description"];
		}
	}

	public function create() {
		$query = "INSERT INTO " . $this->table_name . "
			SET
				id=:id, name=:name, submission_date=:submission_date, description=:description";

		// Prepare query
		$stmt = $this->conn->prepare($query);

		// Sanitize the input I guess
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));
		$this->description = htmlspecialchars(strip_tags($this->description));

		// Bind the values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":submission_date", $this->submission_date);
		$stmt->bindParam(":description", $this->description);

		// Execute!
		return $stmt.execute();	// Boolean value
	}
}
?>
