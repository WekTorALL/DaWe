<?php include('header.php');

if(isset($_REQUEST['row']) && isset($_GET['tableName'])) {
    $query = "delete from  " . $_GET['tableName'] . " where rowid='".$_GET['row']."'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        header('Location: ./table_data.php?tableName='.$_GET['tableName']); // Redirecting To Home Page
    }
}

include('footer.php'); ?>