<?php include('header.php');



echo "<table border='1'>\n";
$query="SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='".$_GET['tableName']."'";
$stid = oci_parse($conn, $query);
oci_execute($stid);
echo "<tr>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    foreach ($row as $item) {
        echo "    <td><b>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</b></td>\n";
    }
}
echo "<td><b>Action</b></td>";
echo "</tr>\n";
$query='SELECT rowidtochar(rowid) r, a.* FROM '.$_GET['tableName'].' a';
echo $query;
$stid = oci_parse($conn, $query);
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    $row_id=false;
    foreach ($row as $item) {
        if($row_id==true){
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        $row_id=true;
    }
    echo "<td>
                <a href='edit_row.php?row=".$row['R']."&tableName=".$_GET['tableName']."'>Edit</a> /
                <a href='delete_row.php?row=".$row['R']."&tableName=".$_GET['tableName']."'>Delete</a>
            </td>";

    echo "</tr>\n";
}
echo "</table>\n";


echo "<form action='add_row.php'>
<input type='hidden' name='tableName' value='".$_GET['tableName']."' />
<button type=\"submit\">Add new row</button>
</form>";
echo "<form action='drop_table.php'>
<input type='hidden' name='dropTable' value='".$_GET['tableName']."' />
<button type=\"submit\">Drop table</button>
</form>";

echo "<form action='table_structure.php'>
<input type='hidden' name='tableName' value='".$_GET['tableName']."' />
<button type=\"submit\">Table structure</button>
</form>";
include('footer.php'); ?>