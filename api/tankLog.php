<?php 

require("./sqlcon.php");

if(isset($_GET['tank'])) {
    $tankID = $_GET['tank'];
} else {
    $tankID = false;
}

$json = array();

if($tankID) {
    $sql="SELECT * FROM tankLog WHERE `TankID` =".$tankID;
} else {
    $sql="SELECT * FROM tankLog";
}
    $result=mysqli_query($connection,$sql);
    while($item=mysqli_fetch_assoc($result)) {
        $json[]= $item;
}





echo json_encode($json);
?>