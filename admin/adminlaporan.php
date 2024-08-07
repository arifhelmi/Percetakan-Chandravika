<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  admin where password='".md5($_POST['password'])."' && username='".$_SESSION['alogin']."'");
$num=mysqli_fetch_array($sql);
if($num>0)
{
 $con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where username='".$_SESSION['alogin']."'");
$_SESSION['msg']="Password Berhasil Diubah !!";
}
else
{
$_SESSION['msg']="Password Tidak Sesuai !!";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> Ubah Password</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script type="text/javascript">

</script>
</head>
<body>
<?php include('include/header.php');?>
	<div class="wrapper">
		<div class="container">
			<div class="row">

			<div class="span9">
					<div class="content">

						<div class="module">
							<div class="module-body">

									<?php if(isset($_POST['submit']))
                                    {?>
									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
									</div>
                                    <?php } ?>
									<br />
                                    <div class="module-head">
								<h3>Kelola Kategori</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Product</th>
											<th>Banyak Barang</th>
											<th>Tipe Pembayaran</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
                                    <?php $query=mysqli_query($con,"select * from orders");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>									
										<tr>
                                        <td><?php echo htmlentities($cnt); ?></td>
       
        <td>
            <?php
            // Ambil nama produk dari tabel 'products' berdasarkan ID produk
            $productId = $row['productId'];
            $productQuery = "SELECT productName FROM products WHERE id = '$productId'";
            $productResult = mysqli_query($con, $productQuery);
            $productData = mysqli_fetch_assoc($productResult);
            echo htmlentities($productData['productName']);
            ?>
        </td>
        <td> <?php echo htmlentities($row['quantity']); ?></td>
        <td><?php echo htmlentities($row['paymentMethod']); ?></td>
        <td>
											<!-- <a href="edit-category.php?id=<?php echo $row['id']?>" ><i class="icon-edit"></i></a>
											<a href="category.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"><i class="icon-remove-sign"></i></a></td>
										</tr> -->
										<?php $cnt=$cnt+1; } ?>
										
								</table>
							</div>
						</div>						

                                    <h2>Pilih Rentang Waktu</h2>
                                    <form action="" method="post">
    <label for="date_range">Pilih Rentang Waktu:</label>
    <select name="date_range" id="date_range">
        <option value="daily">Per Hari</option>
        <option value="weekly">Per Minggu</option>
        <option value="monthly">Per Bulan</option>
    </select>
    <button type="submit" name="generate_report">Generate Laporan</button>
    <button id="tombol" onclick="window.print()" class="btn btn-warning"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Cetak</button>

</form>

    <?php
    // Skrip PHP untuk menghasilkan laporan

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_report'])) {
        $dateRange = $_POST['date_range'];

        // Tentukan tanggal awal dan akhir berdasarkan rentang waktu
        $startDate = '';
        $endDate = '';

        if ($dateRange === 'daily') {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
        } elseif ($dateRange === 'weekly') {
            $startDate = date('Y-m-d', strtotime('-1 week'));
            $endDate = date('Y-m-d');
        } elseif ($dateRange === 'monthly') {
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-t');
        }

        // Query untuk mengambil data dari tabel orders dalam rentang waktu yang dipilih
        $query = "SELECT * FROM orders WHERE orderDate BETWEEN '$startDate' AND '$endDate'";
        $result = mysqli_query($con, $query);

        // Inisialisasi total harga
        $totalPrice = 0;

        // Tampilkan hasil laporan
        echo "<h2>Laporan Penjualan</h2>";
        echo "<p>Rentang Waktu: $startDate sampai $endDate</p>";

        if (mysqli_num_rows($result) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>No</th><th>Tanggal Order</th><th>Total Harga</th></tr>";

            $counter = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                // Hitung total harga: quantity * productPrice
                $productId = $row['productId'];
                $quantity = $row['quantity'];

                $productQuery = "SELECT productPrice FROM products WHERE id = '$productId'";
                $productResult = mysqli_query($con, $productQuery);
                $productData = mysqli_fetch_assoc($productResult);
                $productPrice = $productData['productPrice'];

                $subtotal = $quantity * $productPrice;
                $totalPrice += $subtotal;
                
                echo "<tr>";
                echo "<td>$counter</td>";
                echo "<td>{$row['orderDate']}</td>";
                echo "<td>Rp " . number_format($subtotal, 2) . "</td>";
                echo "</tr>";

                $counter++;
            }

            echo "<tr><td colspan='2'>Total Harga</td><td>Rp " . number_format($totalPrice, 2) . "</td></tr>";
            echo "</table>";
        } else {
            echo "<p>Tidak ada data yang ditemukan dalam rentang waktu yang dipilih.</p>";
        }
    }
    ?>

										</div>
									</form>
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
</body>
<?php } ?>

<script>
function printReport() {
    window.print();
}
</script>