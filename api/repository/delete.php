<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Our standard includes
include_once '../config/database.php';
include_once "../objects/repository.php";

// Get a new database connection
$database = new Database();
$db = $database->getConnection();

// Initialize a project object with our connection
$repository = new Repository($db);

// Set the ID of the project to be deleted
$repository->id = isset($_POST['id']) ? $_POST['id'] : null;

// Do the thing, Zhu-Li
if ($repository->delete()) {
	echo '{';
        echo '"message": "Repository was deleted! (rip)"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to delete repository."';
    echo '}';
}

?>
