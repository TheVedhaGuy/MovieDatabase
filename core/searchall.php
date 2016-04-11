<?php

//Start the session
session_start();

include 'core/db.php';

$movies = $_POST['movies'];
//$actors = $_POST['actors'];
//$studios = $_POST['studios'];
//$directors = $_POST['directors'];
//Test Query for now
 $query = "SELECT * FROM Movie";
 $result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());
 $movieInfo = pg_fetch_assoc($result);
 $_SESSION['movies'] = $movieInfo;

 echo $_SESSION['movies'];

// Printing results in HTML
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

return true;
?>
