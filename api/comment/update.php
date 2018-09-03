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

// Get posted data
$data = json_decode(file_get_contents("php://input"));

$comment->id = $data->id;
$comment->body = $data->body;
$comment->pattern_id = $data->pattern_id;
$comment->ta_id = $data->ta_id;
$comment->submission_date = $data->submission_date;

// Create the entry!
if ($comment->update()) {
	echo '{';
        echo '"message": "Comment was updated."';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to update comment."';
    echo '}';
}

?>
