<?php
    include "connection.php";

    $data = file_get_contents('php://input');
    $json_data = json_decode($data , true);

    $id_perusahaan = $json_data['id_perusahaan'];
    $id_pengguna = $json_data['id_pengguna'];
    $total_beli = $json_data['total_beli'];
    $tanggal = date('Y-m-d');
    $status = $json_data['status'];
    $midtrans_transaction_id = $json_data['midtrans_transaction_id'];

    $str = "INSERT INTO transaksi VALUES(
        NULL,
        '$id_perusahaan',
        '$id_pengguna',
        '$total_beli',
        '$tanggal',
        '$status',
        '$midtrans_transaction_id'
    )";
    $qry = $conn->query($str);
    if($qry){
        $response = array('status' => true,'message' => 'Berhasil melakukan transaksi', 'id' => $conn->insert_id);
    } else {
        $response = array('status' => false,'message' => 'Gagal melakukan transaksi');
    }
    echo json_encode($response);