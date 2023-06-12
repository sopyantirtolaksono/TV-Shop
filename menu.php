<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">BekhanTV</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="keranjang.php"><i class="fa fa-shopping-cart"></i> Keranjang</a></li>
            <li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>

            <!-- Jika sudah login (Ada session pelanggan) -->
            <?php if(isset($_SESSION['pelanggan'])) : ?>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Halo, <?=$_SESSION['pelanggan']['nama_pelanggan']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="riwayat.php" style="color:grey !important;"><i class="fa fa-list"></i> Riwayat Belanja</a></li>
                        <li class="divider"></li>
                        <li><a href="logout.php" style="color:grey !important;" onclick="return confirm('Yakin ingin logout?')"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>

            <!-- Jika belum login (Tidak ada session pelanggan) -->
            <?php else : ?>   
                <li><a href="login.php"><i class="fa fa-sign-in"></i> Login</a></li>
            <?php endif; ?>

        </ul>
        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="Search...">
            </div>
            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
        </form>
        
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<br><br><br>