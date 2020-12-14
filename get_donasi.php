<?php
    include "connection.php";

    $id_perusahaan = $_POST['id_perusahaan'];

    $str = "SELECT p.nama as nama_donatur, d.total_donasi, d.tanggal, status
        FROM donasi d INNER JOIN pengguna p ON d.id_donatur = p.id 
        WHERE id_perusahaan='$id_perusahaan' AND status='berhasil' ORDER BY d.id DESC";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);