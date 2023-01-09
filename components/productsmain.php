<?php
include('..\database\connection.php');
        $forFilter = $_POST['filtered'];
        $connProduct = OpenCon();
        $query = "SELECT * FROM products WHERE name LIKE '%" . $forFilter . "%' OR brand LIKE '%" . $forFilter . "%' OR target LIKE '%" . $forFilter . "%' OR tag LIKE '%" . $forFilter . "%'";


        
        $results = mysqli_query($connProduct,$query);
        if (mysqli_num_rows($results) > 0)
            {
                while($row = mysqli_fetch_array($results)){
                    $name = $row["name"];
                    $stock = $row['stock'];
                    $piecedName = explode("-", $name);
                    $pathName ="";
                    $usritemid = $row['id'];
                    
                    foreach ($piecedName as $piece)
                    {
                        $pathName = $pathName . $piece;
                    }
                    
                    echo '
                    <div class = "col-3 mt-2 pt-2 products-items">
                            <div class="item border p-3>
                                <dv class="product-item main-product style="height: 100%;">
                                    <div class="product-img mx-auto text-center m-2">
                                        <img src = "../img/products/' . $pathName . '.jpg"  style="height:200px; width:400px; position: relative; z-index: 1" alt = "' . str_replace("-", " ", $name) . '" class="img-fluid pe-2 ps-2">';
                                        if ($stock < 1){
                                            echo 
                                            '<img src = "../img/products/soldout.png" style="position: absolute; top:0; left:0 ; z-index:2 "  class="img-fluid pe-2 ps-2">';
                                           }
                                       echo'
                                        <span class="heart-icon">
                                            <i class="far fa-heart"></i>
                                        </span>
                                        <div class= "row btns w-100 mx-auto text-center" style="z-index:3">
                                            <button type="button" onclick="';
                                            if($stock <1 )
                                            {
                                                echo 'noStock()';
                                            }
                                            else if ($stock > 0)
                                            {
                                                echo 'haveStock(' . $usritemid . ')';
                                            }
                                            echo '" class="col-6 py-2">
                                                <i class="fa fa-cart-plus"></i> Add to Cart
                                            </button>
                                            <button type="button" onclick="location.href=\'/productinfo.php?product=' . $name . '\'" class="col-6 py-2">
                                                <i class="fa fa-binoculars"></i> View
                                            </button>
                                        </div> 
                                    </div>
                                    <div class="product-info p-3">
                                        <span class="product-type row justify-content-center">for ' . $row["tag"] . '</span>
                                        <div>
                                        <a href="/productinfo.php?product=' . $name . '" class="d-block text-decoration-none py-2 product-name row text-center">' . str_replace("-"," ",$name) . '</a>
                                        </div>
                                        <span class="product-price row justify-content-center" style="bottom: 0">₱' . $row["price"] . '</span>
                                    </div>
                                </dv>
                            </div>
                        </div>
                    ';
                }
            }
            else
            {
                echo '<div>
                    <img src="../img/notfound.png" alt="Not Found" class="img-fluid" style="height:30vh !important; width: 30vh !important;">
                    <p>Can\'t Find The Product or maybe the product needs a precription, if you have a prescription please contact our doctors</p>
                    <a class="btn btn-success" href="http://m.me/jaed.ordonez" target="_blank">Click Here</a>
                </div>';
            }
            $connProduct->close();
        
        ?>

        