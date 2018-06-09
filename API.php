<?php
require_once("DB.php");
$db = new DB("127.0.0.1", "webstudy", "root", "");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
        $array = $db->query("SELECT * FROM totalgrades");
        $array2 = array([
          'username' => $array[0][0],
          'grade' => $array[0][1]
          ]);
        for($i = 1; $i < count($array); $i++){
          $array3 = array(
            'username' => $array[$i][0],
            'grade' => $array[$i][1]
            );
          array_push($array2,$array3);
        }
          print_r(json_encode($array2));

  } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
          if($_GET['url'] == 'add' && (!isset($_GET['user']))){
            $bodyInput = file_get_contents("php://input");
            $poc = explode('=', $bodyInput);
            $user = $poc[0];
            $grade = $poc[1];
              $db->query("INSERT INTO totalgrades VALUES ('$user', '$grade')");
          }
          if(isset($_GET['user']) && isset($_GET['grade'])){
            $user = $_GET['user'];
            $grade = $_GET['grade'];
            $db->query("INSERT INTO totalgrades VALUES ('$user', '$grade')");
        }
} else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
        if($_GET['url'] == 'add' && (!isset($_GET['user']))){
          $user = file_get_contents("php://input");
          $poc = explode('=', $user);
          $db->query("DELETE from totalgrades WHERE StudentUser = '$poc[0]'");
        }
        if(isset($_GET['user'])){
          $user = $_GET['user'];
          $db->query("DELETE from totalgrades WHERE StudentUser = '$user'");
      }
}
 else {
        http_response_code(405);
}
?>
