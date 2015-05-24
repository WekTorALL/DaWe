<?php
$conn_sys = oci_connect('system', 'system', 'localhost/orcl');
if (!$conn_sys) {
    $e = oci_error();
    echo 'Eroare la conectare: '.$e['message'];
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$query='insert into users values(:name_bv,:pass_bv,:email_bv,0)';
$create_user='CREATE USER C##' . $_REQUEST["name"] . ' IDENTIFIED BY ' . $_REQUEST["password"];
$user_privileges='GRANT ALL PRIVILEGES TO C##' . $_REQUEST["name"];

$stid = oci_parse($conn_sys, $query);
$stid2 = oci_parse($conn_sys, $create_user);
$stid3 = oci_parse($conn_sys, $user_privileges);

oci_bind_by_name($stid,":name_bv",$_REQUEST["name"]);
oci_bind_by_name($stid,":pass_bv",$_REQUEST["password"]);
oci_bind_by_name($stid,":email_bv",$_REQUEST["email"]);

$execute=oci_execute($stid);
$execute2=oci_execute($stid2);
$execute3=oci_execute($stid3);

if (!$execute) {
    $er = oci_error($stid);
    echo $er['message'];
// }
// if(!oci_num_rows($stid)){
//     echo "Eroare";
}else{
    header('Location: index.php');
}
oci_free_statement($stid);
oci_free_statement($stid2);
oci_free_statement($stid3);

oci_close($conn_sys);
?>