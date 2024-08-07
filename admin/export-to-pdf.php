<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php'; // Pastikan jalur ini sesuai dengan lokasi autoload.php Anda

include('include/config.php'); // Sesuaikan jalur config.php

if(strlen($_SESSION['alogin'])==0) {	
    header('location:index.php');
    exit;
} else {
    if(isset($_POST['fromDate']) && isset($_POST['toDate'])) {
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];

        // Query untuk mendapatkan pesanan dalam rentang tanggal
        $customOrdersQuery = mysqli_query($con, "SELECT * FROM orders WHERE DATE(orderDate) BETWEEN '$fromDate' AND '$toDate'");
        $customOrdersCount = mysqli_num_rows($customOrdersQuery);
        $customOrders = [];
        $totalPriceSum = 0;

        while($row = mysqli_fetch_assoc($customOrdersQuery)) {
            $customOrders[] = $row;
            $productQuery = mysqli_query($con, "SELECT productPrice FROM products WHERE id='".$row['productId']."'");
            $product = mysqli_fetch_assoc($productQuery);
            $totalPrice = $product['productPrice'] * $row['quantity'];
            $totalPriceSum += $totalPrice;
        }

        $html = '<h4>Laporan Custom: '.htmlentities($customOrdersCount).'</h4>';
        $html .= '<table border="1" style="border-collapse: collapse; width: 100%;">';
        $html .= '<thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pengguna</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pesan</th>
                        <th>Harga Total</th>
                        <th>Status</th>
                    </tr>
                  </thead>';
        $html .= '<tbody>';

        $cnt = 1;
        foreach ($customOrders as $order) {
            $userQuery = mysqli_query($con, "SELECT name FROM users WHERE id='".$order['userId']."'");
            $user = mysqli_fetch_assoc($userQuery);
            $productQuery = mysqli_query($con, "SELECT productName, productPrice FROM products WHERE id='".$order['productId']."'");
            $product = mysqli_fetch_assoc($productQuery);
            $totalPrice = $product['productPrice'] * $order['quantity'];

            $html .= '<tr>
                        <td>'.htmlentities($cnt).'</td>
                        <td>'.htmlentities($user['name']).'</td>
                        <td>'.htmlentities($product['productName']).'</td>
                        <td>'.htmlentities($order['quantity']).'</td>
                        <td>'.htmlentities($order['orderDate']).'</td>
                        <td>'.htmlentities($totalPrice).'</td>
                        <td>'.htmlentities($order['orderStatus']).'</td>
                      </tr>';
            $cnt++;
        }

        $html .= '<tr>
                    <td colspan="5" style="text-align:right"><strong>Total Harga Semua Pesanan:</strong></td>
                    <td colspan="2"><strong>'.htmlentities($totalPriceSum).'</strong></td>
                  </tr>';
        $html .= '</tbody></table>';

        // Create PDF
        $mpdf->WriteHTML($html);
        $mpdf->Output('laporan_pesanan.pdf', 'D'); // 'D' to force download

        exit;
    }
}
?>
