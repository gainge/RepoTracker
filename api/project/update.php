<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Our standard includes
include_once '../config/database.php';
include_once '../objects/project.php';

// Get a new database connection
$database = new Database();
$db = $database->getConnection();

// Initialize a project object with our connection
$project = new Project($db);

// get id of project to be edited
$data = json_decode(file_get_contents("php://input"));

// Set the id in our target model
$project->id = $data->id;

// Set the new values in our model object
$project->name = $data->name;
$project->submission_date = $data->submission_date;
$project->description = $data->description;

// Then, let our model BOII do the work
if ($project->update()) {
	echo '{';
        echo '"message": "Project was updated!"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to update project."';
    echo '}';
}



?>
