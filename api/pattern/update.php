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

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Set object properties
$pattern->id = $data->id;
$pattern->body = $data->body;
$pattern->repository_id = $data->repository_id;
$pattern->project_id = $data->project_id;
$pattern->file_name = $data->file_name;
$pattern->submission_date = $data->submission_date;
$pattern->ta_id = $data->ta_id;
$pattern->active = $data->active;

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
