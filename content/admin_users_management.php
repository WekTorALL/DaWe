<?php
/**
 * Created by PhpStorm.
 * User: Cody
 * Date: 18.05.2015
 * Time: 23:34
 */

 include('header.php');

echo "<table border='1'>\n";
$query="SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='USERS'";

$stid = oci_parse($conn, $query);
oci_execute($stid);
echo "<tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        echo "    <td><b>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "<b></td>\n";
    }
}



$query='SELECT * FROM USERS';
$stid = oci_parse($conn, $query);
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }

}
echo "</table>\n";
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="centerBlock">
        <div align="center">
            <h3>Manage Users</h3>
        </div>
        <br>
        <div align="center" >
            <label for="user_manage">Username:</label>
            <input type="text" name="user_manage"/>
        </div>
        <div align="center">
            <label for="user_manage_check">Verify username:</label>
            <input type="text" name="user_manage_check">
        </div>
        <div align="center">
            <input type="checkbox" name="deleteUser">Delete
            <input type="checkbox" name="promoteUser">Promote
        </div>
    </div>
</form>


<?php
include('footer.php');
?>

