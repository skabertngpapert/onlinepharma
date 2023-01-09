<?php

$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'pharmacy');

if(isset($_POST['insertdata']))
{
    $uname = $_POST['uname'];
    $password = $_POST['password'];
    $usrname = $_POST['usrname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $cart = $_POST['cart'];
    $itemqty = $_POST['itemqty'];
    if ($_POST['level'] == "admin")
    {
        $level = 0;
    }
    else
    {
        $level = 1;
    }
    $query = "INSERT INTO accounts (`usrUname`,`usrPassword`,`usrName`,`usrEmail`,`usrPhone`,`usrCart`,`usrItemQty`,`usrLevel`) VALUES ('$uname','$password','$usrname','$email','$phone','$cart','$itemqty',$level)";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header('Location: ../../../usersedit.php');
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}

?>