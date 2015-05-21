<?php include('header.php');

if (isset($_GET['tableName']) && !empty($_REQUEST['columnName'])) {
    $query='Alter table '.$_GET['tableName'].' add '.$_REQUEST['columnName'].' '.$_REQUEST['type'];
    if(!empty($_REQUEST['length'])){
        $query.='('.$_REQUEST['length'].')';
    }
    if(empty($_REQUEST['setNull'])){
        $query.=' not null ';
    }
    echo $query;
    $stid = oci_parse($conn, $query);
    $execute = oci_execute($stid);
    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>' . $er['message'] . '</h2>';
    } else {
        if(!empty($_REQUEST['primaryKey'])){
            $query2=' alter table '.$_GET['tableName'].' drop primary key';
            $stid2 = oci_parse($conn, $query2);
            $execute2 = oci_execute($stid2);
            $query='alter table '.$_GET['tableName'].' add CONSTRAINT ' . $_GET['tableName'] . '_pk PRIMARY KEY ('.$_REQUEST['columnName'].')';
            $stid = oci_parse($conn, $query);
            $execute = oci_execute($stid);
            if (!$execute) {
                $er = oci_error($stid);
                echo '<h2>' . $er['message'] . '</h2>';
            }else{
                echo "<h2>Table <b>" . $_GET['tableName'] . "</b> updated successfully</h2>";
            }
        }else{
            echo "<h2>Table <b>" . $_GET['tableName'] . "</b> updated successfully</h2>";
        }
    }
}else{
    echo "<form action=".$_SERVER['PHP_SELF']."?tableName=".$_GET['tableName']." method=\"post\">";
    echo "<div class=\"column\">
            <label for=\"name\">Column name:</label>
            <input type=\"text\" name=\"columnName\"/>
            <label for=\"name\">Column type:</label>
            <select name=\"type\">
                <option value=\"number\">Number</option>
                <option value=\"integer\">Integer</option>
                <option value=\"char\">Char</option>
                <option value=\"varchar2\">Varchar2</option>
                <option value=\"Date\">Date</option>
            </select>
            <label for=\"name\">Length:</label>
            <input type=\"text\" name=\"length\"/>
            <label for=\"name\">NULL<br></label>
            <input type=\"checkbox\" name=\"setNull\">
            <label for=\"name\">Primary key<br></label>
            <input type=\"checkbox\" name=\"primaryKey\">
            </div>";
    echo "<button type=\"submit\">Add</button>
            </form>";
}

include('footer.php')?>