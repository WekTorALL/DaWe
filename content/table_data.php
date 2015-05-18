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
$query='SELECT * FROM '.$_GET['tableName'];
echo $query;
$stid = oci_parse($conn, $query);
oci_execute($stid);
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "<td>$row</td>";
    echo "</tr>\n";
}
echo "</table>\n";

include('footer.php'); ?>