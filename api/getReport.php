<?php 

require("./sqlcon.php");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$json = array();

if($request->targetID >0) {
  $targetSearch = $request->targetID;
}


// {"from":"2020-01-22T13:25:34.905+02:00",
//   "to":"2020-02-22T13:25:34.906+02:00"
// }

$sql= 'SELECT * FROM log WHERE ';

if(isset($targetSearch)) {
  if(is_array($targetSearch)) {
    $sql.= 'TargetID IN (';
    foreach($targetSearch as $key => $value) {
      if($key+1<count($targetSearch)) {
        $sql.= $value.',';
      } else {
        $sql.= $value;
      }
    }
    $sql.= ')';
  } else {
    $sql.= '`TargetID` = '.$targetSearch;
  }
  $sql.= ' && ';
}

    $sql.= 'Date BETWEEN "' . $request->from . '" AND  "' . $request->to .'" ORDER by Date ASC';
    // var_dump($sql);
    $result=mysqli_query($connection,$sql);
    while($item=mysqli_fetch_assoc($result)) {
      // var_dump($item);
      $sqlEmp = "SELECT * FROM employees WHERE `ID` =".$item['RecipientID'];
      $resultEmps = mysqli_query($connection,$sqlEmp);
      $emp = mysqli_fetch_assoc($resultEmps);
      $item['Employee'] = $emp;
      unset($item['RecipientID']);

      $sqlEmp = "SELECT * FROM materials WHERE `ID` =".$item['MaterialID'];
      $resultEmps = mysqli_query($connection,$sqlEmp);
      $emp = mysqli_fetch_assoc($resultEmps);
      $item['Material'] = $emp;
      unset($item['MaterialID']);

      $sqlTarget = "SELECT * FROM targets WHERE `ID` =".$item['TargetID'];
      $resultTarget = mysqli_query($connection,$sqlTarget);
      $target = mysqli_fetch_assoc($resultTarget);
      $item['Target'] = $target;
      unset($item['TargetID']);

      $sqlEmp = "SELECT * FROM tanks WHERE `ID` =".$item['TankID'];
      $resultEmps = mysqli_query($connection,$sqlEmp);
      $emp = mysqli_fetch_assoc($resultEmps);
      $item['Tank'] = $emp;
      unset($item['TankID']);

      $json[]= $item;

    } 
    echo json_encode($json);

   
?>