<?php

//Start the session
// session_start();

$ini_array = parse_ini_file("connect.ini");

$dbconn = pg_connect("host=web0.site.uottawa.ca port=15432 dbname=" . $ini_array['username'] . " user=" . $ini_array['username'] . " password=" . $ini_array['password'])
    or die('Could not connect: ' . pg_last_error());

return $dbconn;

?>
