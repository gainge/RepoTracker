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

// Set the ID of the project to be deleted
$project->id = $data->id;

// Do the thing, Zhu-Li
if ($project->delete()) {
	echo '{';
        echo '"message": "Project was deleted! (rip)"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to delete project."';
    echo '}';
}

?>
