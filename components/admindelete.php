
<?php
session_start();
    if(isset($_POST['adminDeleteId']))
    {
        
        if  ($_SESSION['admin'] == 0)
        {
            $itemIdDelete = $_POST['adminDeleteId'];
            include('../database/connection.php');

            $conn = OpenCon();

            $query = "DELETE FROM products WHERE id =" . $itemIdDelete;
            if(mysqli_query($conn, $query))
            {
                echo '<script>console.log("success delete product");</script>';
            }
            else
            {
                echo 'Error Update:' . mysqli_error($conn);
                echo '<script> console.log("' . mysqli_error($conn) . '");</script>';
            }

            $query = "DELETE FROM featured WHERE id =" . $itemIdDelete;
            if(mysqli_query($conn, $query))
            {
                echo '<script>console.log("success delete product");</script>';
            }
            else
            {
                echo 'Error Update:' . mysqli_error($conn);
                echo '<script> console.log("' . mysqli_error($conn) . '");</script>';
            }

            $query = "SELECT * FROM accounts";
            $results = mysqli_query($conn,$query);
            echo '<script> alert("wew")</script>';
            $accountHit = [];
            $accountUpdateCart = [];
            $accountUpdateQty = [];
            $counter = 0;
            if (mysqli_num_rows($results) > 0)
            {
                while($row = mysqli_fetch_array($results)){
                    $usrId = $row['usrId'];
                    $usrCart = $row['usrCart'];
                    $usrItemQty = $row['usrItemQty'];
                    $usrCartArr = explode(",",$usrCart);
                    $usrItemQtyArr = explode(",",$usrCart);

                    
                    if (array_search($itemIdDelete, $usrCartArr))
                    {
                        $accountHit[$counter] = $usrId;
                        $pos = array_search($itemIdDelete, $usrCartArr);
                        unset($usrCartArr[$pos]);
                        unset($usrItemQtyArr[$pos]);
                        $accountUpdateCart[$counter] = implode(",",$usrCartArr);
                        $accountUpdateQty[$counter] = implode(",",$usrItemQtyArr);
                        $counter +=1;
                    }
                }
            }

            $accountCounter = 0;
            foreach($accountHit as $accountId)
            {
                $query = ("UPDATE accounts SET usrCart ='" . $accountUpdateCart[$accountCounter] . "', usrItemQty='" . $accountUpdateQty[$accountCounter] . "' WHERE usrId =" . $accountId );
                if(mysqli_query($conn, $query))
                {
                    $accountCounter +=1;
                }
                else
                {
                    echo 'Error Update:' . mysqli_error($conn);
                    echo '<script> console.log("' . mysqli_error($conn) . '");</script>';
                }
            }
            echo json_encode($accountHit);

            // header("Location: /admin.php");

        }
        else
        {
        echo '<script>console.log("wew1");</script>';
            //header("Location: /logout.php");
        }
    }
    else
    {
        echo '<script>console.log("wew1");</script>';
    header("Location: /logout.php");
    }
?>