<?php session_start();?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/allStyle.css">
    <link rel="stylesheet" href="css/navbarStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="js/jquery.js"></script>
    <title>Login/Register</title>
</head>

<body>

        <header style="position:relative; z-index:99999;">
            <?php 
                include('components/header.php');
            ?>
        </header>
        <main style="z-index: 1">
            <?php
                if (isset($_GET['error'])){
            ?>
                <p class="error"> <?php echo $_GET['error'];?></p>
            <?php } ?>  
            <!-- blue circle background -->
            <div class="whole-bg"></div>
            <div class="my-content">
            <div class="d-none d-md-block ball login bg-danger bg-gradient position-absolute rounded-circle" style="z-index: 2;"></div>

            <!-- logo name -->

            <!-- Login Section -->
            <div class="container login__form active" style="z-index: 3;">
                <div class="row vh-100 w-100 align-self-center">
                    <div class="col-12 col-lg-6 col-xl-6 px-5">
                        <div class="row vh-100">
                            <div class="col align-self-center p-5 w-100">
                                <?php 
                                    if(isset($_SESSION['errlogin']))
                                    {
                                        if ($_SESSION['errlogin'] == "nomatch")
                                        {
                                            echo '<h6 class="text-danger">Login Failed: Username or Password do not match</h6>';
                                        }
                                        unset($_SESSION['errlogin']);
                                        
                                    }
                                    if(isset($_SESSION['reg']))
                                    {
                                        if ($_SESSION['reg'] == "usernameReq")
                                        {
                                            echo '<h6 class="text-danger">Username Required</h6>';
                                        }
                                        if ($_SESSION['reg'] == "passwordReq")
                                        {
                                            echo '<h6 class="text-danger">Password Required</h6>';
                                        }
                                        if ($_SESSION['reg'] == "emailReq")
                                        {
                                            echo '<h6 class="text-danger">Email Required</h6>';
                                        }
                                        if ($_SESSION['reg'] == "phoneReq")
                                        {
                                            echo '<h6 class="text-danger">Username Required</h6>';
                                        }
                                        if ($_SESSION['reg'] == "mysqlerror")
                                        {
                                            echo '<h6 class="text-danger">MySql Error '. $_SESSION['regmysql'].'</h6>';
                                        }
                                        if ($_SESSION['reg'] == "usernameTaken")
                                        {
                                            echo '<h6 class="text-danger">Username Taken</h6>';
                                        }
                                        if ($_SESSION['reg'] == "success")
                                        {
                                            echo '<h6 class="text-danger">SignUp Complete</h6>';
                                        }
                                        unset($_SESSION['reg']);
                                    }

                                ?>
                                <h3 class="fw-bolder">LOGIN HERE !</h3>
                                <p class="fw-lighter fs-6">Don't have an account, <span id="signUp" role="button" class="text-primary tab-change font-size-20">Sign Up&rarr;</span></p>
                                <!-- form login section -->
                                <form action="loginconfirm.php" class="mt-5" method="post">
                                    <div class="mb-3">
                                        <label for="uname" class="form-label">Username</label>
                                        <input type="text" name="uname" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="d-flex position-relative">
                                            <input type="password" name="password" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Password" required>
                                            <span class="password__icon eye-slash fs-4 fw-bold bi bi-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="col text-center">
                                        <input type="submit" class="btn my-btn btn-lg rounded-pill mt-4 w-100" value="Login">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                        <div class="row vh-100 p-5">
                            <div class="col align-self-center p-5 text-center">
                                <img src="img/bg/login.png" class="bounce" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Register Section -->
            <div class="container register__form" style="z-index: 3;">
                <div class="row vh-100 w-100 align-self-center">
                    <div class="d-none d-lg-block col-lg-6 col-xl-6 p-5">
                        <div class="row vh-100 p-5">
                            <div class="col align-self-center p-5 text-center">
                                <img src="img/bg/register.png" class="bounce" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 col-xl-6 px-5">
                        <div class="row vh-100">
                            <div class="col align-self-center p-5 w-100" style="z-index:999;">
                                <h3 class="fw-bolder">REGISTER HERE !</h3>
                                <p class="fw-lighter fs-6">Have an account, <span id="signIn" role="button" class="text-primary tab-change2 font-size-20">&larr;Sign In</span></p>
                                <!-- form register section -->
                                <form action="signupconfirm.php" class="mt-5" action="get">
                                    <div class="mb-3">
                                        <label for="suname" class="form-label">Username</label>
                                        <input type="text" name="suname" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="spassword" class="form-label">Password</label>
                                        <div class="d-flex position-relative">
                                            <input type="password" name="spassword" class="form-control text-indent auth__password shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Password" required>
                                            <span class="password__icon eye-slash text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sname" class="form-label">Name</label>
                                        <input type="text" name="sname" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="semail" class="form-label">Email</label>
                                        <input type="email" name="semail" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" placeholder="Email@Email.com" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="sephone" class="form-label">Phone</label>
                                        <input type="tel" name="sphone" class="form-control text-indent shadow-sm bg-grey-light border-0 rounded-pill fw-lighter fs-7 p-3" pattern="^(09|\+639)\d{9}$" placeholder="09123456789" required>
                                    </div>
                                    
                                    <div class="col text-center">
                                        <input type="submit" class="btn my-btn btn-lg rounded-pill mt-4 w-100" value="SignUp">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </main>
    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="js/navbarJs.js"></script>
    <script src="js/login.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>

























