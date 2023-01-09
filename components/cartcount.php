<?php
session_start();
include("../database/connection.php");

$conn = OpenCon();
$sql = "SELECT * FROM accounts WHERE usrId ='" . $_SESSION['user_id'] . "' AND usrUname ='" . $_SESSION['user_name'] ."'";

$results = mysqli_query($conn,$sql);
if (mysqli_num_rows($results) > 0)
{
    while ($row = mysqli_fetch_array($results)) {
        $userCartQty = $row['usrItemQty'];
    }
    
    $cartToken = explode(",",$userCartQty);
    $_SESSION['user_item_qty'] = $userCartQty;
    
    $inCartCount = 0;

    if ($cartToken[0] != "")
    {
        foreach($cartToken as $cartQty)
        {
            $inCartCount = $inCartCount + $cartQty;
        }
        $_SESSION['user_cart_count'] = $inCartCount;
        echo $inCartCount;
    }
    else
    {
        $_SESSION['user_cart_count'] = 0;
        echo "0";
    }
    
}
else
{
    echo '0';
}








?>