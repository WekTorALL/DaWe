<?php
/**
 * Created by PhpStorm.
 * User: Cody
 * Date: 18.05.2015
 * Time: 14:12
 */
include('header.php');
session_start();

?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <textarea id="commandTxt" name="command" rows="10" cols="100%" style="overflow-y:scroll"></textarea>
        <textarea readonly id="resultTxt" name="result" rows="10" cols="100%" style="overflow-y:scroll"><?php

            error_reporting(0);

            if (isset($_REQUEST['command']) ) {
//    aici trebuie sa procesez interogarea data

            $query = $_REQUEST['command'];
            $stid = oci_parse($conn, $query);
            echo $query;
            echo "\n";
            $execute = oci_execute($stid);
            if (!$execute) {
                $er = oci_error($stid);
                echo $er['message'];
            }
             else {
                $parsed_lines=0;
                while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    echo "\n";
                    foreach ($row as $item) {
                        echo  ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "  ";
                    }
                    $parsed_lines=$parsed_lines+1;
                }
                 echo "\n\n".$parsed_lines." selected lines.";
             }


}?></textarea>
    <button type="submit">RUN</button>

    </form>

<?php
error_reporting(E_ALL ^ E_NOTICE);

        include('footer.php');

?>