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
include_once "../objects/project.php";

$database = new Database();
$db = $database->getConnection();

$project = new Project($db);

// Get posted data
// get posted data
$data = json_decode(file_get_contents("php://input"));

// Set project property values
$project->id = $data->id;
$project->name = $data->name;
$project->submission_date = $data->submission_date;
$project->description = $data->description;

// Create the project
if ($project->create()) {
	echo '{';
        echo '"message": "Project was created."';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to create project."';
    echo '}';
}





?>
