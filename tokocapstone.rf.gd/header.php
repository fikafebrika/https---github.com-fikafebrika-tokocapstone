<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php" style="margin-left: 90px; color: purple">TOKO CAPSTONE</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="produk.php">produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="keranjang.php">keranjang</a>
                            </li>
                            <?php if (isset($_SESSION["pelanggan"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="riwayat.php">riwayat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">logout</a>
                            </li>
                            <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">login</a>
                            </li>
                            <?php endif ?>
                        </ul>
                    </div>
                    <?php if (isset($_SESSION["pelanggan"])): ?>
                    <div class="hearer_icon d-flex align-items-center">
                        <a title="Akun Anda" href="akun.php"><i class="far fa-user"></i></a>
                    </div>
                    <?php endif ?>
                </nav>
            </div>
        </div>
    </div>
</header>