<?php 

require("./sqlcon.php");

$json = array();

$sql = "SELECT `Date` FROM log WHERE `TankID` =".$_GET['id'] ." ORDER BY `Date` DESC";
$dates = array();

$result=mysqli_query($connection,$sql);
while($item=mysqli_fetch_assoc($result)) {
    $stuff = explode("-",$item["Date"]);
    $dates[]= $stuff[0] ."-".$stuff[1];
}



$datesUnique= array_unique($dates);
// var_dump($dates);

echo json_encode($dates);
?>