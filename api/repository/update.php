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

// get id of project to be edited
$data = json_decode(file_get_contents("php://input"));

// Set repository property values
$repository->id = $data->id;
$repository->link = $data->link;
$repository->submission_date = $data->submission_date;
$repository->ta_id = $data->ta_id;
$repository->project_id = $data->project_id;
$repository->active = $data->active;

// Create the repository
if ($repository->update()) {
	echo '{';
        echo '"message": "Repository was updated!"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to update repository."';
    echo '}';
}

?>
