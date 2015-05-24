<?php include('header.php');

if(isset($_GET['dropTable'])) {
    $query = "drop table " . $_GET['dropTable'];
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        header('Location: ./create_table.php'); // Redirecting To Home Page
    }
}

include('footer.php'); ?>