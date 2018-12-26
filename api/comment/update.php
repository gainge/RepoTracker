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

$comment->id = isset($_POST['id']) ? $_POST['id'] : null;
$comment->body = isset($_POST['body']) ? $_POST['body'] : null;
$comment->pattern_id = isset($_POST['pattern_id']) ? $_POST['pattern_id'] : null;
$comment->ta_id = isset($_POST['ta_id']) ? $_POST['ta_id'] : null;
$comment->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;

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
