<?php
// Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';	// How we'll make connections
include_once '../objects/project.php';	// Knows how to manipulate our target model objects

// Instantiate a database and get connection
$database = new Database();
$db = $database->getConnection();

// Initialize a project object with our connection
$project = new Project($db);

// Query projects
$stmt = $project->read();	// TODO: add this crap lol
$num = $stmt->rowCount();

// Check if record was found
if ($num > 0) {
	// Create an array to store the results in
	$projects_array = array();
	$projects_array["records"] = array();	// Not really sure what this is doing lol, but I trust it

	// retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		// extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

		// Create a project model instance
		$project_item = array(
			"id" -> $id,
			"name" -> $name,
			"submission_date" -> $submission_date,
			"description" -> $description
		);

		// Add it to our results
		array_push($projects_array["records"], $project_item);
	}

	echo json_encode($projects_array);
}
else{
    echo json_encode(
        array("message" => "No projects found.")	// This is how you send back an error message 
    );
}


 ?>
