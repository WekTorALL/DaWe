<?php
include ('../session.php');
//include('timeSession.php');

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

    <li><a href="#">SQL Query</a></li>

    <li>
        <a href="#"><b><?php echo $uname; ?></b></a>
        <ul>
            <li><a href="#">User Settings</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </li>
</ul>
    <hr>
</div>

<div class="centerBlock">

