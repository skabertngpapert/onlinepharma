<?php
session_start();


if (isset($_POST['adminFeaturedId'])) {

    if ($_SESSION['admin'] == 0) {
        $itemIdFeatured = $_POST['adminFeaturedId'];
        include('../database/connection.php');

        $conn = OpenCon();

        $query = "SELECT * FROM products WHERE id =" . $itemIdFeatured;
         
        $results = mysqli_query($conn,$query);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_array($results)) {
                $name = $row["name"];
                $brand = $row['brand'];
                $target = $row['target'];
                $tag = $row['tag'];
                $price = $row['price'];
                $description = $row['description'];
                $stock = $row['stock'];
            }
        }

        $notInFeatured = true;
        $conn->Close();
        $conn = OpenCon();

        $query = "SELECT * FROM featured WHERE id =" . $itemIdFeatured;
        $results = mysqli_query($conn,$query);
        if (mysqli_num_rows($results) > 0) {
            $notInFeatured = false;            
        }
        else
        {
            $notInFeatured = true;
        }
        

        if ($notInFeatured == true)
        {
            $query = "INSERT INTO `featured`(`id`, `name`, `brand`, `target`, `tag`, `price`, `description`, `stock`) VALUES ('" . $itemIdFeatured . "','" .  $name . "','". $brand . "','" . $target . "','"  . $tag . "'," . $price .  ",'" . $description . "'," . $stock . ")";
            if(mysqli_query($conn, $query))
            {
                echo 'true';
                exit();
            }
            else
            {
                echo 'Error Add to Featured:' . mysqli_error($conn);
                echo '<script> alert("' . mysqli_error($conn) . '  -  mysql: ' . $query . '");</script>';
            }
        }
        else
        {
            echo 'false';
            exit();
            
        }

        
    
    
    }
}
?>