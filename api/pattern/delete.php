<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Our cool includes
include_once "../config/database.php";
include_once "../objects/pattern.php";

$database = new Database();
$db = $database->getConnection();

$pattern = new Pattern($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Set the ID of the pattern to be deleted
$pattern->id = $data->id;

// Kill it with fire
if ($pattern->delete()) {
	echo '{';
        echo '"message": "Pattern was deleted! (rip)"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to delete pattern."';
    echo '}';
}

?>
