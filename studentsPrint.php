<!-- <script>
function redirect(){
  let url = "grupa1.html";
  window.open(url,"_self");
}
</script> -->


<?php
session_start();
include_once 'grupa1.html';
$_SESSION['saptamana']=$_POST['saptamana'];

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
//echo "Connected successfully";
//echo '<br/>';

if(isset($_POST['semian']) && isset($_POST['grupa']) && isset($_POST['saptamana'])){
  $semian = $_POST['semian'];
  $grupa = $_POST['grupa'];
  $sapt = $_POST['saptamana'];
  //echo $semian . ' ' . $grupa . ' ' . $sapt;
  $group = $semian.$grupa;

  $query = "select Name from studentusers where Grupa = '$group' ";
  $result = mysqli_query($conn, $query);
  $linii = mysqli_num_rows($result);

  if($linii < 1){
    echo "name is not in DB";
  } else{
    while ($row = mysqli_fetch_assoc($result)){

      $studName = $row["Name"];


      echo "
      <script>
          var node = document.createElement('p');
          var spatiu = document.createElement('br');
          node.setAttribute('class' , 'nume');
          var textnode = document.createTextNode('$studName');
          document.getElementById('om').appendChild(spatiu);         // Create a text node
          node.appendChild(textnode);                              // Append the text to <li>
          document.getElementById('om').appendChild(node);
          var prezenta = document.createElement('INPUT');
          prezenta.setAttribute('type','text');
          prezenta.setAttribute('name','prezenta');
          prezenta.setAttribute('id','primacasuta');
          document.getElementById('om').appendChild(prezenta);

          var activitate = document.createElement('INPUT');
          activitate.setAttribute('type','text');
          activitate.setAttribute('name','activitate');
          document.getElementById('om').appendChild(activitate);

          var proiect = document.createElement('INPUT');
          proiect.setAttribute('type','text');
          proiect.setAttribute('name','proiect');
          document.getElementById('om').appendChild(proiect);

          var test = document.createElement('INPUT');
          test.setAttribute('type','text');
          test.setAttribute('name','test');
          document.getElementById('om').appendChild(test);

          var total = document.createElement('INPUT');
          total.setAttribute('type','text');
          total.setAttribute('name','total');
          document.getElementById('om').appendChild(total);



      </script>";

      //echo '<br>';
    }

  }


}
mysqli_close($conn);
?>
