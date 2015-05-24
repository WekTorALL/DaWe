<?php
/**
 * Created by PhpStorm.
 * User: Cody
 * Date: 21.05.2015
 * Time: 15:34
 */

include('header.php');
session_start();

$query='update USERS set ISADMIN=1 where uname=\''.$_GET['userName'].'\'';
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);


echo "<td><a href='admin_users_management.php'>Manage User Table </a>";


include('footer.php');

?>