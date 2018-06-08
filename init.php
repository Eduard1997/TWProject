<?php
session_start();
function goToAuthUrl()
{
    $client_id = "a5679061a89dc900cd11";
    $redirect_url = "index.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $url = 'https://github.com/login/oauth/authorize?client_id='. $client_id. "&redirect_url=".$redirect_url."&scope=user";
        header("location: $url");
    }
}

function fetchData()
{
    $client_id = "a5679061a89dc900cd11";
    $redirect_url = "index.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['code'])) {
            $code = $_GET['code'];
            $post = http_build_query(array(
                    'client_id' => $client_id,
                    'redirect_url' => $redirect_url,
                    'client_secret' => 'eabf773ca9c0c7940a4955155f6efc15d0338009',
                    'code' => $code,

                ));
        }

        $access_data = file_get_contents("https://github.com/login/oauth/access_token?". $post);

        $exploded1 = explode('access_token=', $access_data);
        $exploded2 = explode('&scope=user', $exploded1[1]);

        $access_token = $exploded2[0];


        $opts = [ 'http' => [
                        'method' => 'GET',
                        'header' => [ 'User-Agent: PHP']
                    ]
        ];

        //fetching user data
        $url = "https://api.github.com/user?access_token=$access_token";
        $context = stream_context_create($opts);
        $data = file_get_contents($url, false, $context);
        $user_data = json_decode($data, true);
        $username = $user_data['login'];


        //fetching email data
        $url1 = "https://api.github.com/user/emails?access_token=$access_token";
        $emails = file_get_contents($url1, false, $context);
        $emails = json_decode($emails, true);
        $email = $emails[0];

        $url2 = "https://api.github.com/repos/".$username . "/TW/commits?access_token=$access_token";
        $git = file_get_contents($url2, false, $context);
        $git = json_decode($git, true);
        $gits = $git[0];
        // echo count($git);
        // $userPayload = [
        //     'username' => $username,
        //     'email' => $email,
        //     'git' => $git,
        //     'fetched from' => "github"
        // ];
        $gitsCount =  count($git);
        echo $gitsCount;
        $userPayload = [
          'commituri' => $git
        ];
          $_SESSION['payload'] = $userPayload;
          $_SESSION['user'] = $username;
          $_SESSION['gitCount'] = $gitsCount;
         return $userPayload;


    }
    else {
        die('error');
    }
}
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



$username = $_COOKIE['username'];
$select = "select* from gitcomm where User = '$username'";
$selectResult = mysqli_query($conn, $select);
$linii = mysqli_num_rows($selectResult);
$gitsCount =   $_SESSION['gitCount'];
if($linii<1){
  $query = "insert into gitcomm values ('$username', '$gitsCount')";
  $result = mysqli_query($conn, $query);
}
else {
  $query1="UPDATE gitcomm SET Commits='$gitsCount' where User='$username'";
  $result1 = mysqli_query($conn, $query1);
}

header("location: displayGrades.php")
?>
