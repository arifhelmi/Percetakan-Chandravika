<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:login.php');
}
else{
    if (isset($_POST['submit'])) {
        // Handle file upload
        if ($_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['fileToUpload']['tmp_name'];
            $name = basename($_FILES['fileToUpload']['name']);
            $upload_dir = 'uploads/'; // Ensure this directory is writable
            $file_path = $upload_dir . $name;
    
            if (move_uploaded_file($tmp_name, $file_path)) {
                // Update the database with the payment method and file path
                $paymethod = $_POST['paymethod'];
                $file_path_escaped = mysqli_real_escape_string($con, $file_path);
                $userId = $_SESSION['id'];
    
                mysqli_query($con, "UPDATE orders SET paymentMethod='$paymethod', buktipayment='$file_path_escaped' WHERE userId='$userId' AND paymentMethod IS NULL");
    
                // Clear the cart session and redirect
                unset($_SESSION['cart']);
                header('location:order-history.php');
            } else {
                echo "Failed to upload file.";
            }
        } else {
            echo "No file uploaded or upload error.";
        }
    }
    
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
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="checkout-box faq-page inner-bottom-sm">
            <div class="row">
                <div class="col-md-12">
                    <h2>Pilih Metode Pembayaran</h2>
                    <div class="panel-group checkout-steps" id="accordion">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">
                            <!-- panel-heading -->
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                                        Pilih metode pembayaran anda 
                                    </a>
                                </h4>
                            </div>
                            <!-- panel-heading -->

                            <div id="collapseOne" class="panel-collapse collapse in">
                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <form name="payment" id="paymentForm" action="upload.php" method="post" enctype="multipart/form-data">
                                        <input type="radio" name="paymethod" value="COD" id="cod" checked="checked"> COD
                                        <input type="radio" name="paymethod" value="Internet Banking" id="internet_banking"> Internet Banking
                                        <br /><br />
                                        <div id="paymentProof" style="display:none;">
                                            <label for="image">Masukkan Bukti Pembayaran</label>
                                            <input type="file" name="fileToUpload" id="fileToUpload">
                                        </div>
                                        <input type="submit" value="Upload" name="submit">
                                    </form>
                                    <form name="codForm" id="codForm" action="" method="post">
                                        <input type="hidden" name="paymethod" value="COD">
                                    </form>
                                </div>
                                <!-- panel-body  -->
                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->
                    </div><!-- /.checkout-steps -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
    </div><!-- /.body-content -->
<?php include('includes/footer.php');?>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/echo.min.js"></script>
<script src="assets/js/jquery.easing-1.3.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="switchstylesheet/switchstylesheet.js"></script>
<script>
    $(document).ready(function(){ 
        $(".changecolor").switchstylesheet( { seperator:"color"} );
        $('.show-theme-options').click(function(){
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });

    // JavaScript to toggle the visibility of the file input based on selected payment method
    $('input[name="paymethod"]').on('change', function() {
        if ($('#internet_banking').is(':checked')) {
            $('#paymentProof').show();
        } else {
            $('#paymentProof').hide();
            $('#codForm').submit(); // Automatically submit the form when COD is selected
        }
    });

    // Initialize the visibility based on the default checked value
    if ($('#internet_banking').is(':checked')) {
        $('#paymentProof').show();
    } else {
        $('#paymentProof').hide();
    }
</script>
</body>
</html>

