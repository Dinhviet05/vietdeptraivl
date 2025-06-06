    <!-- Start Header Area -->
    <header class="header-area header-wide">
        <!-- main header start -->
        <div class="main-header d-none d-lg-block">
            <!-- header top start -->
            <div class="header-top bdr-bottom">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="welcome-message">
                                <p>Chào mừng đến với cửa hàng điện thoại online UniMobi </p>
                            </div>
                        </div>
                        <div class="col-lg-6 text-right">
                            <div class="header-top-settings">
                                <ul class="nav align-items-center justify-content-end">
                                    <li class="nav-item d-none d-sm-inline-block">
                                        <a href="<?= BASE_URL_ADMIN . '?act=login-admin' ?>" class="nav-link">Admin</a>
                                    </li>
                                    <li class="curreny-wrap">
                                        $ Currency
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list curreny-list">
                                            <li><a href="#">$ USD</a></li>
                                            <li><a href="#">€ EURO</a></li>
                                        </ul>
                                    </li>
                                    <li class="language">
                                        <img src="assets/img/icon/en.png" alt="flag"> English
                                        <i class="fa fa-angle-down"></i>
                                        <ul class="dropdown-list">
                                            <li><a href="#"><img src="assets/img/icon/en.png" alt="flag"> english</a></li>
                                            <li><a href="#"><img src="assets/img/icon/fr.png" alt="flag"> french</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header top end -->

            <!-- header middle area start -->
            <div class="header-main-area sticky">
                <div class="container">
                    <div class="row align-items-center position-relative">

                        <!-- start logo area -->
                        <div class="col-lg-2">
                            <div class="logo">
                                <a href="<?= BASE_URL ?>">
                                    <img src="assets/image/logo/LOGO.png" width="150px" height="50px" alt="Brand Logo">
                                </a>
                            </div>
                        </div>
                        <!-- start logo area -->

                        <!-- main menu area start -->
                        <div class="col-lg-6 position-static">
                            <div class="main-menu-area">
                                <div class="main-menu">
                                    <!-- main menu navbar start -->
                                    <nav class="desktop-menu">
                                        <ul>
                                            <li class="active">
                                                <a href="<?= BASE_URL ?>">Trang chủ</a>
                                            </li>
                                            <li class="position-static"><a href="<?= BASE_URL . '?act=san-pham' ?>">Sản phẩm</a>
                                            </li>
                                            <li><a href="<?= BASE_URL . '?act=gioi-thieu' ?>">Giới thiệu</a></li>
                                            <li><a href="<?= BASE_URL . '?act=contact' ?>">Liên hệ</a></li>
                                        </ul>
                                    </nav>
                                    <!-- main menu navbar end -->
                                </div>
                            </div>
                        </div>
                        <!-- main menu area end -->

                        <!-- mini cart area start -->
                        <div class="col-lg-4">
                            <div class="header-right d-flex align-items-center justify-content-xl-between justify-content-lg-end">
                                <div class="header-search-container">
                                    <form action="index.php" method="GET" class="header-search-box">
                                        <input type="hidden" name="act" value="tim-kiem">
                                        <input type="text" name="query" placeholder="Tìm kiếm sản phẩm hoặc danh mục" class="header-search-field" required>
                                        <button type="submit" class="header-search-btn">
                                            <i class="pe-7s-search"></i>
                                        </button>
                                    </form>
                                </div>
                                <div class="header-configure-area">
                                    <ul class="nav justify-content-end">
                                        <label for=""><?php if (isset($_SESSION['user_client'])) {
                                                            echo $_SESSION['user_client'];
                                                        } ?></label>
                                        <li class="user-hover">
                                            <a href="#">
                                                <i class="pe-7s-user"></i>
                                            </a>
                                            <ul class="dropdown-list">
                                                <?php if (!isset($_SESSION['user_client'])) { ?>
                                                    <li><a href="<?= BASE_URL . '?act=login' ?>">Đăng nhập</a></li>
                                                    <li><a href="<?= BASE_URL . '?act=register' ?>">Đăng ký</a></li>

                                                <?php } else { ?>
                                                    <li><a href="my-account.html">Tài khoản</a></li>
                                                    <li><a href="<?= BASE_URL . '?act=lich-su-mua-hang' ?>">Đơn hàng</a></li>
                                                    <li><a href="<?= BASE_URL . '?act=dang-xuat' ?>">Đăng xuất</a></li>
                                                <?php } ?>

                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#" class="minicart-btn">
                                                <i class="pe-7s-shopbag"></i>
                                                <div class="notification">2</div>
                                                <?php // BASE_URL . '?act=gio-hang' 
                                                ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- header middle area end -->
        </div>
        <!-- main header start -->


    </header>
    <!-- end Header Area -->