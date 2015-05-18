<?php

$conn = oci_connect('stud40', 'tfuckingw', '85.122.23.37/XE');

if (!$conn) {
    $e = oci_error();
    echo 'Eroare la conectare: '.$e['message'];
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

//$stid = oci_parse($conn, 'Create table myTable(col1 number, col2 varchar2(50))');
//$query='insert into users values(\''.$_REQUEST["name"].'\',\''.$_REQUEST["password"].'\',\''.$_REQUEST["email"].'\',0)';
$query='insert into users values(:name_bv,:pass_bv,:email_bv,0)';

$stid = oci_parse($conn, $query);
oci_bind_by_name($stid,":name_bv",$_REQUEST["name"]);
oci_bind_by_name($stid,":pass_bv",$_REQUEST["password"]);
oci_bind_by_name($stid,":email_bv",$_REQUEST["email"]);

$execute=oci_execute($stid);

if (!$execute) {
    $er = oci_error($stid);
    echo $er['message'];
}
if(!oci_num_rows($stid)){
    echo "Eroare";
}else{
    echo "Inregistrare cu succes!";
}

oci_free_statement($stid);
oci_close($conn);

?>