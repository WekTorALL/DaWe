<?php include('header.php');

if (isset($_GET['dropColumn']) && isset($_GET['tableName'])) {
    $query = "alter table " . $_GET['tableName'] . " drop column " . $_GET['dropColumn'];
    $stid = oci_parse($conn, $query);
    $execute = oci_execute($stid);
    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>' . $er['message'] . '</h2>';
    } else {
        echo "<h2>Table <b>" . $_REQUEST['tableName'] . "</b> updated successfully</h2>";
    }

}
$query = "SELECT COLUMN_NAME, DATA_TYPE, NULLABLE FROM USER_TAB_COLUMNS WHERE table_name ='" . $_GET['tableName'] . "'";
$stid = oci_parse($conn, $query);
oci_execute($stid);

echo "<table border='1'><th>Column name</th><th>Data type</th><th>Nullable</th><th>Primary Key</th><th>Action</th>";
while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    $query2 = 'SELECT isPrimary(\'' . $_GET['tableName'] . '\', \'' . $row['COLUMN_NAME'] . '\') as pKey FROM dual';
    $stid2 = oci_parse($conn, $query2);

    $execute2 = oci_execute($stid2);
    while ($row2 = oci_fetch_array($stid2, OCI_ASSOC + OCI_RETURN_NULLS)) {
        foreach ($row2 as $item2) {
            echo " <td>" . ($item2 != 0 ? htmlentities('Y', ENT_QUOTES) : "N") . "</td>";
        }
    }

    echo "<td>
                <a href='table_structure.php?dropColumn=" . $row['COLUMN_NAME'] . "&tableName=" . $_GET['tableName'] . "'>Delete</a>
            </td>";

    echo "</tr>\n";
}

echo "</table>\n";

echo "<form action='add_column.php'>
<input type='hidden' name='tableName' value='".$_GET['tableName']."' />
<button type=\"submit\">Add column</button>
</form>";

include('footer.php'); ?>