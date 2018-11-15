<DOCTYPE html>

<html>

<?php
//this checks that the session varaible 'loggedin' is set, meaning it checks if the user is logging in
//if the user is logged in the script will work as normal
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>

	<title>Task 4</title>

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
   // this selects everything from fixture where the away team or home team is the same team as the selected team from task 3
   $sql = "SELECT * FROM fixture WHERE homeTeam = '$_GET[team]' OR awayTeam = '$_GET[team]'";
   
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>

 <h2>Details of the selected Team</h2>

   	  <table border='1'align = center>
      <tr>
         <th>Home Team</th><th>Away Team</th><th>Date</th><th>Home Team Score</th><th>Away Team Score</th>
      </tr>

<?php	
// the home team, away team, on date, home team score and away team score are printed in a table	
   foreach ($results as $row) {
      echo "<tr><td>".$row['homeTeam']."</td><td>".$row['awayTeam']."</td><td>".$row['onDate']."</td><td>".$row['homeTeamScore']."</td><td>".$row['awayTeamScore']."</td></tr>";
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