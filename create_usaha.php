<?php
    include "connection.php";

    $data = file_get_contents('php://input');
    $json_data = json_decode($data , true);

    $id_pemilik = $json_data['id_pemilik'];
    $nama_perusahaan = $json_data['nama_perusahaan'];
    $jenis_usaha = $json_data['jenis_usaha'];
    $alamat = $json_data['alamat'];
    $telp = $json_data['telp'];
    $deskripsi = $json_data['deskripsi'];
    $kota = $json_data['kota'];
    $total_saham = $json_data['total_saham'];
    $harga = $json_data['harga'];

    $str = "INSERT INTO perusahaan VALUES(
        NULL,
        '$id_pemilik',
        '$nama_perusahaan',
        '$jenis_usaha',
        '$alamat',
        '$telp',
        '$deskripsi',
        '$kota',
        '$total_saham',
        '$harga',
        0,
        0
    )";
    $qry = $conn->query($str);
    if($qry){
        $response = array('status' => true,'message' => 'Berhasil mendaftarkan usaha', 'id' => $conn->insert_id);
    } else {
        $response = array('status' => false,'message' => 'Gagal mendaftarkan usaha');
        $qry = $conn->query("INSERT INTO `log` VALUES(NULL, '$str')");
    }
    echo json_encode($response);