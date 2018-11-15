<DOCTYPE html>

<html>

<?php

//this checks that the session varaible 'loggedin' is set, meaning it checks if the user is logging in
//if the user is logged in the script will work as normal
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>

	<title>Menu Page</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">

</head>

<body>
	
	<h2> University of Kent: School of Computing<br/>
	CO323 Assessment 4 - PHP and MySQL</h2>

	// these are buttons which link to each of the pages of the different tasks 	
	<br/><a href = "task1.php"><button type="button">Task 1</button></a><br/>
	<br/><a href = "task2.php"><button type="button">Task 2</button></a><br/>
	<br/><a href = "task3.php"><button type="button">Task 3</button></a><br/>
	
</body>
_END;
} 
else {
//this shows that if the user if not logged in then they will be directed to the login page

	header("Location: loginform.html");
}
?>
</html>
	