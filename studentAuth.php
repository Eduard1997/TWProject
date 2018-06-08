<script>
function redirect(){
  let url = "displayGrades.php";
  window.open(url,"_self");
}
</script>


<?php
$cookie_time = 60 * 60 * 24 * 30;
$cookie_time_Onset=$cookie_time+ time();
if(isset($_POST['studUsername']) && isset($_POST['studPassword'])){
  $var1 = $_POST['studUsername'];
  $var2 = $_POST['studPassword'];

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
echo "Connected successfully";
echo '<br/>';
$sqlUser = "select Username from studentusers where Username = '$var1'";
$sqlPass = "select Password from studentusers where Password = '$var2'";

$resultPass = mysqli_query($conn, $sqlPass);
$resultUser = mysqli_query($conn,$sqlUser);
$checkUser = mysqli_num_rows($resultUser);
$checkPass = mysqli_num_rows($resultPass);

if($checkUser < 1) {
  die("user is not in database, try again");
}
else{
  echo 'user is in DB';
  if($checkPass < 1){
    die("password is not in database, try again");
  }
   else{
     echo '<br />';
     echo 'password is in database';
     echo '<br />';
     $sqlName = "select Name from studentusers where Username = '$var1'";
     $resultName = mysqli_query($conn, $sqlName);
     $checkName = mysqli_num_rows($resultName);
     $row = mysqli_fetch_assoc($resultName);
     if($checkName < 1){
       die("user is not correct");
     } else {

       echo "numele este" . $row["Name"];
     }
        if(isset($_REQUEST['rememberMe'])){
          setcookie("username", $var1, $cookie_time_Onset);
          setcookie("password", $var2, $cookie_time_Onset);
          setcookie("name", $row["Name"], $cookie_time_Onset);
        }
        else {
          setcookie("name", $row["Name"], $cookie_time_Onset);
        }
        echo "
        <script>
        redirect();
        </script>
        ";
   }

}
mysqli_close($conn);
}
?>
