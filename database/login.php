<?php
$host = "sql6.freemysqlhosting.net";
$uname = "sql6589257";
$password = "6RLihjnGxe";

$dbname = "sql6589257";

$conn = mysqli_connect($host, $uname, $password, $dbname);

if (!$conn)
{
    echo 'Connection failed';
}
?>
