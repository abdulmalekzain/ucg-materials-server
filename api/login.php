<?php 

require("./sqlcon.php");

$username = $_GET['username'];
$password = $_GET['password'];

$json = array();

$sql="SELECT * FROM users WHERE `username` = '".$username."'";
$result=mysqli_query($connection,$sql);
$item=mysqli_fetch_assoc($result);

if(password_verify($password,$item["Password"])) {
    $json= $item;
    echo json_encode($json);
} else {
    echo "0";
}
?>