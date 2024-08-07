<?php
session_start();
include('include/config.php');

if(strlen($_SESSION['alogin'])==0)
{
    header('location:index.php');
    exit();
}
else if($_SESSION['role'] != '1')
{
    header('location:access-denied.php');
    exit();
}

function generateUserId($role, $con) {
    $prefix = '';
    switch($role) {
        case '1':
            $prefix = 'adm';
            break;
        case '2':
            $prefix = 'kas';
            break;
        case '3':
            $prefix = 'kwp';
            break;
        case '4':
            $prefix = 'owner';
            break;
    }
    
    $date = date('Ymd');
    $prefix .= $date;

    $query = mysqli_query($con, "SELECT id FROM admin WHERE id LIKE '$prefix%' ORDER BY id DESC LIMIT 1");
    $result = mysqli_fetch_assoc($query);
    
    if ($result) {
        $lastId = $result['id'];
        $lastNum = (int)substr($lastId, strlen($prefix)) + 1;
        $newId = $prefix . str_pad($lastNum, 3, '0', STR_PAD_LEFT);
    } else {
        $newId = $prefix . '001';
    }

    return $newId;
}

if(isset($_POST['submit']))
{
    $id = generateUserId($_POST['role'], $con);
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $creationDate = date('Y-m-d H:i:s');
    $updationDate = $creationDate;

    $sql = mysqli_query($con, "INSERT INTO admin (id, username, password, creationDate, updationDate, role) VALUES ('$id', '$username', '$password', '$creationDate', '$updationDate', '$role')");
    if($sql)
    {
        $_SESSION['msg'] = "User Added Successfully !!";
    }
    else
    {
        $_SESSION['msg'] = "Error Adding User !!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/theme.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
    <?php include('include/header.php'); ?>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php'); ?>
                <div class="span9">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>Add User</h3>
                            </div>
                            <div class="module-body">
                                <?php if(isset($_POST['submit'])) { ?>
                                    <div class="alert alert-success">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <?php echo htmlentities($_SESSION['msg']); ?>
                                        <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                                    </div>
                                <?php } ?>
                                <br />
                                <form class="form-horizontal row-fluid" name="adduser" method="post">
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Username</label>
                                        <div class="controls">
                                            <input type="text" name="username" placeholder="Enter Username" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Password</label>
                                        <div class="controls">
                                            <input type="password" name="password" placeholder="Enter Password" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Role</label>
                                        <div class="controls">
                                            <select name="role" class="span8 tip" required>
                                                <option value="1">Admin</option>
                                                <option value="2">Kasir</option>
                                                <option value="3">Karyawan Penjualan</option>
                                                <option value="4">Owner</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn">Add User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->
    <?php include('include/footer.php'); ?>
    <script src="scripts/jquery-1.9.1.min.js"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
