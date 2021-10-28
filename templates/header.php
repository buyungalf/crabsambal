<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/flaticon.css" type="text/css">
<link rel="stylesheet" href="assets/css/barfiller.css" type="text/css">
<link rel="stylesheet" href="assets/css/magnific-popup.css" type="text/css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__cart">
            <div class="offcanvas__cart__links">
                <a href="#"><img src="assets/img/icon/heart.png" alt=""></a>
            </div>
            <div class="offcanvas__cart__item">
                <a href="#">
                    <img src="assets/img/icon/cart.png" alt="">
                    <span>0</span>
                </a>
            </div>
        </div>
        <div class="offcanvas__logo">
            <a href="<?= $base_url ?>"><img src="assets/img/logo.png" alt=""></a>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header__top__inner">
                            <div class="header__logo">
                                <a href="<?= $base_url ?>">
                                    <img src="assets/img/logo.png" alt="" />
                                </a>
                            </div>
                            <div class="header__top__right">
                                <div class="header__top__right__links">
                                    <a href="<?= $base_url ?>wisslist.php">
                                        <img src="assets/img/icon/heart.png" alt="" />
                                    </a>
                                </div>
                                <div class="header__top__right__cart">
                                    <a href="<?= $base_url ?>cart.php">
                                        <img src="assets/img/icon/cart.png" alt="" />
                                        <span style="font-size: 1rem !important;
												left: 2rem !important;
												top: 0 !important;">15</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open"><i class="fa fa-bars"></i></div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="header__menu mobile-menu">
                        <?php

                        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                        $components = explode('/', $path);
                        $page = end($components);

                        ?>
                        <ul>
                            <li class="<?= ($page == "" ? "active" : "") ?>">
                                <a href="<?= $base_url ?>">Beranda</a>
                            </li>
                            <li class="<?= ($page == "about.php" ? "active" : "") ?>">
                                <a href="<?= $base_url ?>about.php">Tentang Kami</a>
                            </li>
                            <li class="<?= ($page == "shop.php" ? "active" : "") ?>">
                                <a href="<?= $base_url ?>shop.php">Produk</a>
                            </li>
                            <li class="<?= ($page == "how-to-buy.php" ? "active" : "") ?>">
                                <a href="<?= $base_url ?>how-to-buy.php">Cara Pembelian</a>
                            </li>
                            <li class="<?= ($page == "contact.php" ? "active" : "") ?>">
                                <a href="<?= $base_url ?>contact.php">Hubungi Kami</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-print"></i> Katalog</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->