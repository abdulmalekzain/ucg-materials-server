<?php 

require("./sqlcon.php");

// $orderID = $_GET['orderID'];
$json = array();

$sql="SELECT * FROM targets";
$result=mysqli_query($connection,$sql);
// Associative array
    while($item=mysqli_fetch_assoc($result)) {
       
        $json[]= $item;
        // $json[] = $item;
    
}
// var_dump($json);

echo json_encode($json);
?>