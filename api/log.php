<?php 

require("./sqlcon.php");

if(isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = false;
}
if(isset($_GET['tank'])) {
    $tankID = $_GET['tank'];
} else {
    $tankID = false;
}

if(isset($_GET['material'])) {
    $materialID = $_GET['material'];
} else {
    $materialID = false;
}

if(isset($_GET['target'])) {
    $targetID = $_GET['target'];
} else {
    $targetID = false;
}

if(isset($_GET['recp'])) {
    $recpID = $_GET['recp'];
} else {
    $recpID = false;
}

$json = array();

$sql = "SELECT * FROM log";

if($tankID || $materialID || $targetID || $recpID || $date) {
    $sql .= " WHERE ";
}

if($tankID) {
    $sql .= "`TankID` =".$tankID;
    if($materialID || $targetID || $recpID) {
        $sql .= " && ";
    }
}

if($materialID) {
    $sql .= "`MaterialID` =".$materialID;
    if($targetID || $recpID) {
        $sql .= " && ";
    }
}

if($targetID) {
    $sql .= "`TargetID` =".$targetID;
    if($recpID) {
        $sql .= " && ";
    }
}

if($recpID) {
    $sql .= "`RecipientID` =".$recpID;
}

if($date) {
    if($tankID || $materialID || $targetID || $recpID) {
    $sql .= " &&";
    }
    $sql .= " `Date` LIKE '%".$date."%'";
}

$sql.= " ORDER BY `Date` DESC";


// echo $sql;

$result=mysqli_query($connection,$sql);
while($item=mysqli_fetch_assoc($result)) {
    $sqlRec = "SELECT * FROM `employees` WHERE `ID` =".$item["RecipientID"];
    $resultRec = mysqli_query($connection,$sqlRec);
    $itemRec= mysqli_fetch_assoc($resultRec);
    $item["Recipient"] = $itemRec["Name"];

    $sqlTar = "SELECT * FROM `targets` WHERE `ID` =".$item["TargetID"];
    $resultTar = mysqli_query($connection,$sqlTar);
    $itemTar= mysqli_fetch_assoc($resultTar);
    $item["Target"] = $itemTar["Name"];

    $json[]= $item;
}




// var_dump($json);
echo json_encode($json);
?>