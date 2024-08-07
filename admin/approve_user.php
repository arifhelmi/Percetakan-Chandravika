<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
}
else {
    $id = intval($_GET['id']);
    $query = mysqli_query($con, "UPDATE admin SET status=1 WHERE id='$id'");
    if ($query) {
        $_SESSION['msg'] = "User approved successfully.";
    } else {
        $_SESSION['msg'] = "Failed to approve user.";
    }
    header('location: admin_pending_users.php');
}
?>
