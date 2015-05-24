<?php include('header.php');

$rec_limit = 20;

echo "<table border='1'>\n";
$query="SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='".$_GET['tableName']."' ORDER BY COLUMN_ID";
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

$stid = oci_parse($conn, "SELECT COUNT(*) AS NUMBER_OF_ROWS FROM ".$_GET['tableName']);
oci_define_by_name($stid, 'NUMBER_OF_ROWS', $number_of_rows);
oci_execute($stid);
oci_fetch($stid);
$rec_count = $number_of_rows;

if( isset($_GET{'page'} ) )
{
    $page = $_GET{'page'} + 1;
    $offset = $rec_limit * $page ;
}
else
{
    $page = 0;
    $offset = 0;
}

$left_rec = $rec_count - ($page * $rec_limit);

$query="SELECT rowidtochar(rowid) r, a.* FROM ".$_GET['tableName']." a OFFSET " . $offset . " ROWS FETCH NEXT "  . $rec_limit . " ROWS ONLY";
// echo $query;
$stid = oci_parse($conn, $query);
oci_execute($stid);

if( $rec_count <= $rec_limit)
{
    goto exit_if;
}
else if( $left_rec < $rec_limit )
{
    $last = $page - 2;
    echo "<a class=\"prev_next\" href=\"" . $_SERVER['PHP_SELF'] . "?page=$last&tableName=".$_GET['tableName']."\"><< Previous Page</a>";
}
else if( $page > 0 )
{
    $last = $page - 2;
    echo "<a class=\"prev_next\" href=\"" . $_SERVER['PHP_SELF'] . "?page=$last&tableName=".$_GET['tableName']."\"><< Previous Page</a> | ";
    echo "<a class=\"prev_next\" href=\"" . $_SERVER['PHP_SELF'] . "?page=$page&tableName=".$_GET['tableName']."\">Next Page >></a>";
}
else if( $page == 0 )
{
    echo "<a class=\"prev_next\" href=\"" . $_SERVER['PHP_SELF'] . "?page=$page&tableName=".$_GET['tableName']."\">Next Page >></a>";
}

exit_if:

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