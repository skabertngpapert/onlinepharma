<?php
    session_start();
    
    $usrUserName = "";
    $usrUserId = "";

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))
    {
        $usrUserName = $_SESSION['user_name'];
        $usrUserId = $_SESSION['user_id'];
        $usrName = $_SESSION['account_name'];
        $usrEmail = $_SESSION['account_name'];
        $usrPhone = $_SESSION['account_phone'];
    }
    ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thesis</title>
        <link rel="shortcut icon" href="#" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/navbarStyle.css">
        <link rel="stylesheet" href="css/headerStyle.css">
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="css/allStyle.css">    
        <link rel="stylesheet" href="css/banner.css">    
        <link rel="stylesheet" href="css/owlcarousel/owl.carousel.css">
        <link rel="stylesheet" href="css/owlcarousel/owl.theme.default.css">

        <script src="js/jquery.js"></script>
        <script src="js/products.js"></script>
    </head>
    <body>
        <!-- Header -->
        <header>
            <?php 
                include('components/header.php');
            ?>
        </header>
        <?php 
            $prodName = $_GET['product'];
            $productExp = explode("-",$prodName);
            $productName = "";
            foreach($productExp as $i)
            {
                $productName = $productName . " " . $i;
            }
            $productName = rtrim($productName);
            $haveStock = false;
            include('database\connection.php');
            $conn = OpenCon();
            $query = ('SELECT * from products WHERE name = "' . $prodName  .'"' );
            $results = mysqli_query($conn,$query);

            if (mysqli_num_rows($results) > 0)
            {
                while($row = mysqli_fetch_array($results)){
                $usritemid = $row['id'];
                    $brand = $row['brand'];
                    $target = $row['target'];
                    $tag = $row['tag'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $stock = $row['stock'];
                }
            }
            else
            {
                echo "<div><h6>No items Found</h6></div>";
            }

            $conn->close();

            if ($stock > 0)
            {
                $haveStock = true;    
            }
            else
            {
                $haveStock = false;
            }
        ?>
    
        <!-- main section-->
        <main id="productsInfo">
            <section id="product" class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="img\products\<?php echo str_replace("-","",$prodName);?>.jpg"  style="position: relative; z-index: 1" alt="product" class="img-fluid" style="width: 100% !important">
                            <?php if ($stock < 1){
                                echo 
                                '<img src = "img/products/soldout.png" style="position: absolute; top:0; left:0 ; z-index:2 "  class="img-fluid pe-2 ps-2">';
                                }
                            ?>
                            <div class="row pt-4 font-size-16 font-mont">
                                <div class="col">
                                    <button type="submit" class="btn btn-danger form-control" onclick="<?php
                                            if($stock <1 )
                                            {
                                                echo 'noStock()';
                                            }
                                            else if ($stock > 0)
                                            {
                                                echo 'haveStockBuyNow(' . $usritemid . ')';
                                            }?>">Proceed to Buy</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-warning form-control" onclick=" 
                                        <?php
                                            if($stock <1 )
                                            {
                                                echo 'noStock()';
                                            }
                                            else if ($stock > 0)
                                            {
                                                echo 'haveStock(' . $usritemid . ')';
                                            }?>" >Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 py-5">
                            <h5 class="font-montAlt font-size-20">
                            <?php echo $productName;?>    
                            </h5>
                            <small>Brand: <?php echo $brand; ?></small>
                            <hr class="m-0">
                            <!-- #price -->
                            <table class="my-3">
                                <tr class="font-montAlt font-size-14">
                                    <td class="font-size-20 text-warning">
                                        Price: <span>₱ <?php echo $price; ?>.00<span>
                                    </td>
                                </tr>
                            </table>
                            <!-- !price -->

                            <!-- #policy -->
                            <div id="policy">
                                <div class="d-flex justify-content-around">
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2">
                                            <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                        </div>
                                        <p class="font-mont font-size-12">3 Days <br>Replacement</p>
                                    </div>
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2">
                                            <span class="fas fa-truck border p-3 rounded-pill"></span>
                                        </div>
                                        <p class="font-mont font-size-12">Same day <br> Delivery</p>
                                    </div>
                                    <div class="return text-center mr-5">
                                        <div class="font-size-20 my-2">
                                            <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                        </div>
                                        <p class="font-mont font-size-12">10 Days <br>Warranty</p>
                                    </div>
                                </div>
                            </div>
                            <!-- !policy -->

                            
                            <hr>
                            
                            <!-- !order-details-->
                            <div id="orderDetails" class="font-mont d-flex flex-column text-dark">
                                <small>Delivered by: <strong id="deliverDate">Dec 15 - Dec 16</strong></small>
                                <small><i class="fa-solid fa-cubes-stacked"></i>&nbsp;&nbsp; Stocks Left: <?php echo $stock;?> boxes (50 pcs per box) </small>
                                <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp; Delivery by pharmacy personel </small>
                            </div>
                            <!-- #order-details-->

                            <div class="row">
                                <div class="col">
                                    <div class="qty d-flex">
                                        <h6 class="font-mont">Quantity:</h6>
                                        <div class="px-4 d-flex font-montAlt">
                                            <button class="qty-up border bg-light" <?php if($haveStock == false){echo 'disabled';}?>><i class="fas fa-angle-up"></i></button>
                                            <input type="text" class="qty_input border px-2 w-25 bg-light text-center" disabled value="<?php if($haveStock == false){echo '0';}else{echo '1';}?>" placeholder="<?php if($haveStock == false){echo 'Out of Stock';}else{echo '1';}?>">
                                            <button class="qty-down border bg-light" <?php if($haveStock == false){echo 'disabled';}?>><i class="fas fa-angle-down"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-5">
                        <h6 class="font-montAlt font-size-20">Product Description</h6>
                        <hr>
                        <p class="font-montAlt font-size-14"><?php echo $description;?></p>
                    </div>
                </div>
            </section>

            <section id="featured">
                <?php
                    include('components/featured.php');
                ?>
            </section>
        </main>

        <!--footer-->
        <footer class="text-center text-lg-start text-white footer mt-5">
            <?php
                include('components/footer.php');
            ?>
        </footer>
        
        <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/owlcarousel/owl.carousel.js"></script>
        <script src="js/navbarJs.js"></script>
        
        <script src="js/owlcarousel.js"></script>
       
        
        <script>
            
            let itemQuantity = <?php echo $stock?>;
            let $qty_up = $(".qty .qty-up");
            let $qty_down = $(".qty .qty-down");
            let $inputQty = $(".qty .qty_input");
            $qty_up.click(function(e){
                if (itemQuantity > $inputQty.val() && $inputQty.val() != 0)
                {
                    $inputQty.val(function(i, oldval)
                    {
                        return ++oldval;
                    });
                }
            });
            $qty_down.click(function(e){
                if ($inputQty.val() > 1 && $inputQty.val() <= itemQuantity)
                {
                    $inputQty.val(function(i, oldval)
                    {
                        return --oldval;
                    });
                }
            });
            
            
            $(function(){
                const months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!

                today = months[parseInt(mm)-1] + ' ' + dd + ' - ' + (parseInt(dd) + 1);
                
                $("#deliverDate").html(today);
            });
        </script>
        
        <script type="text/javascript">
            const userID = "<?php echo $usrUserId?>";
            const userName = "<?php echo $usrUserName?>";



            function noStock() {
                var modaltitle = $("#exampleModalLabel");
                var modalbody = $("#modalbody");
                var modalok = $("#modalok");
                modaltitle.html("Add to Cart");
                modalbody.html("Item Sold Out");
                modalok.html("Ok");
                myModal.show();
            }

            function haveStock(itemId) {
                
                if (userID == "" || userName == "")
                {
                    location.href = '/login.php';
                }
                else
                {
                    
                    $.ajax({
                        
                        url: "database/addtocart.php",
                        type: "POST",
                        data: {'usrname': userName,
                                'usrid': userID, 
                                'itemid': itemId
                            },
                        success: function(data)
                                    {
                                        var modaltitle = $("#exampleModalLabel");
                                        var modalbody = $("#modalbody");
                                        var modalok = $("#modalok");
                                        modaltitle.html("Add to Cart");
                                        modalbody.html("Item Added to Cart");
                                        modalok.html("Ok");
                                        myModal.show();
                                    }
                    });
                }
            }

            function haveStockBuyNow(itemId) {
                
                if (userID == "" || userName == "")
                {
                    location.href = '/login.php';
                }
                else
                {
                    
                    $.ajax({
                        
                        url: "database/addtocart.php",
                        type: "POST",
                        data: {'usrname': userName,
                                'usrid': userID, 
                                'itemid': itemId
                            },
                        success: function(data)
                                    {
                                        window.location.href = "cart.php";
                                    }
                    });
                }
            }
        </script>
        
    </body>
</html>