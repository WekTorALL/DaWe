<?php
include ('../session.php');
//include('timeSession.php');
//error_reporting(0);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Da, we...</title>
    <link href="../css/styles.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="menu">
<ul>

    <li>
        <a href="#">Tables</a>
        <ul>
            <li><a href="create_table.php">Create new</a></li>
            <?php
            $stid = oci_parse($conn, 'SELECT object_name FROM user_objects where object_type=\'TABLE\'');
            oci_execute($stid);
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
                foreach ($row as $item) {
                    echo '<li><a href="table_data.php?tableName='.$item.'">'.$item.'</a></li>';
                }
            }
            ?>
        </ul>
    </li>

    <li><a href="sql_query.php">SQL Query</a></li>
    <li><a href="import_export.php">Import/Export CSV</a></li>

    <li>
        <a href="#"><b><?php echo $uname; ?></b></a>
        <ul>
            <li><a href="user_settings.php">User Settings</a></li>
            <?php

                $query = 'select * from users where uname=\'' . $uname . '\'';
                $stid = oci_parse($conn_sys, $query);
                $execute = oci_execute($stid);
                if (!$execute) {
                    $er = oci_error($stid);
                    echo $er['message'];
                }
                while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    if ($row['ISADMIN'] == 1) {
                        echo '<li><a href="admin_users_management.php">Manage Users</a></li>';
                    }
                }


            ?>
            <li><a href="log.php">History</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </li>
</ul>
    <hr>
</div>

<div class="centerBlock">

