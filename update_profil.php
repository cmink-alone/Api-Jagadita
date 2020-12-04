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

    $str = "UPDATE pengguna SET 
    nama='$nama',
    telp='$telp',
    alamat='$alamat',
    pekerjaan='$pekerjaan',
    tanggal_lahir='$tanggal_lahir',
    jenis_kelamin='$jenis_kelamin'
    WHERE id='$id'";
    $qry = $conn->query($str);
    if($qry){
        $response = array('status' => true,'message' => 'Berhasil mengubah profil');
    } else {
        $response = array('status' => false,'message' => 'Gagal mengubah profil');
    }
    echo json_encode($response);