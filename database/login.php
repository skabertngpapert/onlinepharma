<?php
$host = "localhost";
$uname = "root";
$password = "";

$dbname = "pharmacy";

$conn = mysqli_connect($host, $uname, $password, $dbname);

if (!$conn)
{
    echo 'Connection failed';
}
?>