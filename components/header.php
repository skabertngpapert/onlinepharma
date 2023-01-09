
<header id="header">
    <div class="strip d-flex justify-content-between px-4 py-1 bg-light">
        <p class="pt-1 font-mont font-size-12 font-text-black-50 m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry</p>
        <div class="font-mont font-size-14">
            <?php
            if (isset($_SESSION['user_id']) && isset($_SESSION['user_name']))
            {
                echo '<a href="#" class="px-3 border-right border-left text-dark ">' . $_SESSION['account_name'] . '</a>
                        <a href="logout.php" class="px-3 border-right text-dark ">logout</a>';
                
            }
            else
            {
                $loginurl = '/index.php/login.php';
                $loginpage = '/login.php';
                $currentpage = $_SERVER['REQUEST_URI'];

                if ($currentpage == $loginpage || $currentpage == $loginurl) {
                    
                }
                else
                {
                    echo '<a href="login.php" class="px-3 border-right border-left text-dark ">Login</a>';
                }
                
            }
            ?>
            
            
        </div>
    </div>
    <!-- Nav Bar -->
    <?php 
    include('navbar.php');
    ?>
</header>

