<?php 
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['login']) == 0) {   
    header('location:login.php');
    exit;
}

if (isset($_POST['submit'])) {
    $paymethod = $_POST['paymethod'];
    $userId = $_SESSION['id'];
    $file_path = '';

    if ($paymethod === 'Internet Banking' && isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['fileToUpload']['tmp_name'];
        $name = basename($_FILES['fileToUpload']['name']);
        $upload_dir = 'uploads/'; // Ensure this directory is writable
        $file_path = $upload_dir . $name;

        if (move_uploaded_file($tmp_name, $file_path)) {
            $file_path = mysqli_real_escape_string($con, $file_path);
        } else {
            echo "Failed to upload file.";
        }
    } else if ($paymethod === 'Internet Banking') {
        echo "No file uploaded or upload error.";
    }

    // Update the database
    $update_query = "UPDATE orders SET paymentMethod='$paymethod'";
    if ($paymethod === 'Internet Banking') {
        $update_query .= ", buktipayment='$file_path'";
    }
    $update_query .= " WHERE userId='$userId' AND paymentMethod IS NULL";

    mysqli_query($con, $update_query);

    // Clear the cart session and redirect
    unset($_SESSION['cart']);
    header('location:order-history.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>PERCETAKAN CV.CHANDRAVIKA | Metode Pembayaran</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/config.css">
    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon-32x32.png">
</head>
<body class="cnt-home">
<header class="header-style-1">
    <?php include('includes/top-header.php');?>
    <?php include('includes/main-header.php');?>
    <?php include('includes/menu-bar.php');?>
</header>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Metode Pembayaran</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="checkout-box faq-page inner-bottom-sm">
            <div class="row">
                <div class="col-md-12">
                    <h2>Pilih Metode Pembayaran</h2>
                    <div class="panel-group checkout-steps" id="accordion">
                        <div class="panel panel-default checkout-step-01">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        Pilih metode pembayaran anda
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <form name="payment" action="upload.php" method="post" enctype="multipart/form-data">
                                        <input type="radio" name="paymethod" value="COD" checked="checked"> COD
                                        <input type="radio" name="paymethod" value="Internet Banking"> Internet Banking
                                        <br /><br />
                                        <div id="uploadSection" style="display: none;">
                                            <label for="image">Masukkan Bukti Pembayaran</label>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[name="paymethod"]').change(function() {
            if ($(this).val() === 'Internet Banking') {
                $('#uploadSection').show();
            } else {
                $('#uploadSection').hide();
            }
        });

        // Trigger change to initialize upload section visibility
        $('input[name="paymethod"]:checked').trigger('change');
    });
</script>
</body>
</html>
