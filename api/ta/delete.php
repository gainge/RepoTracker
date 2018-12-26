<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Our standard includes
include_once '../config/database.php';
include_once '../objects/ta.php';

$database = new Database();
$db = $database->getConnection();

$ta = new TA($db);

$ta->id = isset($_POST['id']) ? $_POST['id'] : null;

// Do the darn deletion!
if ($ta->delete()) {
	echo '{';
        echo '"message": "TA was removed! (rip)"';
    echo '}';
}
else {
	echo '{';
        echo '"message": "Unable to remove TA."';
    echo '}';
}

?>
