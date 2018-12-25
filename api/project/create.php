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

// Set project property values
$project->id = isset($_POST['id']) ? $_POST['id'] : null;
$project->name = isset($_POST['name']) ? $_POST['name'] : null;
$project->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;
$project->description = isset($_POST['description']) ? $_POST['description'] : null;

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
