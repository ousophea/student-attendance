<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die                      ('Error connecting to mysql');

$dbname = 'db_saa';
mysql_select_db($dbname);
?>
