<?php
// Memulai sesi jika belum dimulai


// Memeriksa apakah sesi 'username' telah diatur
$admin_name = 'Admin';
$role_name = '';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Query untuk mengambil data admin dari database
    $query = "SELECT admin FROM role='$role'";
    $result = mysqli_query($con, $query);

    // Memeriksa apakah query berhasil dan mendapatkan hasil
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);
        $admin_name = $admin['username'];
        $role = $admin['role'];

        // Menentukan nama peran berdasarkan nilai role
        switch ($role) {
            case 1:
                $role_name = 'Admin';
                break;
            case 2:
                $role_name = 'Kasir';
                break;
            case 3:
                $role_name = 'Karyawan Penjualan';
                break;
            case 4:
                $role_name = 'Owner';
                break;
            default:
                $role_name = '';
                break;
        }
    }
}
?>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <i class="icon-reorder shaded"></i>
            </a>

            <a class="brand" href="index.html">
                PERCETAKAN CV.CHANDRAVIKA     
            </a>

            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li><a href="#">
                    <?php echo htmlspecialchars($admin_name) . ' (' . htmlspecialchars($role_name) . ')'; ?></strong>
                    </a></li>
                    <li class="nav-user dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="images/admin.jpg" class="nav-avatar" />
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="change-password.php">Ubah Password</a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->
