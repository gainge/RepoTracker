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

$comment->id = isset($_POST['id']) ? $_POST['id'] : null;
$comment->body = isset($_POST['body']) ? $_POST['body'] : null;
$comment->pattern_id = isset($_POST['pattern_id']) ? $_POST['pattern_id'] : null;
$comment->ta_id = isset($_POST['ta_id']) ? $_POST['ta_id'] : null;
$comment->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;

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
