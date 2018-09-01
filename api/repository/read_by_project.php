<?php
// More of those good-ol required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Our standard includes
include_once '../config/database.php';
include_once '../objects/repository.php';

// Get a new database connection
$database = new Database();
$db = $database->getConnection();

// Prepare a model object
$repository = new Repository($db);

// Try to get that young ID from the query
$pid = isset($_GET['project_id']) ? $_GET['project_id'] : die();	// We quit if things don't go our way, like a big baby

$stmt = $repository->readByProject($pid);
$num = $stmt->rowCount();

if ($num >= 0) {
	// Create an array to store the results in
	$repositories_array = array();
	$repositories_array["records"] = array();

	// retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

		// Create a project model instance
		$repo_item = array(
			"id" => $id,
			"link" => $link,
			"submission_date" => $submission_date,
			"ta_id" => $ta_id,
			"project_id" => $project_id,
			"active" => $active
		);

		// Add it to our results
		array_push($repositories_array["records"], $repo_item);
	}

	echo json_encode($repositories_array);

}
else {
	echo json_encode(
        array("message" => "No repositories found.")	// This is how you send back an error message
    );
}

?>
