<?php
// More of those good-ol required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// The coolest includes on the block
include_once "../config/database.php";
include_once "../objects/comment.php";

$database = new Database();
$db = $database->getConnection();

$comment = new Comment($db);

// Try to get that young ID from the query
$pid = isset($_GET['pattern_id']) ? $_GET['pattern_id'] : die();	// We quit if things don't go our way, like a big baby

$stmt = $comment->readByPattern($pid);
$num = $stmt->rowCount();

if ($num >= 0) {
	// Create an array to store results
	$comments_array = array();
	$comments_array["records"] = array();

	// retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// Extract row
		extract(row);

		// Create an individual comment item.
		$comment_item = array(
			"id" => $id,
			"body" => $body,
			"pattern_id" => $pattern_id,
			"ta_id" => $ta_id,
			"submission_date" => $submission_date
		);

		// Add to results
		array_push($comments_array["records"], $comment_item);
	}

	// Send it back like beckham or something
	echo json_encode($comments_array);
}
else {
	echo json_encode(
        array("message" => "No comments found.")	// This is how you send back an error message
    );
}

?>
