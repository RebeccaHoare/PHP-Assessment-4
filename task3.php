<DOCTYPE html>

<html>

<head>

<?php

//this checks that the session varaible 'loggedin' is set, meaning it checks if the user is logging in
//if the user is logged in the script will work as normal

session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

	<title>Task 3</title>

	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

	Welcome, you are logged in! <a href="logout.php">Logout</a>
 
_END;

   // Connect to database, and complain if it fails
   try {
      $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
                          'co323', 'pa33word');
   } 
   catch (PDOException $e) {
      // The PDO constructor throws an exception if it fails
      die('Error Connecting to Database: ' . $e->getMessage());
   }

   // Run the SQL query, and print error message if it fails.
   // selects everything from team and joins with club
   $sql = "SELECT * FROM team JOIN club 
   ON team.clubID=club.cid";
   
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>

 	<h2>Team Fixture</h2>

	<p> To find out all information about a team select it from the drop down menu and then click the submit button</p>

	// when the team ID is submitted the 'get' method is used and the user is directed to task4.php page which contains detailed info of their team selection
	<form id='team' name='team' method='get' action='task4.php'>
      <select name='team' id='team'>
	

<?php	
//this shows the information that is presented in the drop down menu which says the team ID, category, division, Club ID and venue of each team	
   foreach ($results as $row) {
      echo "<option value='$row[tid]'> Team ID: $row[tid] | Category: $row[category] | Division: 
	  $row[division] | Club ID: $row[clubID] | Venue: $row[venue] </option>";
   }   
echo <<<_END
      </select>
	// this is the submit button that will lead them to task4.php page which has detailed information of their selected team on it 
	<input type="submit" value="Submit">
	</form>
</body>
_END;
} 
else {
//this shows that if the user if not logged in then they will be directed to the login page

	header("Location: loginform.html");
}
?>	
</html>