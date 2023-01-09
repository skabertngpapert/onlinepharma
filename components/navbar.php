<nav class="navbar navbar-expand-lg navbar-dark nav-bg" style=" z-index: 999;">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Logo</a>
    <button class="navbar-toggler" id="togglerEffect" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span id="togglerIcon" class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0 font-montAlt">
            <div>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-mont" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Medicines
                </a>
                <ul class="dropdown-menu" id="mediSearch">
                    <li><a class="dropdown-item" href="/#products">Allergy</a></li>
                    <li><a class="dropdown-item" href="/#products">Asthma</a></li>
                    <li><a class="dropdown-item" href="/#products">Blood</a></li>
                    <li><a class="dropdown-item" href="/#products">Brain</a></li>
                    <li><a class="dropdown-item" href="/#products">Cholesterol/Lipid</a></li>
                    <li><a class="dropdown-item" href="/#products">Contraceptive</a></li>
                    <li><a class="dropdown-item" href="/#products">Diabetes</a></li>
                    <li><a class="dropdown-item" href="/#products">Gastro</a></li>
                    <li><a class="dropdown-item" href="/#products">Gout</a></li>
                    <li><a class="dropdown-item" href="/#products">Heart/BP</a></li>
                    <li><a class="dropdown-item" href="/#products">Hormonal</a></li>
                    <li><a class="dropdown-item" href="/#products">Infections</a></li>
                    <li><a class="dropdown-item" href="/#products">Kidney</a></li>
                    <li><a class="dropdown-item" href="/#products">Oral</a></li>
                    <li><a class="dropdown-item" href="/#products">Pain/Fever</a></li>
                    <li><a class="dropdown-item" href="/#products">Skin</a></li>
                    <li><a class="dropdown-item" href="/#products">Wound</a></li>
                </ul>
                </li>
            </div>
            <div>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-mont" href="#products" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Vitamins & Supplements
                </a>
                <ul class="dropdown-menu" id="mediSearch1">
                    <li><a class="dropdown-item" href="/#products">Multivitamins & Minerals</a></li>
                    <li><a class="dropdown-item" href="/#products">Kids & Teens</a></li>
                    <li><a class="dropdown-item" href="/#products">Superfoods</a></li>
                    <li><a class="dropdown-item" href="/#products">Prebiotics & Probiotics</a></li>
                    <li><a class="dropdown-item" href="/#products">Herbal</a></li>
                    <li><a class="dropdown-item" href="/#products">Nutritionals</a></li>
                </ul>
                </li>
            </div>

            <div>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-mont" href="http://m.me/jaed.ordonez" target="_blank" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Consultations
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="http://m.me/jaed.ordonez" target="_blank">GP, Cardio, Endo, ENT, Gastro Teleconsults</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="http://m.me/jaed.ordonez" target="_blank">Women's Health</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="http://m.me/jaed.ordonez" target="_blank">Nutritional, Mental Health, Wellness</a></li>
                </ul>
                </li>
            </div>

            <div>
                <li class="nav-item">
                    <a class="nav-link font-mont" aria-current="page" href="http://m.me/jaed.ordonez" target="_blank">Diagnostics</a>
                </li>
            </div>

            <div>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle font-mont" href="http://m.me/jaed.ordonez" target="_blank" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Got Questions?
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="http://m.me/jaed.ordonez" target="_blank">Ask our Pharmacist</a></li>
                    <li><a class="dropdown-item" href="http://m.me/jaed.ordonez" target="_blank">Contact Us</a></li>
                </ul>
                </li>
            </div>
            
        </ul>
        <?php
        if (isset($_SESSION['user_id']) && isset($_SESSION['user_name'])) {
            echo'<form action="#" class="font-size-14 d-flex font-montAlt">
            <a href="cart.php" class="py-2 rounded-pill nav-cart">
                <span class="font-size-16 px-2 text-dark"><i class="fas fa-shopping-cart ps-2"></i></span>
                <span class="px-3 py-2 rounded-pill text-dark bg-light" id="autoCartData"></span>
            </a>
        </form>';
        }
        ?>
        
        
        
        
    </div>
  </div>
</nav>