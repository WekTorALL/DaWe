<?php
/**
 * Created by PhpStorm.
 * User: wektorall
 * Date: 4/1/15
 * Time: 5:07 PM
 */

if (isset($_SESSION['most_recent_activity']) &&
    (time() -   $_SESSION['most_recent_activity'] > 5)) {

    //600 seconds = 10 minutes
    session_destroy();
    session_unset();

}
$_SESSION['most_recent_activity'] = time(); // the start of the session.

?>