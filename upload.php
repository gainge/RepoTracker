<?php


$repoID = $_POST["info"];
$target_dir = "data/";
$extraction_script = $target_dir . "clean_extract.sh";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$fileSize = $_FILES['fileToUpload']['size'];

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    if($fileType != "zip") {
        $uploadOk = 0;
        echo "Please upload a .zip file\n";
    }
    if ($fileSize > 100 * 1000 * 1000) {
        $uploadOk = 0;
        echo "Upload file is too large\n";
    }
}

// If everything went according to plan, we're good!
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        # Extract the file contents to the target directory
        shell_exec($extraction_script . " " . $target_file . " " . $repoID);
        header('Location: /index.php');
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>