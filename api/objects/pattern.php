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

	public function create() {
		$query = "INSERT INTO " . $this->table_name . "
			SET
				id = :id,
				body = :body,
				repository_id = :repository_id,
				project_id = :project_id,
				file_name = :file_name,
				submission_date = :submission_date,
				ta_id = :ta_id,
				active = :active";

		// Prepare query
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->repository_id = htmlspecialchars(strip_tags($this->repository_id));
		$this->project_id = htmlspecialchars(strip_tags($this->project_id));
		$this->file_name = htmlspecialchars(strip_tags($this->file_name));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));
		$this->ta_id = htmlspecialchars(strip_tags($this->ta_id));
		$this->active = htmlspecialchars(strip_tags($this->active));

		// Bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":body", $this->body);
		$stmt->bindParam(":repository_id", $this->repository_id);
		$stmt->bindParam(":project_id", $this->project_id);
		$stmt->bindParam(":file_name", $this->file_name);
		$stmt->bindParam(":submission_date", $this->submission_date);
		$stmt->bindParam(":ta_id", $this->ta_id);
		$stmt->bindParam(":active", $this->active);

		// Execute!
		return $stmt->execute();
	}

	public function delete() {
		// delete query
    	$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// Sanitize
    	$this->id = htmlspecialchars(strip_tags($this->id));

		// Bind the data
		$stmt->bindParam(1, $this->id);

		// Do it dude
		return $stmt->execute();
	}

	public function readByProject($target_project_id) {
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

	public function readByRepo($target_repo_id) {
		$query = "SELECT * FROM " . $this->table_name . " WHERE repository_id = ? ORDER BY submission_date DESC";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// Bind the target project id
		$stmt->bindParam(1, $target_repo_id);

		// Execute query
		$stmt->execute();

		// Give back dem results
		return $stmt;
	}

	public function update() {
		$query = "UPDATE " . $this->table_name . "
			SET
				body = :body,
				repository_id = :repository_id,
				project_id = :project_id,
				file_name = :file_name,
				submission_date = :submission_date,
				ta_id = :ta_id,
				active = :active
			WHERE
				id = :id";

		// Prepare statement
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->repository_id = htmlspecialchars(strip_tags($this->repository_id));
		$this->project_id = htmlspecialchars(strip_tags($this->project_id));
		$this->file_name = htmlspecialchars(strip_tags($this->file_name));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));
		$this->ta_id = htmlspecialchars(strip_tags($this->ta_id));
		$this->active = htmlspecialchars(strip_tags($this->active));

		// Bind values
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":body", $this->body);
		$stmt->bindParam(":repository_id", $this->repository_id);
		$stmt->bindParam(":project_id", $this->project_id);
		$stmt->bindParam(":file_name", $this->file_name);
		$stmt->bindParam(":submission_date", $this->submission_date);
		$stmt->bindParam(":ta_id", $this->ta_id);
		$stmt->bindParam(":active", $this->active);

		// Execute!
		return $stmt->execute();
	}



}
?>
