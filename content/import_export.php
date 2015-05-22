<?php include('header.php');

if(isset($_FILES['file']['name'])){
//    echo "Upload: " . $_FILES['file']['name'] . "<br />";
    $query="select load_csv('".$_FILES['file']['name'].") from dual";
    $stid = oci_parse($conn, $query);
    $execute=oci_execute($stid);

    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        echo "<h2>Table <b>".$_REQUEST['tableName']."</b> created successfully</h2>";
    }
}

   echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data">
       <input type="file" name="file" id="file" /><br /><br />
       <button type="submit">Upload</button>
    </form>';

 include('footer.php')?>