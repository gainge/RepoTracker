<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get database connection
include_once "../config/database.php";
include_once "../objects/ta.php";

$database = new Database();
$db = $database->getConnection();

$ta = new TA($db);

// Get posted data
$data = json_decode(file_get_contents("php://input"));
$ta->id = $data->id;
$ta->netid = $data->netid;
$ta->name = $data->name;
$ta->added_by_id = $data->added_by_id;
$ta->add_date = $data->add_date;
$ta->active = $data->active;

// Create the TA!
if ($ta->create()) {
	echo '{';
        echo '"message": "TA was Added!"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to add TA."';
    echo '}';
}

?>
