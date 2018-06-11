<?php
	require_once "fbconfig.php";

	if (isset($_SESSION['access_token'])) {
		header('Location: ../View/fbindex.php');
		exit();
	}

	$redirectURL = "https://localhost/TW/Controller/fb-callback.php";
	$permissions = ['email'];
	$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>

</head>
<body>


				<form>
					<input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Facebook" class="btn btn-primary">
				</form>


</body>
</html>
