<?php
    session_start();

    $usrUserName = "";
    $usrUserId = "";

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['admin']))
    {
        if ($_SESSION['admin'] == 0)
        {
            $usrUserName = $_SESSION['user_name'];
            $usrUserId = $_SESSION['user_id'];
            $usrLevel = $_SESSION['admin'];
        
        }
        else
        {
            header("Location: /");
        }
        
    }
    // else
    // {
    //     header("Location: /");
    // }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Thesis</title>
        <link rel="shortcut icon" href="#" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" >

        <script src="js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    </head>
    <body>
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
        <div class="container">
            <div class="row py-5">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/admin.php">Admin Panel</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin.php">Products <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/usersedit.php">Users</a>
                    </li>
                    </ul>
                    <ul class="navbar-nav justify-content-right" style="float: right">
                    <li class="nav-item mr-1"><a href="logout.php" class="nav-link">Logout</a></li>
                </div>
            </nav>

            
            
            <div class="row px-5"  id="adminControl" >
           
                <?php
                 include('components/addproduct.php');
                ?>
            </div>
            </div>
        </div>
    
    
        <script src="js/bootstrap/bootstrap.bundle.js"></script>
        
       
        <script type="text/javascript">
            
            var prdctCount = <?php echo $prdctCount; ?>;
            var prdctCountArr = [];
           

                var myModal = new bootstrap.Modal(document.getElementById("exampleModal"),{});
                $("#modal-close").click(function(){
                myModal.hide();
                });
                $("#modal-x").click(function(){
                    myModal.hide();
                });
        
            
            <?php 
            
                foreach ($prdctCountArr as $prdctsId)
                {
                    echo 'prdctCountArr.push(' . $prdctsId . ');';
                }
            ?>
            

            $(document).ready(function () {
                $("#adminSearch").on("input", function () {
                    var vall = $(this).val();
                    $(".control-panel").load("../components/adminsearch.php", {
                    adminFilter: vall,
                    });
                });

                $(".control-panel").on("click", ".admin-delete", function () {
                    var idToDelete = $(this).attr("id");
                    var topassID = 0;
                    Array.from(prdctCountArr).forEach((number) => {
                    if (idToDelete === "adminDelete" + number) {
                        topassID = number;
                    }
                    });
                    $.ajax({
                    url: "components/admindelete.php",
                    type: "POST",
                    data: { adminDeleteId: topassID },
                    success: function (data) {
                        var modaltitle = $("#exampleModalLabel");
                        var modalbody = $("#modalbody");
                        var modalok = $("#modalok");
                        modaltitle.html("Delete Product");
                        modalbody.html("Product Deleted");
                        modalok.html("Ok");
                        myModal.show();
                        
                        window.setTimeout(function(){
                            window.location.href = "/admin.php";

                        }, 5000);
                                               
                        
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    },
                    });
                });

                $(".control-panel").on("click", ".admin-featured", function () {
                    var idToDelete = $(this).attr("id");
                    var topassID = 0;
                    Array.from(prdctCountArr).forEach((number) => {
                    if (idToDelete === "adminFeatured" + number) {
                        topassID = number;
                    }
                    });
                    $.ajax({
                    url: "components/adminfeatured.php",
                    type: "POST",
                    data: { adminFeaturedId: topassID },
                    success: function (response) {

                        if (response == 'true')
                        {
                            var modaltitle = $("#exampleModalLabel");
                            var modalbody = $("#modalbody");
                            var modalok = $("#modalok");
                            modaltitle.html("Add To Featured");
                            modalbody.html("Product Added To Featured");
                            modalok.html("Ok");
                            myModal.show();
                        }
                        else
                        {
                            var modaltitle = $("#exampleModalLabel");
                            var modalbody = $("#modalbody");
                            var modalok = $("#modalok");
                            modaltitle.html("Add To Featured");
                            modalbody.html("Product is already in Featured");
                            modalok.html("Ok");
                            myModal.show();
                        }
                        
                        
                        window.setTimeout(function(){
                            window.location.href = "/admin.php";

                        }, 5000);
                                               
                        
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    },
                    });
                });


                $(".control-panel").on("click", ".admin-remove", function () {
                    var idToDelete = $(this).attr("id");
                    var topassID = 0;
                    Array.from(prdctCountArr).forEach((number) => {
                    if (idToDelete === "adminRemove" + number) {
                        topassID = number;
                    }
                    });
                    $.ajax({
                    url: "components/adminremove.php",
                    type: "POST",
                    data: { adminFeaturedId: topassID },
                    success: function (response) {

                        if (response == 'true')
                        {
                            var modaltitle = $("#exampleModalLabel");
                            var modalbody = $("#modalbody");
                            var modalok = $("#modalok");
                            modaltitle.html("Remove from Featured");
                            modalbody.html("Product Removed from Featured");
                            modalok.html("Ok");
                            myModal.show();
                        }
                        else
                        {
                            var modaltitle = $("#exampleModalLabel");
                            var modalbody = $("#modalbody");
                            var modalok = $("#modalok");
                            modaltitle.html("Remove from Featured");
                            modalbody.html("Product is not on Featured");
                            modalok.html("Ok");
                            myModal.show();
                        }
                        
                        
                        window.setTimeout(function(){
                            window.location.href = "/admin.php";

                        }, 5000);
                                               
                        
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        alert(err.Message);
                    },
                    });
                });


                $(".control-panel").on("click", ".admin-update", function () {
                    var idToUpdate = $(this).attr("id");
                    var topassID = 0;
                    
                    Array.from(prdctCountArr).forEach((number) => {
                    if (idToUpdate === "adminUpdate" + number) {
                        topassID = number;
                    }
                    });

                    var prdctName = $("#prodName" + topassID ).text();
                    var prdctBrand = $("#prodBrand" + topassID ).text();
                    var prdctTarget = $("#prodTarget" + topassID ).text();
                    var prdctTag = $("#prodTag" + topassID ).text();
                    var prdctPrice = $("#prodPrice" + topassID ).text();
                    var prdctDesc = $("#prodDesc" + topassID ).text();
                    var prdctStock = $("#prodStock" + topassID ).text();


                    
                    prdctName = prdctName.replace("Name: ","");
                    prdctBrand = prdctBrand.replace("Brand: ","");
                    prdctTarget = prdctTarget.replace("Target: ","");
                    prdctTag = prdctTag.replace("For: ","");
                    prdctPrice = prdctPrice.replace("Price: ","");
                    prdctDesc = prdctDesc.replace("Description: ","");
                    prdctStock = prdctStock.replace("Stock: ","");
                    console.log(prdctDesc);

                    if (prdctDesc === "" || prdctDesc === null || prdctDesc === '\0')
                    {
                        prodctDesc = "Description";
                    }

                    
                    window.location.href = "/updateproduct.php?Id=" + topassID + "&Name=" + prdctName + "&Brand=" + prdctBrand + "&Target=" + prdctTarget + "&Tag=" + prdctTag + "&Price=" + prdctPrice + "&Stock=" + prdctStock + "&Desc=" + prdctDesc + "";
                });


              
            });
    
 

        </script>

        

    </body>
</html>