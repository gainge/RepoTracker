<?php
// More of those good-ol required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Our cool includes
include_once "../config/database.php";
include_once "../objects/pattern.php";

$database = new Database();
$db = $database->getConnection();

$pattern = new Pattern($db);

// Try to get that young ID from the query
$pid = isset($_GET['project_id']) ? $_GET['project_id'] : die();	// We quit if things don't go our way, like a big baby

$stmt = $pattern->readByProject($pid);
$num = $stmt->rowCount();

if ($num >= 0) {
	// Create an array to store results in
	$patterns_array = array();
	$patterns_array["records"] = array();

	// retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		extract($row);

		$pattern_item = array(
			"id" => $id,
			"body" => $body,
			"repository_id" => $repository_id,
			"project_id" => $project_id,
			"file_name" => $file_name,
			"submission_date" => $submission_date,
			"ta_id" => $ta_id,
			"active" => $active
		);

		// Add to overall results
		array_push($patterns_array["records"], $pattern_item);

	}

	// Send it in, Jerome!
	echo json_encode($patterns_array);
}
else {
	echo json_encode(
        array("message" => "No patterns found.")	// This is how you send back an error message
    );
}

?>
