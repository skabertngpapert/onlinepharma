<?php
    session_start();

    $usrUserName = "";
    $usrUserId = "";

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_name']))
    {
        $usrUserName = $_SESSION['user_name'];
        $usrUserId = $_SESSION['user_id'];
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
    
        
        <?php include('database/connection.php');?>
        <!-- Header -->
        <header id="hdr">
            <?php 
                include('components/header.php');
            ?>
        </header>
        
    
        <!-- main section-->
        <main>
            <section>
                <?php
                    include('components/banner.php');
                ?>
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

            </section>
            <section id="featured">
                <?php
                    include('components/featured.php');
                ?>
            </section>
            <section id="products">
                <?php 
                    include('components/products.php');
                ?>
            </section>
          
        </main>

        <!--footer-->
        <footer class="text-center text-lg-start text-white footer mt-5" >
            <?php
                include('components/footer.php');
            ?>
        </footer>
        
        <script src="js/bootstrap/bootstrap.bundle.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="js/owlcarousel/owl.carousel.js"></script>
        <script src="js/navbarJs.js"></script>
        <script src="js/owlcarousel.js"></script>
        <script type="text/javascript">
           
            
            const userID = "<?php echo $usrUserId?>";
            const userName = "<?php echo $usrUserName?>";
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});
            

            $("#mediSearch").on("click","a",function(){
                var anchorVal = $(this).text();
                if (anchorVal.includes("/"))
                {
                    var splitText = anchorVal.split("/");
                    $("#productSubmit").val(splitText[0]);
                    $("#productSubmit").trigger("input");
                }
                else
                {
                    $("#productSubmit").val(anchorVal);
                    $("#productSubmit").trigger("input");
                }
                
            });

            $("#mediSearch1").on("click","a",function(){
                var anchorVal = $(this).text();
                if (anchorVal.includes("&"))
                {
                    var splitText = anchorVal.split(" ");
                    $("#productSubmit").val(splitText[0]);
                    $("#productSubmit").trigger("input");
                }
                else
                {
                    $("#productSubmit").val(anchorVal);
                    $("#productSubmit").trigger("input");
                }
                
            });
            
            $("#modal-close").click(function(){
                myModal.hide();
            });
            $("#modal-x").click(function(){
                myModal.hide();
            });

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
                                'itemid': itemId,
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
        </script>
    </body>
</html>