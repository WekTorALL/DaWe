<?php include('header.php');

$query='SELECT object_name FROM user_objects where object_type=\'TABLE\'';
echo $query;
$stid = oci_parse($conn, $query);
oci_execute($stid);

// $query='select column_name from user_tab_columns';

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";

include('footer.php'); ?>