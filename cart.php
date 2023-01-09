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


        include('database/connection.php');
    }
    else 
    {
        header("Location: Login.php");
    }
    ?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cart</title>
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
        <header id="hdr">
            <?php 
                include('components/header.php');
            ?>
        </header>
       <main>
        <!--Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" id="modal-x" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="modalbody" class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button id="modal-close" type="button" class="btn btn-success" data-dismiss="modal">
                        OK
                        </button>
                    </div>
                </div>
            </div>
        </div>
        


        <!--!Modal-->
        <!--Shopping Cart-->
            <section id="shoping-cart" class="py-3 mb-5">
                <div class="container-fluid w-75">
                    <h5 class="font-mont font-size-20">Shopping Cart</h5>

                    <!--!Shopping Cart Items-->
                        <di class="row" id="cart-container">
                            
                            
                                <!--!Cart item-->
                                <?php
                                echo ' <div class="col-sm-9 overflow-auto cart-items" >';
                                $userCartItems = "";
                                $userCartQty = "";

                                

                                $counterConnection = 0;
                                $subTotal = 0;
                                $finalStock = [];
                                $myStock = [];
                                $prodArr = [];
                                $netPrice = 0;
                                $finalItems = 0;
                                $smsItems = "";
                                $smsNet = "";
                                $withItem = false;

                                $conn = OpenCon();
                                $query = ("SELECT * FROM accounts WHERE usrID=" . $usrUserId . " AND usrUname='" . $usrUserName . "'");
                                $results = mysqli_query($conn,$query);

                                    if (mysqli_num_rows($results) > 0)
                                    {
                                        while ($row = mysqli_fetch_array($results)) {
                                            $userCartItems = $row['usrCart'];
                                            $userCartQty = $row['usrItemQty'];
                                        }
                                        $userCartItemsArr = explode(",",$userCartItems);
                                        $userCartQtyArr = explode(",",$userCartQty);
                                    }

                                


                                $_SESSION['user_cart'] = $userCartItems;
                                $_SESSION['user_item_qty'] = $userCartQty;
                                foreach ($userCartItemsArr as $items)
                                {
                                    $query = ('SELECT * from products WHERE id = "' . $items  .'"' );
                                    $results = mysqli_query($conn,$query);

                                    if (mysqli_num_rows($results) > 0)
                                    {
                                        while($row = mysqli_fetch_array($results)){
                                            $prodId = $row['id'];
                                            $prodName = $row['name'];
                                            $brand = $row['brand'];
                                            $target = $row['target'];
                                            $tag = $row['tag'];
                                            $price = $row['price'];
                                            $stock = $row['stock'];
                                        }
                                        $prodArr[$counterConnection] = $prodId;
                                        array_push($myStock, $stock);
                                        $subTotal = $subTotal + $price;
                                        $finalStock [$counterConnection]= $userCartQtyArr[$counterConnection] + $stock;
                                        $netPrice = $netPrice + ($price * $userCartQtyArr[$counterConnection]);
                                        $finalItems = $finalItems + $userCartQtyArr[$counterConnection];
                                        echo '
                                            <div class="row border-top py-3 mt-3">
                                                <div class="col-sm-2">
                                                    <img src="img/products/' . str_replace("-","",$prodName). '.jpg" sytle="height:120px;" alt="' . str_replace("-"," ",$prodName) . '" class="img-fluid">
                                                </div>
                                                <div class="col-sm-8">
                                                    <h5 class="font-mont">' . str_replace("-"," ",$prodName) . '</h5>
                                                    <small>by: Alaxan</small>
                                                    <div class="d-flex">' . $tag . '</div>
                                                    <!--!Product Quantity-->
                                                    <div class="qty d-flex pt-2">
                                                        <div class="d-flex font-mont w-100">
                                                            <button id="qtyUp' . $counterConnection . '" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                                                            <input type="text" id="qtyInput' . $counterConnection . '" class="qty_input border px-2 bg-light text-center" style="width: 10vw !important" disabled value="' . $userCartQtyArr[$counterConnection] . '" placeholder="' . $userCartQtyArr[$counterConnection] . '">
                                                            <button id="qtyDown' . $counterConnection . '" class="qty-down border bg-light me-5"><i class="fas fa-angle-down"></i></button>
                                                        </div>
                                                        <button id="delete' . $counterConnection . '" type="submit" class="delete-btn btn font-mont text-danger mx-3 border-right border">Delete</button>
                                                        <button id="update' . $counterConnection . '"type="submit" class="update-btn btn font-mont text-danger border">Update</button>
                                                    </div>
                                                    <!--Product Quantity-->
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <div class="font-size-20 text-gold font-mont">
                                                        <span>₱' . number_format((float)($price * $userCartQtyArr[$counterConnection]), 2, '.', '') . '<span>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        ';
                                        $smsItems = $smsItems . "\\n" . str_replace("-"," ",$prodName) . ": " . $userCartQtyArr[$counterConnection] . "pc(s) x" . number_format((float)($price), 2, '.', '') . "php";
                                        $smsNet = $netPrice;
                                        $counterConnection = $counterConnection + 1;
                                        $withItem = true;
                                        
                                        
                                    }
                                    else
                                    {
                                        echo '<div class="row border-top mt-3 justify-content-center text-center">
                                            <img src="../img/notfound.png" alt="Not Found" class="img-fluid" style="height:60vh !important; width: 60vh !important;">
                                            <h2>No Items Found in your Cart</h2>
                                        </div>';
                                        $withItem = false;
                                    }
                                    
                                }
                                
                                echo '
                                </div>
                                <!--Cart item-->
                                <!--sub total-->
                                <div class="col-sm-3">
                                    <div class="subtotal border text-center mt-2">
                                        <h6 class="font-size-12 font-mont text-success py-3"><i class="fas fa-check"></i>Your Order is Eligible to Free Delivery</h6>
                                        <div class="border-top py-4">
                                            <h5 class="font-mont font-size-20">Subtotal</h5>
                                            <h6 class="font-mont font-size-16">[' . number_format($finalItems) . 'item(s)]</h6>
                                            <h6 class="font-mont font-size-16"><span class="text-gold">₱ <span class="text-gold" id="deal-price">' . number_format((float) $netPrice, 2, '.', '') . '</span></span></h6>
                                            '; if ($withItem){ 
                                                echo'<button onclick="checkOut()" type ="button" class="btn btn-warning mt-3 mx-2">Proceed to Checkout</button>';
                                                }
                                                echo '
                                        </div>
                                    </div>
                                </div>
                                <!--sub total-->
                                <!--Shopping Cart Items-->';
                            ?>
                            
                        </div>
                        
                </div>
                
            </section>
        <!--!Shopping Cart-->
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
            userID = "<?php echo $usrUserId?>";
            userName = "<?php echo $usrUserName?>";
            //get product id
            prodIdArr=[];
            //get maximum product stock (user's cart quantity + products quantity)
            qtyArr = [];
            //get initial product form user's cart quantity before updating
            initialQty = [];
            
            <?php 
                foreach($prodArr as $prodItemId)
                {
                    echo 'prodIdArr.push(' . $prodItemId . ');';
                }
                foreach ($finalStock as $itemStock)
                {
                    
                    echo 'qtyArr.push(' . $itemStock . ');';
                }
                foreach ($userCartQtyArr as $qty)
                {
                    echo 'initialQty.push(' . $qty . ');
                    ';
                }
            ?>

            var smsBody = '<?php echo $smsItems; ?>';
            var smsNet = '<?php echo $smsNet; ?>';

            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
        </script>
         <script src="js/cartupdate.js"></script>
        
    </body>
</html>

