<?php 
session_start();
error_reporting(0);
include('includes/config.php');
include('apirajaongkir\rajaongkirindex.php');

if(isset($_POST['submit'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;

			}
		}
			echo "<script>alert('Keranjang anda berhasil diupdate');</script>";
		}
	}
// Code for Remove a Product from Cart
if(isset($_POST['remove_code']))
	{

if(!empty($_SESSION['cart'])){
		foreach($_POST['remove_code'] as $key){
			
				unset($_SESSION['cart'][$key]);
		}
			echo "<script>alert('Keranjang anda berhasil diupdate');</script>";
	}
}
// code for insert product in order table


if(isset($_POST['ordersubmit'])) 
{
	
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{

	$quantity=$_POST['quantity'];
	$pdd=$_SESSION['pid'];
	$value=array_combine($pdd,$quantity);


		foreach($value as $qty=> $val34){



mysqli_query($con, "INSERT INTO orders(userId, productId, quantity, design, orderDate, total_harga, ongkir) VALUES ('".$_SESSION['id']."', '$qty', '$val34', '$dsg', Now() ,'$totalprice', '$ongkir')");
header('location:payment-method.php');
}
}
}
if(isset($_POST['edesign']))
{
	$dsg=$_POST['design'];
	$query=mysqli_query($con,"insert into orders(userId,productId,quantity,design, total_harga, ongkir) values ('".$_SESSION['id']."','$qty','$val34','$dsg','$totalprice', '$ongkir')");
	if($query)
	{
echo "<script>alert('Alamat penagihan anda berhasil diupdate');</script>";
	}
}
// code for billing address updation
	if(isset($_POST['update']))
	{
		$baddress=$_POST['billingaddress'];
		$bstate=$_POST['bilingstate'];
		$bcity=$_POST['billingcity'];
		$bpincode=$_POST['billingpincode'];
		$query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Alamat penagihan anda berhasil diupdate');</script>";
		}
	}


// code for Shipping address updation
	if(isset($_POST['shipupdate']))
	{
		$saddress=$_POST['shippingaddress'];
		$sstate=$_POST['shippingstate'];
		$scity=$_POST['shippingcity'];
		$spincode=$_POST['shippingpincode'];
		$query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
		if($query)
		{
echo "<script>alert('Shipping Address has been updated');</script>";
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

	    <title> Keranjang Saya</title>
	    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/css/main.css">
	    <link rel="stylesheet" href="assets/css/green.css">
	    <link rel="stylesheet" href="assets/css/owl.carousel.css">
		<link rel="stylesheet" href="assets/css/owl.transitions.css">
		<!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
		<link href="assets/css/lightbox.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/animate.min.css">
		<link rel="stylesheet" href="assets/css/rateit.css">
		<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

		<!-- Demo Purpose Only. Should be removed in production -->
		<link rel="stylesheet" href="assets/css/config.css">

		<link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
		<link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
		<link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
		<link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
		<link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
		<!-- Demo Purpose Only. Should be removed in production : END -->

		
		<!-- Icons/Glyphs -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">

        <!-- Fonts --> 
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon-32x32.png">

		<!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
            $('#bilingstate').change(function(){
                var inputValue = $(this).val();
				$("#billingcity").children().remove()
				$("#billingcity").append($('<option>', {
					value: 0,
					text: "---Pilih Provinsi---",
				}));

				$.ajax({
					type: "POST",
					url: "apirajaongkir/rajaongkirkota.php",
					data: "id_provinsi="+inputValue,
					}).done(function( result ) {
						result = JSON.parse(result);
						$.each(result.rajaongkir.results, function(key, data){
							$("#billingcity").append($('<option>', {
								value: data.city_id,
								text: data.city_name,
							}));
						});
				});

            });
			$('#billingcity').change(function(){
				var cartTotalWeightDom = document.getElementsByClassName("cart-total-weight")
				var berat_paket = 0;
				for (let i = 0; i < cartTotalWeightDom.length; i++) {
					var costTemp = cartTotalWeightDom[i].getAttribute("value");
					berat_paket += Number(costTemp);
				}
				var id_kota_tujuan = $("#billingcity").val();

				$.ajax({
					type: "POST",
					url: "apirajaongkir/apirajaongkircost.php",
					// data: {
					// 	"id_kota_tujuan": id_kota_tujuan,
					// 	"berat_paket": berat_paket,
					// }
					data: "berat_paket="+berat_paket+"&id_kota_tujuan="+id_kota_tujuan,
					}).done(function( result ) {
						result = JSON.parse(result);
						var courier = result.rajaongkir.results.find((x => x.code === 'jne'));
						var cost = courier.costs[0].cost[0].value;
						$("#cart-shipping-cost").html("Rp "+cost+" ,-");
						var rawTotalPrice = Number(document.getElementById("raw-total-price").getAttribute("value"));
						var newTotalPrice = rawTotalPrice + Number(cost);
						$("#total-price").html("Rp "+newTotalPrice+" ,-");
				});

            });
        });
        </script>

	</head>
    <body class="cnt-home">
	
		
	
		<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1">
