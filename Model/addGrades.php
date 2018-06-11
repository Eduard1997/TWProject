<?php
session_start();
// $var = file_get_contents('php://input');
// $json_obj = json_decode($var);
// echo $var['nume'];
$servername = "localhost";
$username = "root";  //your user name for php my admin if in local most probaly it will be "root"
$password = "";  //password probably it will be empty
$databasename = "webstudy"; //Your db name
// Create connection
$conn = new mysqli($servername, $username, $password,$databasename);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
switch ($_SERVER['REQUEST_METHOD']){
  case "POST":
  $var = file_get_contents('php://input');
  // echo $var;

  $saptamana= $_SESSION['saptamana'];
  $chestii = explode("\n", $var);
$i=0;
while($i<count($chestii))
{
    $nume= $chestii[$i+0];
    $sql="select Username from studentUsers where Name='$nume'";
    $resule=mysqli_query($conn, $sql);
    if($rez=mysqli_fetch_assoc($resule)){
      $userStud=$rez["Username"];
      echo $userStud;
      $query = "select StudentUser from attendance where StudentUser = '$userStud' and Week = '$saptamana'";
      $result = mysqli_query($conn, $query);
      $lines = mysqli_num_rows($result);
      if($lines < 1){
        $insert="INSERT INTO attendance(StudentUser,Week) VALUES ('$userStud','$saptamana')";
        mysqli_query($conn, $insert);
      }

    }
    else {
      $userStud='null';
    }


    if(!empty($chestii[$i+1]||$chestii[$i+1]==='0'))
    {
      $prezenta= $chestii[$i+1];
      $updateprez="UPDATE attendance SET Presence='$prezenta' where StudentUser='$userStud' and Week = '$saptamana'";
      mysqli_query($conn, $updateprez);
    }

    if(!empty($chestii[$i+2]||$chestii[$i+2]==='0'))
    {
      $activitate= $chestii[$i+2];
      $updateact="UPDATE attendance SET Activity='$activitate' where StudentUser='$userStud' and Week = '$saptamana'";
      mysqli_query($conn, $updateact);
    }


    if(!empty($chestii[$i+3])||$chestii[$i+3]==='0')
    {
      $test= $chestii[$i+3];
      $query = "select StudentUser from test where StudentUser = '$userStud' and Week = '$saptamana'";
      $result = mysqli_query($conn, $query);
      $lines = mysqli_num_rows($result);
      if($lines < 1){
        $insert="INSERT INTO test(StudentUser,Week,Grade) VALUES ('$userStud','$saptamana','$test')";
        mysqli_query($conn, $insert);
      }
      else {
        $updateact="UPDATE test SET Grade='$test' where StudentUser='$userStud'and Week = '$saptamana";
        mysqli_query($conn, $updateact);
      }

    }

    if(!empty($chestii[$i+4])||$chestii[$i+4]==='0')
    {
      $proiect= $chestii[$i+4];
      $query = "select StudentUser from project where StudentUser = '$userStud' and Week = '$saptamana'";
      $result = mysqli_query($conn, $query);
      $lines = mysqli_num_rows($result);
      if($lines < 1){
        $insert="INSERT INTO project(StudentUser,Week,Grade) VALUES ('$userStud','$saptamana','$proiect')";
        mysqli_query($conn, $insert);
      }
      else {
        $updateact="UPDATE project SET Grade='$proiect' where StudentUser='$userStud'and Week = '$saptamana";
        mysqli_query($conn, $updateact);
      }
    }

    if(!empty($chestii[$i+5])||$chestii[$i+5]==='0')
    {
      $total= $chestii[$i+5];
      $query = "select grades from totalgrades where StudentUser = '$userStud' ";
      $result = mysqli_query($conn, $query);
      $lines = mysqli_num_rows($result);
      $total1 = mysqli_fetch_assoc($result);
      $result1 = $total1['grades'];

      $query2 = "select Commits from gitcomm where User = '$userStud'";
      $result2 = mysqli_query($conn, $query2);
      $github = mysqli_fetch_assoc($result2);
      $git = $github['Commits'];
      $tottot=$result1+($prezenta*0.1)+($activitate*0.1)+($test*0.2)+($proiect*0.4);

      $tot= $total + $result1;

      if($lines < 1){
        $insert="INSERT INTO totalgrades(StudentUser) VALUES ('$userStud')";
        mysqli_query($conn, $insert);
        $updateact="UPDATE totalgrades SET grades='$tottot' where StudentUser='$userStud'";
        mysqli_query($conn, $updateact);
      }
      else {
        $updateact="UPDATE totalgrades SET grades='$tottot' where StudentUser='$userStud'";
        mysqli_query($conn, $updateact);
      }
    }

$i=$i+6;
  }

}
$conn->close();

?>
