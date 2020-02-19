<?php 

require("./sqlcon.php");

if(isset($_GET['tank'])) {
    $tankID = $_GET['tank'];
} else {
    die();
}

$json = array();

    $sql="SELECT * FROM log WHERE `TankID` =".$tankID." ORDER BY `ID`";
    $result=mysqli_query($connection,$sql);
    while($item=mysqli_fetch_assoc($result)) {
        $sqlEmp = "SELECT * FROM employees WHERE `ID` =".$item['RecipientID'];
        $resultEmps = mysqli_query($connection,$sqlEmp);
        $emp = mysqli_fetch_assoc($resultEmps);
        $item['Employee'] = $emp;
        unset($item['RecipientID']);
        unset($item['MaterialID']);

        $sqlTarget = "SELECT * FROM targets WHERE `ID` =".$item['TargetID'];
        $resultTarget = mysqli_query($connection,$sqlTarget);
        $target = mysqli_fetch_assoc($resultTarget);
        $item['Target'] = $target;
        unset($item['TargetID']);
        unset($item['TankID']);

        $json[]= $item;
    }





echo json_encode($json);
?>