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

// Set repository property values
$repository->id = isset($_POST['id']) ? $_POST['id'] : null;
$repository->link = isset($_POST['link']) ? $_POST['link'] : null;
$repository->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;
$repository->ta_id = isset($_POST['ta_id']) ? $_POST['ta_id'] : null;
$repository->project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
$repository->active = isset($_POST['active']) ? $_POST['active'] : null;

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
