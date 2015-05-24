<?php
include('header.php');

if(isset($_REQUEST['newValues']) && isset($_GET['tableName'])){
    $query = "SELECT COLUMN_NAME, DATA_TYPE FROM USER_TAB_COLUMNS WHERE table_name ='" . $_GET['tableName'] . "'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $query='insert into '.$_GET["tableName"].' values( ';
    $i=0;
    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        $newValue=$_REQUEST['newValues'][$i++];
        if(strcmp($newValue,'')!==0) {
            if($row['DATA_TYPE']==='VARCHAR2' || $row['DATA_TYPE']=='CHAR' || $row['DATA_TYPE']=='DATE'){
                $query .= '\'' . $newValue . '\',';
            }else{
                $query .= $newValue . ',';
            }
        }else{
            $query .='NULL,';
        }
    }
    $query=substr($query, 0, -1);
    $query.=')';
    echo $query;
    $stid = oci_parse($conn, $query);
    $execute=oci_execute($stid);
    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        echo "<h2>Table <b>".$_REQUEST['tableName']."</b> updated successfully</h2>";
    }

}else {
    $query = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='" . $_GET['tableName'] . "'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    echo '<form method="post" action="' . $_SERVER['PHP_SELF'] . '?tableName='.$_GET["tableName"].'">';

    echo "<table border='1'>";
    echo "<tr>";
    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
        foreach ($row as $item) {
            echo "    <td><b>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</b></td>\n";
        }
    }
    echo "</tr>";
    $query = "SELECT COLUMN_NAME FROM USER_TAB_COLUMNS WHERE table_name ='" . $_GET['tableName'] . "'";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    $i=1;
    echo "<tr>";
    while ($row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {

        foreach ($row as $item) {
            echo '<td><input size="16" type="text" name="newValues[]" value="' . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . '"></td>';
        }

    }
    echo "</tr>";
    echo "</table>
    <button type=\"submit\">Add</button>
    </form>";
}
include('footer.php');
?>