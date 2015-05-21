<?php
/**
 * Created by PhpStorm.
 * User: Cody
 * Date: 18.05.2015
 * Time: 23:34
 */

 include('header.php');
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<?php
echo "<table border='1'>\n";
$query="SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='USERS' ORDER by column_id";

$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
echo "<tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        echo "    <td><b>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "<b></td>\n";

    }

}
echo "<td><b>Action</b></td>\n";

$query='SELECT rowidtochar(rowid) r, a.* FROM USERS a';
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
//    foreach ($row as $item) {
//        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
//    }
    $row_id=false;
    foreach ($row as $item) {
        if($row_id==true){
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            $user_name=$row['UNAME'];
        }
        $row_id=true;
    }
    echo $user_name;
   echo "<td><a href='delete_user.php?row=".$row['R']."&userName=".$user_name."'>Delete / </a>";
    echo "<a href='promote_user.php?row=".$row['R']."&userName=".$user_name."'> Promote</a></td>";


?>
    </form>


<?php
}
echo "</table>\n";

include('footer.php');
?>

