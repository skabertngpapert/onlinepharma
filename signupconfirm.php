<?php

    session_start();
    include ('database/login.php');
    echo $_GET['suname'];
    if (isset($_GET['suname']) && isset($_GET['spassword']) && isset($_GET['sname']) && isset($_GET['semail']) && isset($_GET['sphone'])){

        function validate($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $suname = $_GET['suname'];
        $spass = $_GET['spassword'];
        $sname = $_GET['sname'];
        $semail = $_GET['semail'];
        $sphone = $_GET['sphone'];
        $sphone = substr_replace($sphone,'+63',0,1);

        if(empty($suname))
        {

            header ("Location: login.php");
            $_SESSION['reg'] = "usernameReq";
            exit();
        }
        else if (empty($spass))
        {
            header ("Location: login.php?error=Password is requireds");
            $_SESSION['reg'] = "passwordReq";
            exit();
        }
        else if(empty($semail))
        {
            header ("Location: login.php");
            $_SESSION['reg'] = "emailReq";
            exit();
        }
        else if (empty($sphone))
        {
            header ("Location: login.php");
            $_SESSION['reg'] = "phoneReq";
            
            exit();
        }


        $sql = "SELECT * FROM accounts WHERE usrUname = '$suname'";

        $results = mysqli_query($conn, $sql);
        if(mysqli_num_rows($results) == 1){
            header ("Location: login.php");
            echo '<script>alert("usernameTaken");</script>';
            $_SESSION['reg'] = "usernameTaken";
            exit();
        }
        else
        {
            $sql = "INSERT INTO `accounts`(`usrUname`, `usrPassword`, `usrName`, `usrEmail`, `usrPhone`, `usrCart`, `usrItemQty`, `usrLevel`) VALUES ('" . $suname . "','" . $spass . "','" . $sname . "','" . $semail . "','" . $sphone . "','','',1)";
            if (mysqli_query($conn, $sql)) {
                echo '<script>alert("New record created successfully");</script>';
                header ("Location: login.php");
                $_SESSION['reg'] = "success";
                exit();
            } else {
                echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
                header ("Location: login.php");
                $_SESSION['reg'] = "mysqlError";
                $_SESSION['regmysql'] = mysqli_error($conn);
                exit();
            }
            
            
        }
    }

    
?>