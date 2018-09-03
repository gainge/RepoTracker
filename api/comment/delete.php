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

// You won't, you won't
if ($repository->delete()) {
	echo '{';
        echo '"message": "Comment was deleted! (rip)"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to delete comment."';
    echo '}';
}

?>
