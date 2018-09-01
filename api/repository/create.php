<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get database connection
include_once "../config/database.php";

// Access model object
include_once "../objects/repository.php";

$database = new Database();
$db = $database->getConnection();

$repository = new Repository($db);

// Get posted data
// get posted data
$data = json_decode(file_get_contents("php://input"));

// Set repository property values
$repository->id = $data->id;
$repository->link = $data->link;
$repository->submission_date = $data->submission_date;
$repository->ta_id = $data->ta_id;
$repository->project_id = $data->project_id;
$repository->active = $data->active;

// Create the repository
if ($repository->create()) {
	echo '{';
        echo '"message": "Repository was created."';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to create repository."';
    echo '}';
}

?>
