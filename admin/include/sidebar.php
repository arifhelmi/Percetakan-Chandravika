<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <!-- Kelola Pesanan -->
            <li>
    <a class="collapsed" data-toggle="collapse" href="#togglePages">
        <i class="menu-icon icon-cog"></i>
        <i class="icon-chevron-down pull-right"></i>
        <i class="icon-chevron-up pull-right"></i>
        Kelola Pesanan
    </a>
    <ul id="togglePages" class="collapse unstyled">
        <li>
            <a href="todays-orders.php">
                <i class="icon-tasks"></i>
                Daftar Pesanan
                <?php
                $f1 = "00:00:00";
                $from = date('Y-m-d') . " " . $f1;
                $t1 = "23:59:59";
                $to = date('Y-m-d') . " " . $t1;
                $result = mysqli_query($con, "SELECT * FROM Orders where orderDate Between '$from' and '$to'");
                $num_rows1 = mysqli_num_rows($result);
                ?>
                <b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
            </a>
        </li>
        <li>
            <a href="pending-orders.php">
                <i class="icon-tasks"></i>
                Pesanan Belum Selesai
                <?php
                $status = 'Delivered';
                $ret = mysqli_query($con, "SELECT * FROM Orders where orderStatus!='$status' || orderStatus is null ");
                $num = mysqli_num_rows($ret);
                ?>
                <b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
            </a>
        </li>
        <li>
            <a href="delivered-orders.php">
                <i class="icon-inbox"></i>
                Pesanan Selesai
                <?php
                $status = 'Delivered';
                $rt = mysqli_query($con, "SELECT * FROM Orders where orderStatus='$status'");
                $num1 = mysqli_num_rows($rt);
                ?>
                <b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
            </a>
        </li>
    </ul>
</li>

<?php
// Check user access level and display relevant menu items
if ($_SESSION['role'] == 1) { // Admin
?>
    <li>
        <a href="manage-users.php">
            <i class="menu-icon icon-group"></i>
            Kelola Pengguna
        </a>
    </li>
    <li>
        <a href="add-admin.php">
            <i class="menu-icon icon-plus"></i>
            Tambah Admin
        </a>
    </li>
    <li>
        <a href="category.php">
            <i class="menu-icon icon-tasks"></i>
            Buat Kategori
        </a>
    </li>
    
    <li>
        <a href="subcategory.php">
            <i class="menu-icon icon-tasks"></i>
            Sub Kategori
        </a>
    </li>
    <li>
        <a href="insert-product.php">
            <i class="menu-icon icon-paste"></i>
            Masukkan Produk
        </a>
    </li>
    <li>
        <a href="manage-products.php">
            <i class="menu-icon icon-table"></i>
            Kelola Produk
        </a>
    </li>
    <li>
        <a href="user-logs.php">
            <i class="menu-icon icon-tasks"></i>
            Riwayat Login Pengguna
        </a>
    </li>
    <li>
        <a href="admin_pending_users.php">
            <i class="menu-icon icon-group"></i>
            Validasi user admin
        </a>
    </li>
    <li>
        <a class="collapsed" data-toggle="collapse" href="#toggleReports">
            <i class="icon-inbox"></i>
            <i class="icon-chevron-down pull-right"></i>
            <i class="icon-chevron-up pull-right"></i>
            Laporan
        </a>
        <ul id="toggleReports" class="collapse unstyled">
            <li>
                <a href="laporan_pesanan.php">
                    <i class="icon-tasks"></i>
                    Laporan Pesanan
                </a>
            </li>
            <li>
                <a href="laporan_transaksi.php">
                    <i class="icon-tasks"></i>
                    Laporan Transaksi
                </a>
            </li>   
        </ul>
    </li>


            </li>
                <li>
                    <a href="logout.php">
                        <i class="menu-icon icon-signout"></i>
                        Logout
                    </a>
                </li>
                <?php
            } elseif ($_SESSION['role'] == 2) { // Kasir
                // Kasir-specific menu items
                ?>
                <li>
                    <a href="add-admin.php">
                        <i class="menu-icon icon-plus"></i>
                        Tambah Admin
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="menu-icon icon-signout"></i>
                        Logout
                    </a>
                </li>
                <!-- Kasir menu items here -->
                <?php
            } elseif ($_SESSION['role'] == 3) { // Karyawan
                // Karyawan-specific menu items
                ?>
                <li>
                    <a href="category.php">
                        <i class="menu-icon icon-tasks"></i>
                        Buat Kategori
                    </a>
                </li>
                <li>
                    <a href="subcategory.php">
                        <i class="menu-icon icon-tasks"></i>
                        Sub Kategori
                    </a>
                </li>
                <li>
                    <a href="insert-product.php">
                        <i class="menu-icon icon-paste"></i>
                        Masukkan Produk
                    </a>
                </li>
                <li>
                    <a href="manage-products.php">
                        <i class="menu-icon icon-table"></i>
                        Kelola Produk
                    </a>
                </li>
                <li>
                    <a href="add-admin.php">
                        <i class="menu-icon icon-plus"></i>
                        Tambah Admin
                    </a>
                </li>
                <li>
                    <a href="user-logs.php">
                        <i class="menu-icon icon-tasks"></i>
                        Riwayat Login Pengguna
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="menu-icon icon-signout"></i>
                        Logout
                    </a>
                </li>
                <?php
            } elseif ($_SESSION['role'] == 4) { // Owner
                // Owner-specific menu items
                ?>
                <li>
                    <a href="laporan_pesanan.php">
                        <i class="menu-icon icon-tasks"></i>
                        Laporan pesanan
                    </a>
                </li>
                
                <li>
                    <a href="user-logs.php">
                        <i class="menu-icon icon-tasks"></i>
                        Riwayat Login Pengguna
                    </a>
                </li>
                <li>
                    <a href="logout.php">
                        <i class="menu-icon icon-signout"></i>
                        Logout
                    </a>
                </li>
                <?php
            }
            ?>
        </ul><!--/.widget-menu-->
    </div><!--/.sidebar-->
</div><!--/.span3-->
