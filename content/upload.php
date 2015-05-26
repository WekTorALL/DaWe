<?php include('header.php');

$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        echo file_get_contents($target_file);
        $stid = oci_parse($conn, file_get_contents($target_file));
        $execute=oci_execute($stid);

        if (!$execute) {
            $er = oci_error($stid);
            echo '<h2>'.$er['message'].'</h2>';
        }else{
            echo "<h2>Script loaded!</h2>";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

include('footer.php') ?>