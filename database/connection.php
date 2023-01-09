<?php
function OpenCon()
{
$dbhost = "sql6.freemysqlhosting.net";
$dbuser = "sql6589257";
$dbpass = "6RLihjnGxe";
$db = "sql6589257";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

return $conn;
}

function CloseCon($conn)
{
$conn -> close();
}
  
?>
