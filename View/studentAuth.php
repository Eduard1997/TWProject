
<script>
function redirect(){
  let url = "displayGrades.php";
  window.open(url,"_self");
}
</script>


<?php
// ' or '1'='1


$cookie_time = 60 * 60 * 24 * 30;
$cookie_time_Onset=$cookie_time+ time();
if(isset($_POST['studUsername']) && isset($_POST['studPassword'])){
  $var1 = $_POST['studUsername'];
  $var2 = $_POST['studPassword'];


$pdo = new PDO('mysql:dbname=webstudy;host=127.0.0.1;charset=utf8', 'root', '');

$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$sqlUser = $pdo -> prepare('select Username from studentusers where Username = :user');
$sqlUser -> execute(array('user' => $var1));
foreach ($sqlUser as $key ) {
  $studUser =  $key['Username'];
}

$sqlPass = $pdo -> prepare("select Password from studentusers where Username = '$studUser' and Password = :pass");
$sqlPass -> execute(array('pass' => $var2));
foreach ($sqlPass as $key2) {
  $studPass = $key2['Password'];
}


if($studUser == '') {
  echo "<script>
  window.alert('User is wrong');
  window.open('http://localhost/TW/View/index.php#logIn', '_self');
  </script>";
  die();

}
else{
  echo 'user is in DB';
  if($studPass == ''){
    echo "<script>
    window.alert('Password is wrong');
    window.open('http://localhost/TW/View/index.php#logIn', '_self');
    </script>";
    die();
  }
   else{
     echo '<br />';
     echo 'password is in database';
     echo '<br />';
     echo "
     <script>
     redirect();
     </script>
     ";
     $sqlName = $pdo-> prepare("select Name from studentusers where Username = :name");
     $sqlName -> execute(array('name'=>$var1));
     foreach ($sqlName as $key3) {
       $studName = $key3['Name'];
     }

     if($studName ==''){
       die("user is not correct");
     } else {

       echo "numele este" . $studName;
     }
        if(isset($_REQUEST['rememberMe'])){
          setcookie("username", $var1, $cookie_time_Onset);
          setcookie("password", $var2, $cookie_time_Onset);
          setcookie("name", $studName, $cookie_time_Onset);
        }
        else {
          setcookie("name",$studName, $cookie_time_Onset);
        }
        // echo "
        // <script>
        // redirect();
        // </script>
        // ";
   }

}

}
?>
