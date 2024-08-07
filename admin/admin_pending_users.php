<!-- // admin_pending_users.php -->
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
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Pending Users</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<?php include('include/header.php');?>
<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('include/sidebar.php');?>				
            <div class="span12">
                <div class="content">
                    <div class="module">
                        <div class="module-head">
                            <h3>Pending Users</h3>
                        </div>
                        <div class="module-body table">
                            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = mysqli_query($con, "SELECT * FROM admin WHERE status=0");
                                    $cnt = 1;
                                    while($row = mysqli_fetch_array($query)) {
                                ?>										
                                    <tr>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php echo htmlentities($row['username']);?></td>
                                        <td><?php echo htmlentities($row['creationDate']);?></td>
                                        <td>
                                            <a href="approve_user.php?id=<?php echo $row['id'];?>" title="Approve User"><i class="icon-check"></i></a>
                                            <a href="reject_user.php?id=<?php echo $row['id'];?>" title="Reject User"><i class="icon-remove"></i></a>
                                        </td>
                                    </tr>
                                <?php $cnt = $cnt + 1; } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span12-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->
<?php include('include/footer.php');?>
<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
    });
</script>
</body>
</html>

