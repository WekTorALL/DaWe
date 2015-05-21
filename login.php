<?php
session_start(); // Starting Session
if ((isset($_REQUEST['name']) && isset($_REQUEST['password']))) {
    $conn = oci_connect('system', 'student', 'localhost/orcl');
    if (!$conn) {
        $e = oci_error();
        echo 'Eroare la conectare: ' . $e['message'];
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        echo "Nume de utilizator sau parola incorecta!!!";
    } else {
        $_SESSION['login_user']=$_REQUEST['name']; // Initializing Session
        $_SESSION['login_password']=$_REQUEST['password'];
        header('Location: header.php');
    }
//    oci_free_statement($stid);
    oci_close($conn);
}
?>