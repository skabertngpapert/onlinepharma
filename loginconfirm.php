<?php

    session_start();
    include ('database/login.php');

    if (isset($_POST['uname']) && isset($_POST['password'])){

        function validate($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if(empty($uname))
    {
        header ("Location: login.php?error=Username is required");
        exit();
    }
    else if (empty($pass))
    {
        header ("Location: login.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM accounts WHERE usrUname = '$uname' && usrPassword = '$pass'";
    $results = mysqli_query($conn, $sql);
    if(mysqli_num_rows($results) == 1){
        $row = mysqli_fetch_assoc($results);
        if($row['usrUname'] === $uname && $row['usrPassword'] === $pass){
            echo 'Logged In';
            
            
            $_SESSION['user_cart'] = $row['usrCart'];
            $_SESSION['user_item_qty'] = $row['usrItemQty'];
            $_SESSION['user_id'] = $row['usrId'];
            $_SESSION['user_name'] = $row['usrUname'];
            $_SESSION['account_name'] = $row['usrName'];
            $_SESSION['account_email'] = $row['usrEmail'];
            $_SESSION['account_phone'] = $row['usrPhone'];
            $_SESSION['admin'] = $row['usrLevel'];
            $_SESSION['errlogin'] = "match";
            if ($row['usrLevel'] == 0)
            {
                $_SESSION['user_Level'] = "admin";
                header("Location: /admin.php");
                exit();
            }
            else
            {
                $_SESSION['user_Level'] = "member";
                header("Location: /");
                exit();
            }
        
            
        }
        else{
            $_SESSION['errlogin'] = "nomatch";
            header ("Location: " .  $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
    else
    {
        $_SESSION['errlogin']="nomatch";
        header ("Location: " .  $_SERVER['HTTP_REFERER']);
        exit();
    }
    
?>