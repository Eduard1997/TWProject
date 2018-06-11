<script>
function redirect(){
  let url = "profesor.html";
  window.open(url,"_self");
}
</script>


<?php
$cookie_time = 60 * 60 * 24 * 30;
$cookie_time_Onset=$cookie_time+ time();
if(isset($_POST['profUser']) && isset($_POST['profPass'])){
  $var1 = $_POST['profUser'];
  $var2 = $_POST['profPass'];

  $pdo = new PDO('mysql:dbname=webstudy;host=127.0.0.1;charset=utf8', 'root', '');
  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sqlUser = $pdo -> prepare('select Username from teacherusers where Username = :user');
  $sqlUser -> execute(array('user' => $var1));
  foreach ($sqlUser as $key ) {
    $studUser =  $key['Username'];
  }

  $sqlPass = $pdo -> prepare("select Password from teacherusers where Username = '$studUser' and Password = :pass");
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

  if($studPass == ''){
    echo "<script>
    window.alert('Password is wrong');
    window.open('http://localhost/TW/View/index.php#logIn', '_self');
    </script>";
    die();
  }
   else{

     $sqlName = $pdo-> prepare("select Name from studentusers where Username = :name");
     $sqlName -> execute(array('name'=>$var1));
     foreach ($sqlName as $key3) {
    $studName = $key3['Name'];
  }
        if(isset($_REQUEST['rememberMeProf'])){
          setcookie("Profusername", $var1, $cookie_time_Onset);
          setcookie("Profpassword", $var2, $cookie_time_Onset);
          setcookie("Profname",$studName, $cookie_time_Onset);
        }
        else {
          setcookie("Profname", $studName, $cookie_time_Onset);
        }
        echo "
        <script>
        redirect();
        </script>
        ";
   }

}

}
?>
