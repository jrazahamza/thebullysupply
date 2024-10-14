<?php
$host="localhost";
$user="sql_thebullysupp";
$password='c25a61e1cbd52';
$db="sql_thebullysupp";
$con=mysqli_connect($host,$user, $password,$db);
$database=mysqli_select_db($con, $db);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
if(!mysqli_select_db($con, $db)) {
    die("Database selection failed: " . mysqli_error($con));
}
if(!$database)
{
	echo mysqli_error();
}
mysqli_set_charset($con,"utf8");
