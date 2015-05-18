<?php
session_start();

    if ($conn==null){
        $conn = oci_connect($_SESSION['login_user'], $_SESSION['login_password'], '85.122.23.37/XE');
    }
    if (!$conn) {
        $e = oci_error();
        echo 'Eroare la conectare: ' . $e['message'];
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        echo "Nume de utilizator sau parola incorecta!";
    } else {
        $user_check = $_SESSION['login_user'];
        $uname=$user_check;
        $login_session = $uname;
    }
    if (!isset($login_session)) {
        header('Location: ../index.php'); // Redirecting To Home Page
    }

?>