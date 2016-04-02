<?php

// Check for empty fields
if(empty($_POST['username']) || empty($_POST['password']))
   {
	echo "No arguments Provided!";
	return false;
   }
   else {
     echo "lol";
   }
//
// $username = $_POST['username'];
// $password = $_POST['password'];
//
// echo "test.php $username $password";

// $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=$username user=$username password=$password")
//     or die('Could not connect: ' . pg_last_error());

// $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=vraje059 user=vraje059 password=Vedha545654")
//     or echo('Could not connect: ' . pg_last_error());

// $query = "SELECT * FROM CUSTOMER";
// $result = pg_query($query) or die('Query failed: ' . pg_last_error());
// echo $result;

// // Printing results in HTML
// echo "<table>\n";
// while ($line = pg_fetch_array($result, null, PGSQL_ASSOC))
// {
//     echo "\t<tr>\n";
//     foreach ($line as $col_value) {
//         echo "\t\t<td>$col_value</td>\n";
//     }
//     echo "\t</tr>\n";
// }

// echo "</table>\n";
echo "Hello World"

return true

?>
