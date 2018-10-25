<?php
//connect to the database
$mysqli = new mysqli('db', 'root', 'sdfewlrcxiv', 'story');

if($mysqli->connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
