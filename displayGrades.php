<?php
session_start();
include_once 'student.html';
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
$userStud = $_COOKIE['username'];
for($i = 0; $i < 14; $i++){
  $query = "select * from attendance where StudentUser = '$userStud' and Week = '$i'+1";
  $result = mysqli_query($conn, $query);
  $lines = mysqli_num_rows($result);
  $activitate0 = mysqli_fetch_assoc($result);

  $projectQuery = "select * from project where StudentUser = '$userStud' and Week = '$i'+1";
  $resultProject = mysqli_query($conn, $projectQuery);
  $linesProject = mysqli_num_rows($resultProject);
  $project0 = mysqli_fetch_assoc($resultProject);

  $testQuery = "select * from test where StudentUser = '$userStud' and Week = '$i'+1";
  $resultTest = mysqli_query($conn, $testQuery);
  $linesTest = mysqli_num_rows($resultTest);
  $test0 = mysqli_fetch_assoc($resultTest);

  $totalQuery = "select * from totalgrades where StudentUser = '$userStud'";
  $resultTotal = mysqli_query($conn, $totalQuery);
  $linesTotal = mysqli_num_rows($resultTotal);
  $total0 = mysqli_fetch_assoc($resultTotal);

  $activitate = $activitate0['Activity'];
  $prezenta = $activitate0['Presence'];
  $project = $project0['Grade'];
  $test = $test0['Grade'];
  $total = $total0['grades'];


  if($lines > 0){
    echo "
      <script>
      var activitate = document.getElementsByClassName('activitate');
      var prezenta = document.getElementsByClassName('prezenta');
      activitate['$i'].innerHTML = '$activitate';
      prezenta['$i'].innerHTML = '$prezenta';
      </script>
    ";
  }

  if($linesProject > 0){
    echo "
      <script>
      var proiect = document.getElementsByClassName('proiect');
      proiect['$i'].innerHTML = '$project';
      </script>
    ";
  }

  if($linesTest > 0){
    echo "
      <script>
      var test = document.getElementsByClassName('test');
      test['$i'].innerHTML = '$test';
      </script>
    ";
  }


}

if($linesTotal > 0){
  echo "
    <script>
    var total = document.getElementById('total');
    total.innerHTML = 'Total: ' + '$total';
    </script>
  ";
}

$x =  $_SESSION['gitCount'];
echo "
  <script>
  console.log('$x');
  </script>
";

$commitsQuery = "select Commits from gitcomm where User = '$userStud'";
$resultQuery = mysqli_query($conn,$commitsQuery);
$rows = mysqli_num_rows($resultQuery);
$result = mysqli_fetch_assoc($resultQuery);
$finalResult = $result["Commits"];

if($rows < 1){
  echo "
  <script>
  var x = document.getElementById('github-activity');
  x.innerHTML = 0;
  console.log(x);
  </script>
  ";
}
else {
  echo "
  <script>
  var x = document.getElementById('github-activity');
  x.innerHTML = '$finalResult' ;
  console.log(x);
  </script>
  ";
}
 ?>
