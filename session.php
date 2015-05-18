<?php
    if ($conn==null){
        $conn = oci_connect('stud40', 'tfuckingw', '85.122.23.37/XE');
        // $conn2 = oci_connect($, 'tfuckingw', '85.122.23.37/XE');
    }
    if (!$conn) {
        $e = oci_error();
        echo 'Eroare la conectare: ' . $e['message'];
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }
    session_start();
    $user_check = $_SESSION['login_user'];

    $query = 'select uname from users where uname=\'' . $user_check . '\'';
    $stid = oci_parse($conn, $query);

    oci_define_by_name($stid, 'UNAME', $uname);

    $execute = oci_execute($stid);

    if (!$execute) {
        $er = oci_error($stid);
        echo $er['message'];
    }
    if (!oci_fetch($stid)) {
        echo "Nume de utilizator sau parola incorecta!";
    } else {
        $login_session = $uname;
    }

    if (!isset($login_session)) {
        oci_free_statement($stid);
        oci_close($conn);
        header('Location: ../index.php'); // Redirecting To Home Page
    }

?>