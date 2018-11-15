<!DOCTYPE html>

<html>

<?php
//this checks that the session varaible 'loggedin' is set, meaning it checks if the user is logging in
//if the user is logged in the script will work as normal
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>

	<title>Task 2</title>

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
   //this selects the club name and counts how many teams are in each club
   // the HAVING COUNT query checks that the club has more than 2 teams in order to be printed
   $sql = "SELECT club.name, COUNT(team.clubID) FROM club INNER JOIN team ON club.cid = team.clubID 
   GROUP BY clubID HAVING COUNT(team.clubID) > 2";
   
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>

   <h2>Number of teams in club </h2>
   
   <table border = 1 align = center>
	<tr>
		<th>Club Name</th><th>Number Of Teams</th>
	</tr>
	<tr>
	

<?php
// prints the name of the club and the count of the number of teams in that club in a table		
   foreach ($results as $row) {
      echo "<tr> <td>".$row['name']."</td> <td> ".$row['COUNT(team.clubID)']."</td></tr>";
   }   

echo <<<_END
   </table>   
</body>
_END;
} 
else {
//this shows that if the user if not logged in then they will be directed to the login page

	header("Location: loginform.html");
}
?>
</html>