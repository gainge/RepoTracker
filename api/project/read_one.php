<?php
// More of those good-ol required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Our standard includes
include_once '../config/database.php';
include_once '../objects/project.php';

// Get a new database connection
$database = new Database();
$db = $database->getConnection();

// Prepare a model object
$project = new Project($db);

// Try to get that young ID from the query
$project->id = isset($_GET['id']) ? $_GET['id'] : die();	// We quit if things don't go our way, like a big baby

$project->readOne();	// This reads itself?

// Create array
$project_array = array(
	"id" => $project->id,
	"name" => $project->name,
	"submission_date" => $project->submission_date,
	"description" => $project->description
);

// make it json format
print_r(json_encode($project_array));

?>
