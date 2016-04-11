<?php

//Start the session
session_start();

//Check for empty fields
if(empty($_POST['username']) || empty($_POST['password']))
   {
	echo "No arguments Provided!";
	return false;
   }

// $ini_array = parse_ini_file("connect.ini");
// echo "test.php $username $password";
//
// $dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=" . $ini_array['username'] . " user=" . $ini_array['username'] . " password=" . $ini_array['password'])
//     or die('Could not connect: ' . pg_last_error());
//
// //Need to save the db session??
// $_SESSION['dbConnect'] = $dbconn;
// echo print_r($ini_array);

include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

//Check to see if a proper connection to the database was made
if($dbconn == "FALSE")
{
  echo "false";
}
else {
  // echo $dbconn;
}

$match = false;

//Test Query for now
$query = "SELECT U.Userid,U.password FROM USERS U";
$result = pg_query($dbconn, $query);// or die('Query failed: ' . pg_last_error());

while ($row = pg_fetch_row($result)) {

  // echo "\nrow 0:" . $row[0] . ", row 1:" . $row[1] . "\nusername:" . $username . ",password:" . $password;

  if(($row[0] == $username) && ($row[1] == $password))
  {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    // echo "true\n";
    $match = true;
  }
}

if($match == true)
{
  echo "true";
}
else {
  echo "false";
}

?>
