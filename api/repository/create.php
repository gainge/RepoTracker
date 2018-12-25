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

// Set repository property values
$repository->id = isset($_POST['id']) ? $_POST['id'] : null;
$repository->link = isset($_POST['link']) ? $_POST['link'] : null;
$repository->submission_date = isset($_POST['submission_date']) ? $_POST['submission_date'] : null;
$repository->ta_id = isset($_POST['ta_id']) ? $_POST['ta_id'] : null;
$repository->project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;
$repository->active = isset($_POST['active']) ? $_POST['active'] : null;

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
