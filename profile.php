<?php
include ('session.php');
//include('timeSession.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Da, we...</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="menu">
<ul>
    <li>
        <a href="#">Databases</a>
        <ul>
            <li><a href="#">Create new</a></li>
            <li><a href="#">Database1</a></li>
            <li><a href="#">Database2</a></li>
        </ul>
    </li>
    <li>
        <a href="#">Tables</a>
        <ul>
            <li><a href="."><?php ?>Create new</a></li>
            <li><a href="#">Table1</a></li>
            <li><a href="#">Table2</a></li>
        </ul>
    </li>

    <li><a href="#">SQL Query</a></li>

    <li>
        <a href="#"><b><?php echo $uname; ?></b></a>
        <ul>
            <li><a href="#">User Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </li>
</ul>
    <hr>
</div>

<div class="centerBlock">
    <?php include('content/user_settings.php'); ?>

</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>
</html>