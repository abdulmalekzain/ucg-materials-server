<?php


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");


$connection = mysqli_connect("localhost","root","","epiz_24881924_lukezain");
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($connection,"set names utf8");


?>