<?php include('includes/top-header.php');?>
<?php include('includes/main-header.php');?>
<?php include('includes/menu-bar.php');?>
</header>
<!-- ============================================== HEADER : END ============================================== -->
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Keranjang belanja</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row inner-bottom-sm">
			<div class="shopping-cart">
				<div class="col-md-12 col-sm-12 shopping-cart-table ">
	<div class="table-responsive">
<form name="cart" method="post">	
<?php
if(!empty($_SESSION['cart'])){
	?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="cart-romove item">Hapus</th>
					<th class="cart-description item">Gambar</th>
					<th class="cart-product-name item">Nama Produk</th>
			
					<th class="cart-qty item">Jumlah</th>
					<th class="cart-sub-total item">Harga satuan</th>
					<th class="cart-total last-item">Total Harga</th>
					<th class="cart-total last-item">Total Berat</th>
				</tr>
			</thead><!-- /thead -->
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="shopping-cart-btn">
							
							
						<br></br>
								<a href="index.php" class="btn btn-upper btn-primary outer-left-xs">Lanjutkan Berbelanja</a>
								<input type="submit" name="submit" value="Update shopping cart" class="btn btn-upper btn-primary pull-right outer-right-xs">
							</span>
						</div><!-- /.shopping-cart-btn -->
					</td>
				</tr>
			</tfoot>
			<tbody>
 <?php
 $pdtid=array();
    $sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;

				array_push($pdtid,$row['id']);
//print_r($_SESSION['pid'])=$pdtid;exit;
	?>

				<tr>
					<td class="romove-item"><input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" /></td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
						    <img src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="" width="114" height="146">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>" ><?php echo $row['productName'];

$_SESSION['sid']=$pd;
						 ?></a></h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="rating rateit-small"></div>
							</div>
							<div class="col-sm-8">
<?php $rt=mysqli_query($con,"select * from productreviews where productId='$pd'");
$num=mysqli_num_rows($rt);
{
?>
								<div class="reviews">
									( <?php echo htmlentities($num);?> Reviews )
								</div>
								<?php } ?>
							</div>
						</div><!-- /.row -->
						
					</td>
					<td class="cart-product-quantity">
						<div class="quant-input">
				                <div class="arrows">
				                  <div class="arrow plus gradient"><span class="ir"><i class="icon fa fa-sort-asc"></i></span></div>
				                  <div class="arrow minus gradient"><span class="ir"><i class="icon fa fa-sort-desc"></i></span></div>
				                </div>
				             <input type="text" value="<?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>" name="quantity[<?php echo $row['id']; ?>]">
				             
			              </div>
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price"><?php echo "Rp"." ".$row['productPrice']; ?>,-</span></td>
					<!-- <td class="cart-product-sub-total"><span class="cart-sub-total-price" id="cart-shipping-cost">-</span></td> -->
					<td class="cart-product-grand-total"><span class="cart-grand-total-price"><?php echo "Rp"." ".($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge']); ?>,-</span></td>
					<td class="cart-product-sub-total"><span class="cart-total-weight" value="<?php echo ""." ".($_SESSION['cart'][$row['id']]['quantity']*$row['berat_product']); ?>"><?php echo ""." ".($_SESSION['cart'][$row['id']]['quantity']*$row['berat_product']); ?> Gram</span></td>
					<td class="">
					</td>

					
				</tr>

				<?php } }
$_SESSION['pid']=$pdtid;
				?>
				
			</tbody><!-- /tbody -->
		</table><!-- /table -->
		
	</div>
</div><!-- /.shopping-cart-table -->			<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>
					<span class="estimate-title">Alamat pengiriman</span>
				</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>
						<div class="form-group">