<!--
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" href="css/login.css" >
        <script src="js/jquery.js"></script>
    </head>
    <body>
    

    <div class="cover-container">
        <div class="masthead clearfix">
            <div class="inner">
                <h3 class="masthead-brand"></h3>
                <ul class="nav masthead-nav">
                </ul>
            </div>
        </div>
        <div class="inner cover">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign Up It's free and always will be.</h3>
                </div>
                <div class="panel-body">
                     
                    <ul id="dTab" class="nav nav-tabs">
                        <li class="active"><a href="#pane1" data-toggle="tab">Register</a></li>
                        <li><a href="#pane2" data-toggle="tab">Login</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="pane1" class="tab-pane fade in active">
                            
                            <form action="signupconfirm.php" method="POST">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="control-label" for="suname">Username</label>
                                        <input type="text" id="username" name="suname" placeholder="Username can contain any letters or numbers" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        
                                        <label class="control-label" for="spassword">Password</label>
                                        <input type="password" id="password" name="spassword" placeholder="Password should be at least 4 characters" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                       
                                        <label class="control-label" for="password_confirm">Password (Confirm)</label>
                                        <input type="password" id="password_confirm" name="password_confirm" placeholder="Please confirm password" class="form-control" />
                                    </div>
                                    <button class="btn btn-success">Register</button>
                                </fieldset>
                            </form>
                        </div>
                        <div id="pane2" class="tab-pane fade">
                           
                            <form role="form" action="loginconfirm.php" method="POST">
                                <div class="form-group">
                                    <label for="uname">Username</label>
                                    <input type="email" class="form-control" name="uname" placeholder="Username" />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="Password" />
                                </div>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                            
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

    <script src="js/bootstrap/bootstrap.bundle.js"></script>
    <script>
        $(document).ready(function () {
            $("#forgetBtn").click(function () {
                $("#dTab li:eq(2) a").tab("show");
                $(".tab-content div.active").removeClass("active in");
                $(".tab-content").find("#pane3").addClass("active in");
            });
            $("#loginBtn").click(function () {
                $("#dTab li:eq(1) a").tab("show");
                $(".tab-content div.active").removeClass("active in");
                $(".tab-content").find("#pane2").addClass("active in");
            });
        });

    </script>

    
        <form action="loginconfirm.php" method="post">
            <h2>Login</h2>
        
            <label for="uname"> User Name </label>
            <input type="text" name="uname" id="" placeholder="Username"><br>
            <label for="password">Password</label>
            <input type="password" name="password" id="" placeholder="Password">
            <button type="submit">Login</button>
        </form>
               

    </body>
</html>




</div>
-->

                                                                            