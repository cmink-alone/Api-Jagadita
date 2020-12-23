<?php
    include "connection.php";

    $data = file_get_contents('php://input');
    $json_data = json_decode($data , true);

    $id_perusahaan = $json_data['id_perusahaan'];
    $id_donatur = $json_data['id_donatur'];
    $total_donasi = $json_data['total_donasi'];
    $tanggal = date('Y-m-d');
    $status = $json_data['status'];
    $midtrans_transaction_id = $json_data['midtrans_transaction_id'];

    $str = "INSERT INTO donasi VALUES(
        NULL,
        '$id_perusahaan',
        '$id_donatur',
        '$total_donasi',
        '$tanggal',
        '$status',
        '$midtrans_transaction_id'
    )";
    $qry = $conn->query($str);
    if($qry){
          if($status=='berhasil'){
            $str = "SELECT id, total_saham, harga FROM perusahaan WHERE id='$id_perusahaan'";
            $qry = $conn->query($str);
            $perusahaan = $qry->fetch_object();
            
            $terpenuhi = 0;
            IF($perusahaan->total_saham+$total_donasi >= $perusahaan->harga){
              $terpenuhi = 1;
            }

            $str = "UPDATE perusahaan SET total_saham=total_saham+'$total_donasi', terpenuhi='$terpenuhi' WHERE id='$id_perusahaan'";        
            $qry = $conn->query($str);
          }
        $response = array('status' => true,'message' => 'Berhasil melakukan donasi', 'id' => $conn->insert_id);
    } else {
        $response = array('status' => false,'message' => 'Gagal melakukan donasi');
    }
    echo json_encode($response);