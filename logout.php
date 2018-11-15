<DOCTYPE html>
<html>
<head>
	<title>Logout Page</title>
</head>
<body>
	<?php
	session_start();
	session_destroy();
		 
	header("Location: loginform.html");
?>

	<h2>Logout Page</h2>
	
</body>
</html>