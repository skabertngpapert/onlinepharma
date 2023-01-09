<?php
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'pharmacy');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
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
        $query = "UPDATE accounts SET usrUname='$uname', usrPassword='$password', usrName='$usrname', usrEmail=' $email', usrPhone=' $phone', usrCart=' $cart', usrItemQty=' $itemqty', usrLevel=$level WHERE usrId=$id";
        $query_run = mysqli_query($connection, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location: ../../../usersedit.php");
        }
        else
        {
            echo '<script> alert("'. mysqli_error($connection) . '"); </script>';
        }
    }
?>