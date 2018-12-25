<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Our cool includes
include_once "../config/database.php";
include_once "../objects/pattern.php";

$database = new Database();
$db = $database->getConnection();

$pattern = new Pattern($db);

// Set object properties
$pattern->id = ;isset($_POST['id']) ? $_POST['id'] : null;
$pattern->body = isset($_POST['body']) ? $_POST['body'] : null;
$pattern->repository_id = isset($_POST['repository_id']) ? $_POST['repository_id'] : null;
$pattern->project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
$pattern->file_name = isset($_POST['file_name']) ? $_POST['file_name'] : null;
$pattern->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;
$pattern->ta_id = isset($_POST['ta_id']) ? $_POST['ta_id'] : null;
$pattern->active = isset($_POST['active']) ? $_POST['active'] : null;

// Create the dang thing
if ($pattern->update()) {
	echo '{';
        echo '"message": "Pattern was updated."';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to update pattern!"';
    echo '}';
}




?>
