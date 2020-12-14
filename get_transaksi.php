<?php
    include "connection.php";

    $id_perusahaan = $_POST['id_perusahaan'];

    $str = "SELECT p.nama as nama_pembeli, t.total_beli, t.tanggal, status
        FROM transaksi t INNER JOIN pengguna p ON t.id_pengguna = p.id 
        WHERE id_perusahaan='$id_perusahaan' AND status='berhasil'";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);