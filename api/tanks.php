<?php 

require("./sqlcon.php");

// $orderID = $_GET['orderID'];
$json = array();

$sql="SELECT * FROM tanks";
$result=mysqli_query($connection,$sql);
// Associative array
    while($item=mysqli_fetch_assoc($result)) {
        $sqlMat = "SELECT * FROM materials WHERE `ID` =".$item['ContentsID'];
        $resultMats = mysqli_query($connection,$sqlMat);
        $mats = mysqli_fetch_assoc($resultMats);
        $item['Contents'] = $mats;
        unset($item['ContentsID']);
        $json[]= $item;
        // $json[] = $item;
    
}
// var_dump($json);

echo json_encode($json);
?>