<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
if ($comment->create()) {
	echo '{';
        echo '"message": "Comment was created."';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to create comment."';
    echo '}';
}

?>