<?php
$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
?>

					<div class="form-group">
					    <label class="info-title" for="Billing Address">Alamat Pengiriman<span>*</span></label>
					    <textarea class="form-control unicase-form-control text-input"  name="billingaddress" required="required"><?php echo $row['billingAddress'];?></textarea>
					  </div>



					<div class="form-group">
						<label class="info-title" for="Billing State">Provinsi  <span>*</span></label>
						<select id="bilingstate" name="bilingstate" class="form-control" aria-label="label" method="post">
							<option>---Pilih Provinsi---</option>
							<?php

						
						
						if ($err) {
						echo "cURL Error #:" . $err;
						} else {
							//   echo $response;
							$provinsi = json_decode($response);
							// echo "<pre>"; pring_r($data); echo "</pre>";
							if($provinsi->rajaongkir->status->code == '200'){
								foreach ($provinsi->rajaongkir->results as $key => $pv){
									// echo"<option>test echo2</option>";
									echo"<option id=".$pv->province_id." value=".$pv->province_id.">".$pv->province."</option>";
								}
								
							}	
						}
						
						
						?>
						</select>
					</div>
					<div id="result"></div>
					  
					  <div class="form-group">
					    <label class="info-title" for="Billing State">Kota  <span>*</span></label>
						<select id="billingcity" name="billingcity" class="form-control" aria-label="label" ></select>
					  </div>
					<!-- </div id="demo">....</div> -->
					  
 						<div class="form-group">
					    <label class="info-title" for="Billing Pincode">Kode Pos<span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="billingpincode" name="billingpincode" required="required" value="<?php echo $row['billingPincode'];?>" >
					  </div>


					  <button type="submit" name="update" class="btn-upper btn btn-primary checkout-page-button">Update</button>
			
					<?php } ?>
		
						</div>
					
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		
		<thead>
			<tr>
				<th>
					
					<div class="cart-grand-total">
						JNE REG
						Harga Ongkos Kirim  : <span class="cart-product-sub-total"><span class="cart-sub-total-price" id="cart-shipping-cost">-</span></td>
						<input type="hidden" name="ongkir" id="ongkir" value="0">
					</div>
				</th>
			</tr>
		</thead>
		</tbody><!-- /tbody -->
	</table><!-- /table -->
</div>
<div class="col-md-4 col-sm-12 estimate-ship-tax">
	<table class="table table-bordered">
	</table><!-- /table -->
</div>
<div class="col-md-4 col-sm-12 cart-shopping-total">
	<table class="table table-bordered">
		<thead>
		<tr>
                                <th>
                                    <div class="cart-grand-total">
                                        <span class="cart-grand-name">Total Belanja</span>
                                    </div>
                                </th>
								<tr>
                                <th>
								<div value="<?php echo "" .$_SESSION['tp']="$totalprice". ""; ?>" id="raw-total-price"></div>
								<span class="inner" id="total-price"><?php echo "Rp"." " .$_SESSION['tp']="$totalprice". ",-"; ?></span>                                    </div>
                                </th>
                            </tr>
			<!-- <tr>
				<th>
					
					<div class="cart-grand-total">
						<div value="<?php echo "" .$_SESSION['tp']="$totalprice". ""; ?>" id="raw-total-price"></div>
						Total Harga  : <span class="inner" id="total-price"><?php echo "Rp"." " .$_SESSION['tp']="$totalprice". ",-"; ?></span>
					</div>
				</th>
			</tr> -->
		</thead>	
		<!-- /thead -->
		<tbody>
				<tr>
					<td>
						<button type="submit" name="ordersubmit" class="btn btn-primary">
							<div class="cart-checkout-btn pull-right">
								CHEKOUT PROSES
							</div>
						</button>						
					</td>
				</tr>
		</tbody><!-- /tbody -->
	</table>
	<?php } else {
echo "Keranjang belanja anda masih kosong";
		}?>
</div>			</div>
		</div> 
		</form>
</div>
</div>
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

	
	<!-- <script src="switchstylesheet/switchstylesheet.js"></script> -->
	
	<script>
		  $.ajax({
                        type: "POST",
                        url: "save_ongkir.php",
                        data: { ongkir: cost },
                        success: function(response) {
                            console.log("Ongkir saved:", response);
                        },
                        error: function() {
                            console.error("Failed to save ongkir.");
                        }
                    });
		$(document).ready(function(){ 
			// $(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
		document.addEventListener('DOMContentLoaded', (event) => {
        var spanElement = document.querySelector('.cart-total-weight');
        var value = spanElement.getAttribute('data-value');
        console.log(value);  // Outputs: JNE REG
    });


		
	</script>

</body>
</html>	