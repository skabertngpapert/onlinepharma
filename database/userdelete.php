<?php
$connection = mysqli_connect("sql6.freemysqlhosting.net","sql6589257","6RLihjnGxe");
$db = mysqli_select_db($connection, 'sql6589257');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM accounts WHERE usrId=$id";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        header("Location: ../../../usersedit.php");
    }
    else
    {
        echo '<script> alert("Data Not Deleted"); </script>';
    }
}

?>
