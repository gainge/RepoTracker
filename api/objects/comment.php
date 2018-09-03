<?php
class Comment {
	// Database connection and table name
	private $conn;
	private $table_name = "project";

	// Object properties
	public $id;
	public $body;
	public $pattern_id;
	public $ta_id;
	public $submission_date;

	public function __construct($db) {
		$this->conn = $db;
	}


	public function create() {
		$query = "INSERT INTO " . $this->table_name . "
			SET
				id = :id,
				body = :body,
				pattern_id = :pattern_id,
				ta_id = :ta_id,
				submission_date = :submission_date";

		// Prepare the queryyyyy boiiii
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->pattern_id = htmlspecialchars(strip_tags($this->pattern_id));
		$this->ta_id = htmlspecialchars(strip_tags($this->ta_id));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));

		// Bind
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":body", $this->body);
		$stmt->bindParam(":pattern_id", $this->pattern_id);
		$stmt->bindParam(":ta_id", $this->ta_id);
		$stmt->bindParam(":submission_date", $this->submission_date);

		// Do it!!
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

		// Do it my guy
		return $stmt->execute();
	}

	public function readByPattern($target_pattern_id) {
		$query = "SELECT * FROM " . $this->table_name . " WHERE pattern_id = ? ORDER BY submission_date DESC";

		// Prepare the statement
		$stmt = $this->conn->prepare($query);

		// Bind the target project id
		$stmt->bindParam(1, $target_pattern_id);

		// Execute query
		$stmt->execute();

		// Give back dem results
		return $stmt;
	}

	public function update() {
		$query = "UPDATE " . $this->table_name . "
			SET
				body = :body,
				pattern_id = :pattern_id,
				ta_id = :ta_id,
				submission_date = :submission_date
			WHERE
				id = :id";

		// Prepare the queryyyyy boiiii
		$stmt = $this->conn->prepare($query);

		// Sanitize
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->body = htmlspecialchars(strip_tags($this->body));
		$this->pattern_id = htmlspecialchars(strip_tags($this->pattern_id));
		$this->ta_id = htmlspecialchars(strip_tags($this->ta_id));
		$this->submission_date = htmlspecialchars(strip_tags($this->submission_date));

		// Bind
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":body", $this->body);
		$stmt->bindParam(":pattern_id", $this->pattern_id);
		$stmt->bindParam(":ta_id", $this->ta_id);
		$stmt->bindParam(":submission_date", $this->submission_date);

		// Do it!!
		return $stmt->execute();
	}

}

?>
