<?php
session_start();
error_reporting(0);

$prdctId = $_GET['Id'];
$prdctName = $_GET['Name'];
$prdctBrand = $_GET['Brand'];
$prdctTarget = $_GET['Target'];
$prdctTag = $_GET['Tag'];
$prdctPrice = $_GET['Price'];
$prdctDesc = $_GET['Desc'];
$prdctStock = $_GET['Stock'];

$prodImg = str_replace(" ", "", $prdctName);

if(isset($_POST['updateAdmin'])){
    $prodId = $_POST['product_id'];
    $prodName = $_POST['product_name'];
    $prodBrand = $_POST['product_brand'];
    $prodTarget = $_POST['product_target'];
    $prodTag = $_POST['product_tag'];
    $prodPrice = $_POST['product_price'];
    $prodDesc = $_POST['product_description'];
    if ($prodDesc == "") {
        $prodDesc = "Desc";}
    $prodStock = $_POST['product_stock'];
    
    

    if(isset($_FILES['product_image']) && !empty($_FILES['product_image']['name'])){
        $errors= array();
        $file_name = $_FILES['product_image']['name'];
        $new_file_name = str_replace(" ","",$prodName);
        $file_size =$_FILES['product_image']['size'];
        $file_tmp =$_FILES['product_image']['tmp_name'];
        $file_type=$_FILES['product_image']['type'];
        $file_name_Arr = explode(".", $file_name);
        $file_ext=strtolower(end($file_name_Arr));
    
        $expensions= array("jpg");      
        if(in_array($file_ext,$expensions)=== false){
            $errors ="Only jpg format is allowed";
    
            if (!file_exists($newname)) {
                move_uploaded_file($file_tmp,"img/products/".$new_file_name.".jpg"); 
            }
    
        }
        if($file_size > 2097152){
            $errors[]='The file size must not exceed 2 megabytes';
        }               
        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"img/products/".$new_file_name.".jpg");
            echo "files uploaded!";
            
        }else{

            print_r($errors);
        }
    }

    $prodName = str_replace(" ", "-", $prodName);
    include('database/connection.php');
    $conn = OpenCon();
    
    $query = "UPDATE products SET `name` = '" . $prodName . "', brand = '" . $prodBrand . "', target = '" . $prodTarget . "', tag = '" . $prodTag . "', price = " . $prodPrice . ",description='" . $prodDesc . "',stock=" . $prodStock . " WHERE id = " . $prodId ."";
    if(mysqli_query($conn, $query))
    {
    }
    else
    {
        echo 'Error Update:' . mysqli_error($conn);
        echo '<script> alert("' . $prdctId . 'qq' . mysqli_error($conn) . '  -  mysql: ' . $query . '");</script>';
    }

    $query = "UPDATE featured SET `name`='" . $prodName . "',brand='" . $prodBrand . "',target='" . $prodTarget . "',tag='" . $prodTag . "',price=" . $prodPrice . ",description='" . $prodDesc . "',stock=" . $prodStock . " WHERE id = " . $prodId . "";
    if(mysqli_query($conn, $query))
    {
    }
    else
    {
        echo 'Error Update:' . mysqli_error($conn);
        echo '<script> alert("2' . mysqli_error($conn) . '  -  mysql: ' . $query . '");</script>';
    }

    echo ' <script> 
        window.setTimeout(function(){
            alert("Product Updated");
            window.location.href = "/admin.php";

        }, 1000);
    </script>';
} else if (isset($_POST['cancelAdmin'])) {
    header("Location: /admin.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thesis</title>
        
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="sytlesheet" href="css/bootstrap/bootstrap.min.css">
        <script src="../js/jquery.js"></script>
        
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


        
        
    </head>

    <body>
    

    <!------ Include the above in your HEAD tag ---------->

        <form class="form-horizontal" method="post" action="<?=$_SERVER['PHP_SELF'];?>" enctype="multipart/form-data" >
        <fieldset>
    
        <!-- Form Name -->
        <legend>UPDATE PRODUCT</legend>

        <div class="form-group">
            <label class="col-md-4 control-label" for="product_id">Product Image</label>  
            <div class="col-md-4 border">
                <img id ="prodImg" src="img/products/<?php echo $prodImg ;?>.jpg"  style="height: 20vh !important; width: 20vh" alt="Responsive image">
                <input type="file" name="product_image" id="fileToUpload" accept=".jpg"/>
            </div>
        </div>
        
        <div class="form-group">
        <label class="col-md-4 control-label" for="product_id">Product ID</label>  
        <div class="col-md-4">
        <input readonly id="product_id" name="product_id" placeholder="<?php echo $prdctId; ?>" class="form-control input-md" type="text" value="<?php echo $prdctId;?>">
        </div>
        </div>
        <!-- Text input-->
        

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="product_name">Product Name</label>  
        <div class="col-md-4">
        <input id="product_name" name="product_name" placeholder="<?php echo $prdctName;?>" class="form-control input-md" required="" type="text" value ="<?php echo $prdctName;?>">
            
        </div>
        </div>

        <!-- Text input-->
        <div class="form-group">
        <label class="col-md-4 control-label" for="product_brand">Brand</label>  
        <div class="col-md-4">
        <input id="product_brand" name="product_brand" placeholder="<?php echo $prdctBrand;?>" class="form-control input-md" required="" value ="<?php echo $prdctBrand;?>">
            
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="product_target">Target</label>  
        <div class="col-md-4">
        <input id="product_target" name="product_target" placeholder="<?php echo $prdctTarget;?>" class="form-control input-md" required="" value ="<?php echo $prdctTarget;?>">
            
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="product_tag">Tag</label>  
        <div class="col-md-4">
        <input id="product_tag" name="product_tag" placeholder="<?php echo $prdctTag;?>" class="form-control input-md" required="" value ="<?php echo $prdctTag?>">
            
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="product_price">Price</label>  
        <div class="col-md-4">
        <input type="number" id="product_price" name="product_price" placeholder="<?php echo $prdctPrice;?>" class="form-control input-md" required="" value ="<?php echo $prdctPrice;?>" onkeydown="javascript: return event.keyCode == 69 ? false : true">
            
        </div>
        </div>



        <!-- Textarea -->
        <div class="form-group">
        <label class="col-md-4 control-label" for="product_description">Product Description</label>
        <div class="col-md-4">                     
            <textarea class="form-control" id="product_description" name="product_description" value ="<?php echo $prdctDesc;?>" ></textarea>
        </div>
        </div>

        <div class="form-group">
        <label class="col-md-4 control-label" for="product_stock">Stock</label>  
        <div class="col-md-4">
        <input type="number" id="product_stock" name="product_stock" placeholder="<?php echo $prdctStock;?>" class="form-control input-md" required="" value ="<?php echo $prdctStock;?>" onkeydown="javascript: return event.keyCode == 69 ? false : true">
            
        </div>
        </div>

        <div class="form-group justify-content-center">
            <label class="col-md-4 control-label" for="product_description"></label>
        <div class="col-md-2" >
            <button id="cancelUpdate" name="cancelAdmin" style="width: 100% !important " class="btn btn-danger">cancel</button>
        </div>
        <div class="col-md-2" >
            <button id="acceptUpdate" name="updateAdmin" style="width: 100% !important " class="btn btn-success">Update</button>
        </div>
        </div>


        </fieldset>
        </form>


        <script type="text/javascript">
              $(function(){
                $('#fileToUpload').change(function(){
                    var input = this;
                    var url = $(this).val();
                    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
                    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
                    {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                        $('#prodImg').attr('src', e.target.result);
                        }
                    reader.readAsDataURL(input.files[0]);
                    }
                    else
                    {
                    $('#prodImg').attr('src', '/assets/no_preview.png');
                    }
                });

                $("#cancelUpdate").click(function(e){
                    e.preventDefault();
                    location.href = '/admin.php';
                });

            });
        

        </script>
    </body>
</html>