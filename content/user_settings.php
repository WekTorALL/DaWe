<<<<<<< HEAD

=======
<h2>Change password</h2>
>>>>>>> origin/master
<?php
include('header.php');

if (!empty($_POST['oldPassword']) && !empty($_POST['newPass1']) && !empty($_POST['newPass2'])) {

    $oldPassword = $_POST['oldPassword'];
    $newPass1 = $_POST['newPass1'];
    $newPass2 = $_POST['newPass2'];

    if ($oldPassword == $upass) {
        if ($newPass1 == $newPass2) {
            $querychange = "UPDATE users SET upassword='" . $newPass1 . "' WHERE uname='" . $uname . "'";
<<<<<<< HEAD
            $query = 'alter user C##'.$uname.' identified by '.$newPass1;
            echo $querychange."\n";
            echo $query;
            $stid = oci_parse($conn_sys, $querychange);
=======
            echo $querychange;
            $stid = oci_parse($conn, $querychange);
>>>>>>> origin/master
            $execute = oci_execute($stid);

            if (!$execute) {
                $er = oci_error($stid);
                echo '<h2>' . $er['message'] . '</h2>';
            } else {
<<<<<<< HEAD
                $stid = oci_parse($conn_sys, $query);
                $execute = oci_execute($stid);
                if (!$execute) {
                    $er = oci_error($stid);
                    echo '<h2>' . $er['message'] . '</h2>';
                }else {
                    header('Location: ../logout.php');
                }
            }
        } else
            echo "New Pass doesn't match";
=======
                echo "Your pass has benn changed.<a href='index.php'>Return</a> to the main page";
            }
        } else
            echo "New Pass don't match";
>>>>>>> origin/master

    } else{
        echo "Old Pass doesn't match";
    }
} else {

    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
        <div>
            <label for="name">Old password:</label>
            <input type="text" name="oldPassword"/>

            <label for="name">New Password:</label>
            <input type="text" name="newPass1"/>

            <label for="name">Repeat New Password:</label>
            <input type="text" name="newPass2"/>
        </div>
        <button type="submit">Change</button>
    </form>';


}
include('footer.php'); ?>

