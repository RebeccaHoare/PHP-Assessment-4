<DOCTYPE html>

<html>

<head>

	<title>Login</title>

</head>

<body>
	<?php
	session_start();

	// this defines what the username and password are so they can be checked with what the user entered	
	$Username = "a3";
	$Password = "testing";
	
	// the post method is used to check that the username and password they have entered is correct aka the same as the username and password defined above
	if (($_POST['username'] == $Username ) &&
		($_POST['password'] == $Password)) 
	{
	// if the user has entered the right username and password they are directed the the menu.php page
		$_SESSION["loggedin"] = "true";
        header("Location: menu.php");
    }
	else {
	// if the username and passowrd that the user has entered is incorrect that statement below will be printed
	echo "Incorrect username and, or password"; return; 
	      
	}

?>
</body>
</html>