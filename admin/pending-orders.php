<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else {

    date_default_timezone_set('Asia/Kolkata'); // Change according to timezone
    $currentTime = date('d-m-Y h:i:s A', time());

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin|Pesanan Belum Selesai</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <script language="javascript" type="text/javascript">
        var popUpWin=0;
        function popUpWindow(URLStr, left, top, width, height) {
            if(popUpWin) {
                if(!popUpWin.closed) popUpWin.close();
            }
            popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+',top='+top+',screenX='+left+',screenY='+top+'');
        }

        function printSelectedRows() {
            var selectedRows = document.querySelectorAll('input[name="selectRow"]:checked');
            var printContent = "<table border='1' class='table table-bordered table-striped'>";
            var headerRow = "<tr>" +
                "<th width='5%'>No</th>" +
                "<th width='5%'>Id Pesanan</th>" +
                "<th width='5%'>Nama</th>" +
                "<th width='20%'>Email /No Hp</th>" +
                "<th width='5%'>Alamat Pengiriman</th>" +
                "<th width='5%'>Produk</th>" +
                "<th width='5%'>Jumlah</th>" +
                "<th width='5%'>Total Harga</th>" +
                "<th width='5%'>Tanggal pesanan</th>" +
                "</tr>"; // Customize the header for printing
            printContent += "<thead>" + headerRow + "</thead><tbody>";
            selectedRows.forEach(row => {
                var tr = row.closest('tr');
                var cells = tr.querySelectorAll('td');
                printContent += "<tr>" +
                    "<td>" + cells[1].innerHTML + "</td>" +
                    "<td>" + cells[2].innerHTML + "</td>" +
                    "<td>" + cells[3].innerHTML + "</td>" +
                    "<td>" + cells[4].innerHTML + "</td>" +
                    "<td>" + cells[5].innerHTML + "</td>" +
                    "<td>" + cells[6].innerHTML + "</td>" +
                    "<td>" + cells[7].innerHTML + "</td>" +
                    "<td>" + cells[8].innerHTML + "</td>" +
                    "<td>" + cells[9].innerHTML + "</td>" +
                    "</tr>";
            });
            printContent += "</tbody></table>";

            var originalContent = document.body.innerHTML;
            document.body.innerHTML = "<html><head><title>Print</title></head><body>" + printContent + "</body></html>";
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload();
        }

        function selectAllRows(source) {
            checkboxes = document.getElementsByName('selectRow');
            for(var i in checkboxes)
                checkboxes[i].checked = source.checked;
        }
    </script>
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
                                <h3>Pesanan Belum Selesai</h3>
                                <!-- Move the print button to the right -->
                                <button type="button" onclick="printSelectedRows()" class="btn btn-primary pull-right">Cetak</button>
                            </div>
                            <div style="overflow-x:auto;">
                                <?php if(isset($_GET['del'])) { ?>
                                    <div class="alert alert-error">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>Oh Tidak!</strong> <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                    </div>
                                <?php } ?>
                                <br />
                                <div id="printableTable">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display table-responsive">
                                        <thead>
                                            <tr>
                                                <th><input type="checkbox" id="selectAll" onclick="selectAllRows(this)"></th>
                                                <th width="5%">#</th>
                                                <th width="5%">Id Pembelian</th>
                                                <th width="5%">Nama</th>
                                                <th width="20%">Email /No Hp</th>
                                                <th width="5%">Alamat Pengiriman</th>
                                                <th width="5%">Produk</th>
                                                <th width="5%">Jumlah</th>
                                                <th width="5%">Total Harga</th>
                                                <th width="5%">Tanggal pesanan</th>
                                                <th width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $status='Delivered';
                                            $query=mysqli_query($con,"select users.name as username,users.email as useremail,users.contactno as usercontact,users.shippingAddress as shippingaddress,users.shippingCity as shippingcity,users.shippingState as shippingstate,users.shippingPincode as shippingpincode,products.productName as productname,products.shippingCharge as shippingcharge,orders.quantity as quantity,orders.orderDate as orderdate,products.productPrice as productprice,orders.id as id from orders join users on orders.userId=users.id join products on products.id=orders.productId where orders.orderStatus!='$status' or orders.orderStatus is null");
                                            $cnt=1;
                                            while($row=mysqli_fetch_array($query))
                                            {
                                            ?>										
                                            <tr>
                                                <td><input type="checkbox" name="selectRow"></td>
                                                <td><?php echo htmlentities($cnt);?></td>
                                                <td><?php echo htmlentities($row['id']);?></td>
                                                <td><?php echo htmlentities($row['username']);?></td>
                                                <td><?php echo htmlentities($row['useremail']);?>/<?php echo htmlentities($row['usercontact']);?></td>
                                                <td><?php echo htmlentities($row['shippingaddress'].",".$row['shippingcity'].",".$row['shippingstate']."-".$row['shippingpincode']);?></td>
                                                <td><?php echo htmlentities($row['productname']);?></td>
                                                <td><?php echo htmlentities($row['quantity']);?></td>
                                                <td><?php echo htmlentities($row['quantity']*$row['productprice']+$row['shippingcharge']);?></td>
                                                <td><?php echo htmlentities($row['orderdate']);?></td>
                                                <td> <a href="updateorder.php?oid=<?php echo htmlentities($row['id']);?>" title="Update order" target="_blank"><i class="icon-edit"></i></a> </td>
                                            </tr>
                                            <?php $cnt=$cnt+1; } ?>
                                        </tbody>
                                    </table>
                                </div>
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
    function selectAllRows(source) {
        checkboxes = document.getElementsByName('selectRow');
        for(var i in checkboxes)
            checkboxes[i].checked = source.checked;
    }
</script>
</body>
<?php } ?>
