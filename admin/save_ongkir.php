<?php
include('includes/config.php'); // Pastikan koneksi database

if (isset($_POST['ongkir'])) {
    $ongkir = $_POST['ongkir'];
    
    // Sanitasi dan validasi input
    $ongkir = mysqli_real_escape_string($con, $ongkir);
    
    // Query untuk menyimpan ongkir ke database
    $query = "UPDATE orders SET ongkir='$ongkir' WHERE id='$orderId'";
    
    if (mysqli_query($con, $query)) {
        echo "Ongkir saved successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
