<?php
session_start();


if (isset($_POST['adminFeaturedId'])) {

    if ($_SESSION['admin'] == 0) {
        $itemIdFeatured = $_POST['adminFeaturedId'];
        include('../database/connection.php');

        $conn = OpenCon();

        $InFeatured = false;
        $conn->Close();
        $conn = OpenCon();

        $query = "SELECT * FROM featured WHERE id =" . $itemIdFeatured;
        $results = mysqli_query($conn,$query);
        if (mysqli_num_rows($results) > 0) {
            $InFeatured = true;            
        }
        else
        {
            $InFeatured = false;
        }
        

        if ($InFeatured == true)
        {
            $query = "DELETE FROM featured WHERE id=". $itemIdFeatured ;
            if(mysqli_query($conn, $query))
            {
                echo 'true';
                exit();
            }
            else
            {
                echo 'Error From Featured:' . mysqli_error($conn);
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