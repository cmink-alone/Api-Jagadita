<?php
    include "connection.php";

    $id_pengguna = $_POST['id_pengguna'];

    $str = "SELECT p.nama_perusahaan, d.total_donasi, d.tanggal, status
        FROM donasi d INNER JOIN perusahaan p ON d.id_perusahaan = p.id 
        WHERE id_donatur='$id_pengguna' ORDER BY d.id DESC";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);