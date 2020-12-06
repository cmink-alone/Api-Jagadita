<?php
    include "connection.php";

    $id_pengguna = $_POST['id_pengguna'];

    $str = "SELECT p.nama_perusahaan, t.total_beli, t.tanggal, status
        FROM transaksi t INNER JOIN perusahaan p ON t.id_perusahaan = p.id 
        WHERE id_pengguna='$id_pengguna'";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);