<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else {
    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());

    // Mengambil data laporan
    $dailyOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM orders WHERE DATE(orderDate) = CURDATE()");
    $dailyOrdersCount = mysqli_fetch_assoc($dailyOrders)['count'];

    $monthlyOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM orders WHERE MONTH(orderDate) = MONTH(CURDATE()) AND YEAR(orderDate) = YEAR(CURDATE())");
    $monthlyOrdersCount = mysqli_fetch_assoc($monthlyOrders)['count'];

    $yearlyOrders = mysqli_query($con, "SELECT COUNT(*) as count FROM orders WHERE YEAR(orderDate) = YEAR(CURDATE())");
    $yearlyOrdersCount = mysqli_fetch_assoc($yearlyOrders)['count'];

    // Laporan berdasarkan tanggal yang ditentukan
    $customOrdersCount = 0;
    $customOrders = [];
    $totalPriceSum = 0;
    if(isset($_POST['submit'])) {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $customOrdersQuery = mysqli_query($con, "SELECT * FROM orders WHERE DATE(orderDate) BETWEEN '$fromDate' AND '$toDate'");
        $customOrdersCount = mysqli_num_rows($customOrdersQuery);
        while($row = mysqli_fetch_assoc($customOrdersQuery)) {
            $customOrders[] = $row;
            $productQuery = mysqli_query($con, "SELECT productPrice FROM products WHERE id='".$row['productId']."'");
            $product = mysqli_fetch_assoc($productQuery);
            $totalPrice = $product['productPrice'] * $row['quantity'];
            $totalPriceSum += $totalPrice;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Laporan Pesanan</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printTable, #printTable * {
                visibility: visible;
            }
            #printTable {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>
<?php include('include/header.php');?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('include/sidebar.php');?>				
            <div class="span9">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Laporan Pesanan</h3>
                        </div>
                        <div class="module-body">
                            <h4>Laporan Harian: <?php echo htmlentities($dailyOrdersCount); ?></h4>
                            <h4>Laporan Bulanan: <?php echo htmlentities($monthlyOrdersCount); ?></h4>
                            <h4>Laporan Tahunan: <?php echo htmlentities($yearlyOrdersCount); ?></h4>
                            <br/>

                            <form class="form-horizontal row-fluid" name="OrderReport" method="post" action="">
                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Dari Tanggal</label>
                                    <div class="controls">
                                        <input type="date" name="fromDate" class="span8 tip" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Sampai Tanggal</label>
                                    <div class="controls">
                                        <input type="date" name="toDate" class="span8 tip" required>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn">Generate Laporan</button>
                                    </div>
                                </div>
                            </form>

                            <?php if(isset($_POST['submit'])) { ?>
                                <h4>Laporan Custom: <?php echo htmlentities($customOrdersCount); ?></h4>
                                <button onclick="printTable()" class="btn btn-primary">Cetak Laporan Pesanan</button>
                                <div id="printTable">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pengguna</th>
                                                <th>Produk</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal Pesan</th>
                                                <th>Harga Total</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $cnt = 1;
                                            foreach ($customOrders as $order) { 
                                                $userQuery = mysqli_query($con, "SELECT name FROM users WHERE id='".$order['userId']."'");
                                                $user = mysqli_fetch_assoc($userQuery);
                                                $productQuery = mysqli_query($con, "SELECT productName, productPrice FROM products WHERE id='".$order['productId']."'");
                                                $product = mysqli_fetch_assoc($productQuery);
                                                $totalPrice = $product['productPrice'] * $order['quantity'];
                                            ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($user['name']); ?></td>
                                                <td><?php echo htmlentities($product['productName']); ?></td>
                                                <td><?php echo htmlentities($order['quantity']); ?></td>
                                                <td><?php echo htmlentities($order['orderDate']); ?></td>
                                                <td><?php echo htmlentities($totalPrice); ?></td>
                                                <td><?php echo htmlentities($order['orderStatus']); ?></td>
                                            </tr>
                                            <?php $cnt++; } ?>
                                            <tr>
                                                <td colspan="5" style="text-align:right"><strong>Total Harga Semua Pesanan:</strong></td>
                                                <td colspan="2"><strong><?php echo htmlentities($totalPriceSum); ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->

<?php include('include/footer.php');?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });

    function printTable() {
        window.print();
    }
</script>
</body>
</html>
<?php } ?>
