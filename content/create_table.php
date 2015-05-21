<?php
include('header.php');
session_start();
$completed=$_SESSION['completed'];
if ($completed==true) {
    $_SESSION['completed']=false;
    $query = 'create table ' . $_REQUEST['tableName'] . ' (';

    for ($i = 0; $i < $_REQUEST['nrOfColumns']; $i++) {
        $column .= $_REQUEST['columnName'][$i] . ' ' . $_REQUEST['type'][$i];
        if (!empty($_REQUEST['length'][$i]) && is_numeric($_REQUEST['length'][$i])) {
            $column .= '(' . $_REQUEST['length'][$i] . ')';
        }
         foreach ($_POST['setNull'] as $value) {
             $set=false;
            if($i==$value && $set==false){
                $column .= ' not null ';
                $set=true;
            }
        }
        if (!($i == ($_REQUEST['nrOfColumns'])-1)) {
            $column .= ', ';
        } else {
            $column .=' ';
        }
    }
    $pkExists=false;

    $pk=', CONSTRAINT ' . $_REQUEST['tableName'] . '_pk PRIMARY KEY (';
    for ($i = 0; $i < $_REQUEST['nrOfColumns']; $i++) {
        foreach ($_POST['primaryKey'] as $value) {
            if ($i == $value) {
                $pkExists=true;
                $pk .= $_REQUEST['columnName'][$i].',';
            }
        }
    }
    $pk=substr($pk, 0, -1);
    $pk.=')';
    $query .= $column;
    if($pkExists){
        $query.=$pk;
    }
    $query.=')';
    $stid = oci_parse($conn, $query);
    $execute=oci_execute($stid);

    if (!$execute) {
        $er = oci_error($stid);
        echo '<h2>'.$er['message'].'</h2>';
    }else{
        echo "<h2>Table <b>".$_REQUEST['tableName']."</b> created successfully</h2>";
    }
}else if (!empty($_REQUEST['tableName']) && !empty($_REQUEST['nrOfColumns']) && is_numeric($_REQUEST['nrOfColumns'])) {
//    echo $uname;
    $_SESSION['completed'] = true;
    echo "<form action=".$_SERVER['PHP_SELF']." method=\"post\">
        <div>
            <label for=\"name\">Table name:</label>
            <input type=\"text\" name=\"tableName\"/ value=".$_REQUEST['tableName'].">

            <label for=\"name\">#of columns:</label>
            <input type=\"text\" name=\"nrOfColumns\"/ value=".$_REQUEST['nrOfColumns'].">
        </div>
        ";
    for ($i = 0; $i < $_REQUEST['nrOfColumns']; $i++) {
        echo "<div class=\"column\">
            <label for=\"name\">Column name:</label>
            <input type=\"text\" name=\"columnName[]\"/>
            <label for=\"name\">Column type:</label>
            <select name=\"type[]\">
                <option value=\"number\">Number</option>
                <option value=\"integer\">Integer</option>
                <option value=\"char\">Char</option>
                <option value=\"varchar2\">Varchar2</option>
                <option value=\"Date\">Date</option>
            </select>
            <label for=\"name\">Length:</label>
            <input type=\"text\" name=\"length[]\"/>
            <label for=\"name\">Not NULL<br></label>
            <input type=\"checkbox\" value='$i' name=\"setNull[]\">
            <label for=\"name\">Primary key<br></label>
            <input type=\"checkbox\" value='$i' name=\"primaryKey[]\">
            </div>
            ";
    }
    echo "<button type=\"submit\">Create</button>
            </form>";

} else {
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div>
            <label for="name">Table name:</label>
            <input type="text" name="tableName"/>

            <label for="name">#of columns:</label>
            <input type="text" name="nrOfColumns"/>
        </div>
        <button type="submit">Continue</button>
    </form>

<?php }
include('footer.php');
?>

