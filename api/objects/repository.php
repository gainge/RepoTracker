<?php
class Repository {
	// Database connection and table name
	private $conn;
	private $table_name = "repository";

	// Object properties
	public $id;
	public $link;
	public $submission_date;
	public $ta_id;
	public $project_id;
	public $active;

	// Constructor with $db Database connection
	public function __construct($db) {
		$this->conn = $db;
	}

	// Object functions
	public function readFromProject($target_project_id) {
		$query = "SELECT * FROM " . $this->table_name . " WHERE project_id = ? ORDER BY submission_date DESC";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// Bind the target project id
		$stmt->bindParam(1, $target_project_id);

		// Execute query
		$stmt->execute();

		// Give back dem results
		return $stmt;
	}

	public function create() {
		$query = "INSERT INTO " . $this->table_name . "
			SET
				id = :id,
				link = :link,
				submission_date = :submission_date,
				ta_id = :ta_id,
				project_id = :project_id,
				active = :active";

		// Prepare dat yung query
		$stmt = $this->conn->prepare($query);

		// Sanitize I guess
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->link = htmlspecialchars(strip_tags($this->link));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));
		$this->ta_id = htmlspecialchars(strip_tags($this->ta_id));
		$this->project_id = htmlspecialchars(strip_tags($this->project_id));
		$this->active = htmlspecialchars(strip_tags($this->active));

		// Bind the values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":link", $this->link);
		$stmt->bindParam(":submission_date", $this->submission_date);
		$stmt->bindParam(":ta_id", $this->ta_id);
		$stmt->bindParam(":project_id", $this->project_id);
		$stmt->bindParam(":active", $this->active);

		// Execute!
		return $stmt->execute();

	}

}

?>
