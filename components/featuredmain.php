<?php


            $conn = OpenCon();
            $query = ('SELECT * from featured');
            $results = mysqli_query($conn,$query);

            if (mysqli_num_rows($results) > 0)
            {
                while($row = mysqli_fetch_array($results)){
                    $name = $row["name"];
                    $stock = $row['stock'];
                    $urlName = str_replace("-", "", $name);
                    $pathName ="";
                    $usritemid = $row['id'];
                    
                    
                    echo '
                    
                    <dv class="col product-item px-3 ">
                       <div class="border">
                        <div class="product-img mt-3">
                            <img src = "../img/products/' . $urlName . '.jpg" style="position: relative; z-index: 1" alt = "'. $name . '" class="img-fluid d-block mx-auto">';
                            if ($stock < 1){
                                echo 
                                '<img src = "../img/products/soldout.png" style="position: absolute; top:0; left:0 ; z-index:2 "  class="img-fluid pe-2 ps-2">';
                               }
                           echo'
                            <span class="heart-icon">
                                <i class="far fa-heart"></i>
                            </span>
                            <div class= "row btns w-100 mx-auto text-center" style="z-index: 3">
                                <button type="button" onclick="';
                                if($stock <1 )
                                {
                                    echo 'noStock()';
                                }
                                else if ($stock > 0)
                                {
                                    echo 'haveStock(' . $usritemid . ')';
                                }
                                echo '" class="col-6 py-2 add-to-cart">
                                    <i class="fa fa-cart-plus"></i> Add to Cart
                                </button>
                                <button type="button" onclick="location.href=\'/productinfo.php?product=' . $urlName . '\'" class="col-6 py-2">
                                    <i class="fa fa-binoculars"></i> View
                                </button>
                            </div>
                        </div>
                        <div class="product-info p-3 text-center">
                            <span class="product-type">for ' . $row["tag"] . '</span>
                            <a href="#" class="d-block text-decoration-none py-2 product-name">' . $name . '</a>
                            <span class="product-price">₱' . $row["price"] . '</span>
                        </div>
                        </div>
                    </dv>
                    
                    ';
                }
            }
            else
            {
                echo "<div><h6>No items Found</h6></div>";
            }

            

            $conn->close();
            ?>
            

            