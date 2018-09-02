<?php
// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Get database connection
include_once "../config/database.php";
include_once "../objects/ta.php";

$database = new Database();
$db = $database->getConnection();

$ta = new TA($db);

$stmt = $ta->read();
$num = $stmt->rowCount();

if ($num >= 0) {	// STILL doesn't work LOLOLOL
	// Create an array to store the results in.
	$ta_array = array();
	$ta_array["records"] = array();

	// retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

		$ta_item = array(
			"id" => $id,
			"netid" => $netid,
			"name" => $name,
			"added_by_id" => $added_by_id,
			"add_date" => $add_date,
			"active" => $active
		);

		// Add it to our overall results
		array_push($ta_array["records"], $ta_item);
	}

	// Spit it out!
	echo json_encode($ta_array);

}
else{
    echo json_encode(
        array("message" => "No TAs found.")	// This is how you send back an error message
    );
}

?>
