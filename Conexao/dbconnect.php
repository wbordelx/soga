<?php
$MyUsername = "root";  // enter your username for mysql
$MyPassword = "";  // enter your password for mysql
$MyHostname = "localhost";      // this is usually "localhost" unless your database resides on a different server

$dbh = pg_connect("host=localhost port=5432 dbname=sogav2 user=postgres password=waguinho");

?>