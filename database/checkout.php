<?php
session_start();

$host = "sql6.freemysqlhosting.net";
$uname = "sql6589257";
$password = "6RLihjnGxe";

$dbname = "sql6589257";

$conn = mysqli_connect($host, $uname, $password, $dbname);

if (!$conn)
{
    echo 'Connection failed';
}

    if(isset($_SESSION['user_name']) && isset($_SESSION['user_id']))
    {
        $userid = $_SESSION['user_id'];
        $username = $_SESSION['user_name'];
        
        $sql = "UPDATE accounts SET usrCart ='', usrItemQty ='' WHERE usrId ='" . $userid . "' AND usrUname ='" . $username ."'";
        if(mysqli_query($conn, $sql))
        {
            
        }
        else
        {
            echo 'Error Update:' . mysqli_error($conn);
            echo '<script> alert("' . mysqli_error($conn) . '");</script>';
        }

    }

?>
