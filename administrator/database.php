<?php
//database connection
$host = "localhost";
$dbname = "godwinners_db";
$username = "root";
$paswsword = "";

$mysqli = new mysqli(hostname: $host,
                     username: $username, 
                     password: $paswsword, 
                     database: $dbname);

//check connection error
if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli-connect_error);
}

return $mysqli;