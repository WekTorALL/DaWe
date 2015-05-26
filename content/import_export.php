<?php include('header.php');

if(isset($_FILES['file']['name'])){
//    echo "Upload: " . $_FILES['file']['name'] . "<br />";
    $query="BEGIN inchirieri_administration.load_csv('CSV', '".$_FILES['file']['name']."'); END;";
    $stid = oci_parse($conn, $query);
    $execute=oci_execute($stid);

    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        echo "<h2>Table <b>".$_REQUEST['tableName']."</b> created successfully</h2>";
    }
}elseif(isset($_REQUEST['export'])){
   $query="begin export_csv; end;";
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
    echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">
       <input type="hidden" name="export" value="export" />
      <button type="submit">Export to CSV</button>
   </form>';
    echo '<form method="post" action="upload.php" enctype="multipart/form-data">
       <input type="file" name="fileToUpload" id="fileToUpload">
       <button type="submit">Run script</button>
    </form>';

 include('footer.php')?>