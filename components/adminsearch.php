<?php
include('../database/connection.php');
$adminFilter = $_POST['adminFilter'];
        $conn = OpenCon();
        $query = "SELECT * FROM featured";
        $featuredArray = [];
        $featuredId = 0;
        $results = mysqli_query($conn,$query);
        if (mysqli_num_rows($results) > 0) {
            while ($row = mysqli_fetch_array($results)) {
                $featuredArray[$featuredId] = $row['id'];
                $featuredId += 1;
            }
        }

        $query = "SELECT * FROM products WHERE name LIKE '%" . $adminFilter . "%' OR brand LIKE '%" . $adminFilter . "%' OR target LIKE '%" . $adminFilter . "%' OR tag LIKE '%" . $adminFilter . "%'";
        $prdctCount = 0;
        $prdctCountArr = [];


        $productFeatured = 0;
        $results = mysqli_query($conn,$query);
if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_array($results)) {
        $prdctId = $row['id'];
        $prdctName = $row['name'];
        $prdctBrand = $row['brand'];
        $prdctTarget = $row['target'];
        $prdctPrice = $row['price'];
        $prdctTag = $row['tag'];
        $prdctDescription = $row['description'];
        $prdctStock = $row['stock'];

        $prdctExpName = explode("-", $prdctName);
        $prdctPath = implode("", $prdctExpName);
        echo '
                        <div class="col-4 my-1 py-2 border-bottom border-start border-top">
                            <img src = "img/products/' . $prdctPath . '.jpg" style = "width: 100%; height: 35vh"alt = "' . str_replace("-", " ", $prdctName) . '" class="img-responsive">
                            
                        </div>
                        <div class="col-4 my-1 border-bottom border-top" style="padding-top: 2%">
                            <h4 id="prodName' . $prdctId . '"><strong>Name:</strong> ' . str_replace("-", " ", $prdctName) . '</h4>
                            <h6 id="prodBrand' . $prdctId . '"><strong>Brand:</strong> ' . $prdctBrand . '</h4>
                            <h6 id="prodTarget' . $prdctId . '"><strong>Target:</strong> ' . $prdctTarget . '</h4>
                            <h6 id="prodTag' . $prdctId . '"><strong>For:</strong> ' . $prdctTag . '</h4>
                            <h6 id="prodPrice' . $prdctId . '"><strong>Price:</strong> ' . $prdctPrice . '</h4>
                            <h6 id="prodStock' . $prdctId . '"><strong>Stock:</strong> ' . $prdctStock . '</h4>
                            <h6 id="prodDesc' . $prdctId . '"><strong>Description:</strong> ' . $prdctDescription . '</h4>
                        </div>
                        <div class="col-4 text-center my-1 border-bottom border-top border-end" style="padding-top: 5%">
                        
                            <div class="col-6 d-flex justify-content-between">
                                
                                <button class="btn btn-warning admin-update" id="adminUpdate' . $prdctId . '">Update</button>
                                <button class="btn btn-danger admin-delete" id="adminDelete' . $prdctId . '">Delete</button>
                            </div>
                            
                            <div class="col-6 mt-2">
                                ';
                                $isFeatured = false;
                                    foreach ($featuredArray as $inFeatured)
                                    {
                                        if ($inFeatured == $prdctId)
                                        {
                                            echo '<button class="btn btn-secondary admin-remove w-100" id="adminRemove' . $prdctId . '" ">Remove from Featured</button>';
                                            $isFeatured = true;
                                        }
                                    }
                                    if (!$isFeatured)
                                    {
                                        echo '<button class="btn btn-sucess admin-featured w-100 mb-1" id="adminFeatured' . $prdctId . '" ">Add to Featured</button>';
                                    }
                            
                                
                                
                            echo '</div>
                            
                        </div>
                        
                ';
                $prdctCountArr[$prdctCount] = $prdctId;
                $prdctCount += 1;
    }
}
else
{
    echo '
    <div class="col-12 my-1 py-2 border text-center">
        <img src="../img/notfound.png" style = "width: 100%; height: 100vh"alt = "" class="img-responsive">
        <h2> No Items Found</h2>
    </div>
    ';
}

?>