<?php
/**
 * Created by PhpStorm.
 * User: Cody
 * Date: 21.05.2015
 * Time: 15:34
 */

include('header.php');
session_start();

$query='DROP USER C##'.$_GET['userName'].' CASCADE';
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
echo $query;

$query='delete from USERS where uname=\''.$_GET['userName'].'\'';
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
//echo $query;



echo "<td><a href='admin_users_management.php'>Manage User Table </a>";

include('footer.php');

?>