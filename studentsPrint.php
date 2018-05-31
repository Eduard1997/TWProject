<script>
function redirect(){
  let url = "grupa1.html";
  window.open(url,"_self");
}
</script>


<?php
include_once 'grupa1.html';
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
    echo "naspa, nik in BD";
  } else{
    while ($row = mysqli_fetch_assoc($result)){

      $ceva = $row["Name"];
      echo "
      <script>
          var node = document.createElement('p');                 // Create a <li> node
          var textnode = document.createTextNode('$ceva');         // Create a text node
          node.appendChild(textnode);                              // Append the text to <li>
          document.getElementById('om').appendChild(node);
          var prezenta = document.createElement('INPUT');
          prezenta.setAttribute('type','text');
          prezenta.setAttribute('name','prezenta');
          prezenta.setAttribute('id','primacasuta');
          document.getElementById('om').appendChild(prezenta);

          var activitate = document.createElement('INPUT');
          activitate.setAttribute('type','text');
          activitate.setAttribute('name','prezenta');
          document.getElementById('om').appendChild(activitate);

          var proiect = document.createElement('INPUT');
          proiect.setAttribute('type','text');
          proiect.setAttribute('name','prezenta');
          document.getElementById('om').appendChild(proiect);

          var test = document.createElement('INPUT');
          test.setAttribute('type','text');
          test.setAttribute('name','prezenta');
          document.getElementById('om').appendChild(test);

          var total = document.createElement('INPUT');
          total.setAttribute('type','text');
          total.setAttribute('name','prezenta');
          document.getElementById('om').appendChild(total);



      </script>";

      //echo '<br>';
    }

  }

// if($checkUser < 1) {
//   die("user is not in database, try again");
// }
// else{
//   echo 'user is in DB';
//      }
//
        // echo "
        // <script>
        // redirect();
        // </script>
        // ";
//    }
//
// }
}
mysqli_close($conn);
?>
