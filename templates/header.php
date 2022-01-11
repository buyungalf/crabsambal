<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<!-- Css Styles -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/elegant-icons.css" type="text/css">
<link rel="stylesheet" href="assets/css/nice-select.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/slicknav.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>

<body>

    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <?php
    // session_destroy();

    $user = $_SESSION['user'] ?? [];

    $sid = session_id();

    $cart_total_result = mysqli_query(
        $koneksi,
        "SELECT SUM(jumlah) as cartTotal FROM orders_temp WHERE id_session='{$sid}'"
    );

    $cart = mysqli_fetch_array($cart_total_result);
    ?>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__cart">
            <div class="offcanvas__cart__links">
                <a href="#"><img src="assets/img/icon/heart.png" alt=""></a>
            </div>
            <div class="offcanvas__cart__item">
                <a href="cart">
                    <img src="assets/img/icon/cart.png" alt="">
                    <span> <?= $cart['cartTotal'] !== null ? $cart['cartTotal'] : 0  ?></span>
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
                            <div class="header__top__left">

                                <?php if (!empty($user)) : ?>
                                    <ul>
                                        <li><a href="dashboard.php">Hi, <?= explode(' ', $user['nama'])[0] ?? "" ?></a></li>
                                        <li><a href="orders.php">orders</a></li>
                                        <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                <?php else : ?>
                                    <ul>
                                        <li><a href="login.php">Login</a></li>
                                    </ul>
                                <?php endif ?>
                            </div>
                            <div class="header__top__right">
                                <div class="header__top__right__cart">
                                    <a href="cart">
                                        <img src="assets/img/icon/cart.png" alt="" />
                                        <span style="font-size: 1rem !important;
												left: 2rem !important;
												top: 0 !important;">
                                            <?= $cart['cartTotal'] !== null ? $cart['cartTotal'] : 0  ?>
                                        </span>
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
                            <li class="<?= ($page == "about" ? "active" : "") ?>">
                                <a href="about">Tentang Kami</a>
                            </li>
                            <li class="<?= ($page == "shop" ? "active" : "") ?>">
                                <a href="shop">Produk</a>
                            </li>
                            <li class="<?= ($page == "how-to-buy" ? "active" : "") ?>">
                                <a href="how-to-buy">Cara Pembelian</a>
                            </li>
                            <li class="<?= ($page == "contact" ? "active" : "") ?>">
                                <a href="contact">Hubungi Kami</a>
                            </li>
                            <li class="<?= ($page == "katalog" ? "active" : "")  ?>">
                                <a href="katalog"><i class="fa fa-print"></i> Katalog</a>
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->