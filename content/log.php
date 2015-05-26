<?php include('header.php');

if(isset($_POST['exportXML'])){

}
echo "<table border='1'>\n";
$query="SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name='TABLE_LOG' ORDER BY COLUMN_ID";
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
echo "<tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        echo "    <td><b>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</b></td>\n";
    }
}
echo "</tr>\n";
$query='SELECT * FROM system.table_log';
$stid = oci_parse($conn_sys, $query);
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
//    echo "<td>
//                <a href='edit_row.php?row=".$row['R']."&tableName=".$_GET['tableName']."'>Edit</a> /
//                <a href='delete_row.php?row=".$row['R']."&tableName=".$_GET['tableName']."'>Delete</a>
//            </td>";

    echo "</tr>\n";
}
echo "</table>\n";

echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">
       <input type="hidden" name="exportXML" value="exportXML" />
      <button type="submit">Export to XML</button>
   </form>';

include('footer.php'); ?>