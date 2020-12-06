<?php
    include "connection.php";

    $id_perusahaan = $_POST['id_perusahaan'];

    $str = "SELECT t.total_beli, t.tanggal, p.nama as nama_pemilik 
        FROM transaksi t INNER JOIN pengguna p ON t.id_pengguna = p.id 
        WHERE id_perusahaan='$id_perusahaan'";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);