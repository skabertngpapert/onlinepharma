<?php
    session_start();
    include('../database/connection.php');
    $userId = $_SESSION['user_id'];
    $userUname = $_SESSION['user_name'];


   
    
    
    $commandButton = $_POST['command']; #update or delete
    $actionButton = $_POST['action']; #product id
    $updateQty = $_POST['toupdate']; #element id

    $updateProdQty = $_POST['newprodqty']; #quantity to be updated

    $conn = OpenCon();
    
    #update products stock id
    $query = ("UPDATE products SET stock=" . $updateProdQty . " WHERE id=" . $actionButton);
    if(mysqli_query($conn, $query))
    {

    }
    else
    {
        echo 'Error Update:' . mysqli_error($conn);
        echo '<script> alert("' . mysqli_error($conn) . '");</script>';
    }
    

    #update featured stock id
    $query = ("UPDATE featured SET stock=" . $updateProdQty . " WHERE id = " . $actionButton );
    if(mysqli_query($conn, $query))
    {

    }
    else
    {
        echo 'Error Update:' . mysqli_error($conn);
    }



    #get account details
    $query = ("SELECT * FROM accounts WHERE usrId=" . $userId . " AND usrUname='" . $userUname . "'");
    $results = mysqli_query($conn,$query);

    #redefining session variables for future usage
    $toUpdateCart = $_SESSION['user_cart'];
    $toUpdateQty = $_SESSION['user_item_qty'];
    $pos = 0;
    if (mysqli_num_rows($results) > 0)
    {
        while($row = mysqli_fetch_array($results)){
            $usrCart = $row['usrCart'];
            $usrItemQty = $row['usrItemQty'];
        }
        if ($commandButton == "delete")
        {
            $usrCartArr = explode(",",$usrCart);
            $usrCartQtyArr = explode(",", $usrItemQty);
            $pos = array_search($actionButton,$usrCartArr);
            unset($usrCartArr[$pos]);
            unset($usrCartQtyArr[$pos]);
            $toUpdateCart = implode(",",$usrCartArr);
            $toUpdateQty = implode(",",$usrCartQtyArr);


        }
        else if ($commandButton == "update")
        {
            $usrCartArr = explode(",",$usrCart);
            $usrCartQtyArr = explode(",", $usrItemQty);
            $pos = array_search($actionButton,$usrCartArr);
            $usrCartQtyArr[$pos] = $updateQty; 
            $toUpdateCart = implode(",",$usrCartArr);
            $toUpdateQty = implode(",",$usrCartQtyArr);
        }
    }


    #update user cart item and  quantity
    $query = ("UPDATE accounts SET usrCart ='" . $toUpdateCart . "', usrItemQty='" . $toUpdateQty . "' WHERE usrId =" . $userId . " AND usrUname ='" . $userUname . "'");
    if(mysqli_query($conn, $query))
    {
    }
    else
    {
        echo 'Error Update:' . mysqli_error($conn);
        echo '<script> alert("' . mysqli_error($conn) . '");</script>';
    }


    #re-assigning session variable
    $_SESSION['user_cart'] = $toUpdateCart;
    $_SESSION['user_item_qty'] = $toUpdateQty;

    #reassigning variables
    $userCartItems = $toUpdateCart;
    $userCartQty = $toUpdateQty;

    $userCartItemsArr = explode(",",$userCartItems);
    $userCartQtyArr = explode(",",$userCartQty);

    $counterConnection = 0;
    $subTotal = 0;
    $finalStock = [];
    $myStock = [];
    $netPrice = 0;
    $finalItems = 0;
    $smsItems = "";
    $smsNet = "";
    $withItem = false;
    echo ' <div class="col-sm-9 overflow-auto cart-items" >';
    $conn = OpenCon();
    
    foreach ($userCartItemsArr as $items)
    {
        $query = ('SELECT * from products WHERE id = "' . $items  .'"' );
        $results = mysqli_query($conn,$query);

        if (mysqli_num_rows($results) > 0)
        {
            while($row = mysqli_fetch_array($results)){
                $prodName = $row['name'];
                $brand = $row['brand'];
                $target = $row['target'];
                $tag = $row['tag'];
                $price = $row['price'];
                $stock = $row['stock'];
            }

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
                                <button id="qtyUp' . $items . '" class="qty-up border bg-light"><i class="fas fa-angle-up"></i></button>
                                <input type="text" id="qtyInput' . $items . '" class="qty_input border px-2 bg-light text-center" style="width: 10vw !important" disabled value="' . $userCartQtyArr[$counterConnection] . '" placeholder="' . $userCartQtyArr[$counterConnection] . '">
                                <button id="qtyDown' . $items . '" class="qty-down border bg-light me-5"><i class="fas fa-angle-down"></i></button>
                            </div>
                            <button id="delete' . $items . '" type="submit" class="delete-btn btn font-mont text-danger mx-3 border-right border">Delete</button>
                            <button id="update' . $items . '"type="submit" class="update-btn btn font-mont text-danger border">Update</button>
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