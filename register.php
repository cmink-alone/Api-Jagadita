<?php
    include "connection.php";

    $data = file_get_contents('php://input');
    $json_data = json_decode($data , true);

    $id = $json_data['id'];
    $nama = $json_data['nama'];
    $telp = $json_data['telp'];
    $alamat = $json_data['alamat'];
    $pekerjaan = $json_data['pekerjaan'];
    $tanggal_lahir = $json_data['tanggal_lahir'];
    $jenis_kelamin = $json_data['jenis_kelamin'];
    $username = $json_data['username'];
    $password = $json_data['password'];

    $str = "INSERT INTO pengguna VALUES(
        NULL,
        '$username',
        '$password',
        '$nama',
        '$telp',
        '$alamat',
        '$pekerjaan',
        '$tanggal_lahir',
        '$jenis_kelamin'
    )";
    $qry = $conn->query($str);
    if($qry){
        $response = array('status' => true,'message' => 'Berhasil mendaftar', 'id' => $conn->insert_id);
    } else {
        $response = array('status' => false,'message' => 'Gagal mendaftar');
    }
    echo json_encode($response);