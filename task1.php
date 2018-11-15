<!DOCTYPE html>

<html>

<?php
//this checks that the session varaible 'loggedin' is set, meaning it checks if the user is logging in
//if the user is logged in the script will work as normal
session_start();
if (isset($_SESSION['loggedin'])){
echo <<<_END

<head>

	<title>Task 1</title>

	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>

	//This is the Logout link that leads the user to back to the Login page
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
   // Selects all information from Members whp are in the club 'C02'
   $sql = "SELECT * FROM member
   WHERE clubID = 'C02'
   //this orders the members by gender and then by surname within the genders
   ORDER BY gender, surname";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   // Printing out the details of each club
?>
   <h2>Details of all clubs</h2>
   
   <table border = 1 align = center>
	<tr>
		<th>Forenames</th><th>Surnames</th><th>DOB</th>
	</tr>
	<tr>
	

<?php	
// prints the forename, surname and date of birth of the members into a table	
   foreach ($results as $row) {
      echo "<tr> <td>".$row['forename']."</td> <td> ".$row['surname']."</td><td> (".$row['dob'].")</td></tr>";
   }   

echo <<<_END
   </table>   
</body>
_END;
} 

//this shows that if the user if not logged in then they will be directed to the login page
else {
	header("Location: loginform.html");
}
?>

</html>