<?php 

require("./sqlcon.php");


$id = $_GET["id"];
// $orderID = $_GET['orderID'];
$json = array();

$sql="SELECT * FROM materials WHERE ID=".$id;
$result=mysqli_query($connection,$sql);
// Associative array
    while($item=mysqli_fetch_assoc($result)) {
        $sqlPrice = "SELECT * FROM prices WHERE `MaterialID`=".$id;
        $priceResult= mysqli_query($connection,$sqlPrice);
        $priceItem = mysqli_fetch_assoc($priceResult);
        $item["Price"] = $priceItem["Price"];
        $json= $item;
        // $json[] = $item;
    
}
// var_dump($json);

echo json_encode($json);
?>