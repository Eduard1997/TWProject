<?php
 $con=mysqli_connect('localhost' , 'root' ,'');
 $db=mysqli_select_db($con,'webstudy');
 
 if($con)
 {
  echo '<br>successful connection';
 }
 else
 {
  die('<br>Error');
 }
 
 if($db)
 {
  echo '<br>successfully found the database';
  
 }
 else
 {
  exit('<br>Error , Database not found');
 }
 $query = "select * from studentuser";
 $result = mysqli_query($con, $query);
while($row = mysqli_fetch_assoc($result) ){
    echo '<br/>';
    $username = $row["Username"];
    $password = $row["Password"];
    echo $username . ':' . $password . '<br />';
}

mysqli_close($con);
 
    



?>