<?php 

require("./sqlcon.php");

if(isset($_GET['tank']) && is_numeric($_GET['tank'])) {
    $tankID = $_GET['tank'];
} else {
    die();
}
    $sql=mysqli_real_escape_string($connection,"SELECT * FROM tanks WHERE `ID` =".$tankID);
    mysqli_query($connection,"set names utf8");
    $result=mysqli_query($connection,$sql);
    if($result->num_rows) {
        $item=mysqli_fetch_assoc($result);

        $sqlMat = "SELECT * FROM materials WHERE `ID` =".$item['ContentsID'];
        $resultMats = mysqli_query($connection,$sqlMat);
    
        $mats = mysqli_fetch_assoc($resultMats);
        $item['Contents'] = $mats;
        unset($item['ContentsID']);
        echo json_encode($item);
    } else {
        echo '0';
    }
   
?>