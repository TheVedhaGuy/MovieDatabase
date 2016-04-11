<?php

//Start the session
session_start();

$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=vraje059 user=vraje059 password=Vedha545654")
    or die('Could not connect: ' . pg_last_error());
//Test Query for now
$query = "SELECT * FROM MOVIE where movieid='00001'";
$result = pg_query($query);// or die('Query failed: ' . pg_last_error());

$myarray = array();
while ($row = pg_fetch_array($result)) {
  $myarray[] = $row;
}

echo json_encode($myarray);

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
