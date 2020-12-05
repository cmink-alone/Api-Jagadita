<?php
    include "connection.php";

    $id_pemilik = $_POST['id_pemilik'];

    $str = "SELECT * FROM perusahaan WHERE id_pemilik='$id_pemilik'";
    $qry = $conn->query($str);
    if($qry){
        $response = $qry->fetch_all(MYSQLI_ASSOC);
    } else {
        $response = [];
    }
    echo json_encode($response);