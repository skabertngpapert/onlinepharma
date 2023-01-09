<?php
include('login.php');
$username = $_POST['usrname'];
$userid = $_POST['usrid'];
$itemid = $_POST['itemid'];


#get items and quantity from using cart by using userid and username as reference
$sql = "SELECT * FROM accounts WHERE usrId ='" . $userid . "' AND usrUname ='" . $username ."'";

$results = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($results)){
    $usercart = $row['usrCart'];
    $useritemqty = $row['usrItemQty'];
}



$usrcartArr = explode(",", $usercart);
$usritemqtyArr = explode(",", $useritemqty);



$updateitemid = "";
$updateitemqty = "";


#searching item id if already have on user's account so no double entry will happen
if (!in_array(strval($itemid),$usrcartArr))
{

    if ($usercart == "" or $usercart == NULL)
    {
        $updateitemid = $itemid;
        $updateitemqty = "1";
    }
    else
    {
        $updateitemid = $usercart . "," . $itemid;
        $updateitemqty = $useritemqty . ",1";
    }
     
}
else
{
    $searchitemid = array_search($itemid,$usrcartArr);
    $updateitemid = $usercart;
    $usritemqtyArr[$searchitemid] = intval($usritemqtyArr[$searchitemid]) + 1; #adding 1 to the quantity of the item based on item id
    $updateitemqty = implode(",", $usritemqtyArr);
}

#updating user's cart by adding quantity if there is existing item or adding id and quantity if it didn't exist
$sql = "UPDATE accounts SET usrCart ='" . $updateitemid . "', usrItemQty = '" . $updateitemqty . "' WHERE usrId =" . $userid . " AND usrUname ='" . $username . "'";

if(mysqli_query($conn, $sql))
{
    echo 'success';
}
else
{
    echo 'Error Update:' . mysqli_error($conn);
    echo '<script> alert("' . mysqli_error($conn) . '");</script>';
}

#getting only the item's information because products and feature should have the same parameters
$sql = "SELECT * FROM products WHERE id ='" . $itemid . "'";

$results = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($results)){
    $oldStock = $row['stock'];
}

$newStock = $oldStock-1;

#updating products tables' stock
$sql = "UPDATE products SET stock = " . $newStock . " WHERE id =" . $itemid;

if(mysqli_query($conn, $sql))
{
    echo 'success';
}
else
{
    echo 'Error Update:' . mysqli_error($conn);
    echo '<script> alert("' . mysqli_error($conn) . '");</script>';
}


#updating featured tables' stock
$sql = "UPDATE featured SET stock = " . $newStock . " WHERE id =" . $itemid;

if(mysqli_query($conn, $sql))
{
    echo 'success';
}
else
{
    echo 'Error Update:' . mysqli_error($conn);
    echo '<script> alert("' . mysqli_error($conn) . '");</script>';
}




$conn->close();
?>