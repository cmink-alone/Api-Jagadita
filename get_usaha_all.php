<?php
    include "connection.php";

    $id_pemilik = $_POST['id_pemilik'];

    $str = "SELECT u.*, p.nama as nama_pemilik 
        FROM perusahaan u INNER JOIN pengguna p ON u.id_pemilik = p.id";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);