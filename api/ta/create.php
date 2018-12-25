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

$ta->id = isset($_POST['id']) ? $_POST['id'] : null;
$ta->netid = isset($_POST['netid']) ? $_POST['netid'] : null;
$ta->name = isset($_POST['name']) ? $_POST['name'] : null;
$ta->added_by_id = isset($_POST['added_by_id']) ? $_POST['added_by_id'] : null;
$ta->add_date = isset($_POST['add_date']) ? $_POST['add_date'] : null;
$ta->active = isset($_POST['active']) ? $_POST['active'] : null;

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
