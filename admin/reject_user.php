<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0) {
    header('location:index.php');
}
else {
    $id = intval($_GET['id']);
    $query = mysqli_query($con, "DELETE FROM admin WHERE id='$id'");
    if ($query) {
        $_SESSION['msg'] = "User rejected successfully.";
    } else {
        $_SESSION['msg'] = "Failed to reject user.";
    }
    header('location: admin_pending_users.php');
}
?>
