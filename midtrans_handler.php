<?php

include "connection.php";
require_once __DIR__ . '/vendor/autoload.php';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$serverKey = 'SB-Mid-server-hfTWZInpHDkuw7MiX9SVRtLQ';
$notif = new \Midtrans\Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$gross_amount = $notif->gross_amount;
$transaction_id = $notif->transaction_id;
$fraud = $notif->fraud_status;

if ($transaction == 'capture') {
  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
  if ($type == 'credit_card'){
    if($fraud == 'challenge'){
      // TODO set payment status in merchant's database to 'Challenge by FDS'
      // TODO merchant should decide whether this transaction is authorized or not in MAP
      $status = "gagal";
      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
      }
      else {
      // TODO set payment status in merchant's database to 'Success'
      $status = "berhasil";
      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
      }
    }
  }
else if ($transaction == 'settlement'){
  // TODO set payment status in merchant's database to 'Settlement'
    $status = "berhasil";
  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
  }
  else if($transaction == 'pending'){
  // TODO set payment status in merchant's database to 'Pending'
      $status = "pending";
  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
  }
  else if ($transaction == 'deny') {
  // TODO set payment status in merchant's database to 'Denied'
      $status = "gagal";
  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
  }
  else if ($transaction == 'expire') {
  // TODO set payment status in merchant's database to 'expire'
      $status = "gagal";
  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
  }
  else if ($transaction == 'cancel') {
  // TODO set payment status in merchant's database to 'Denied'
      $status = "dibatalkan";
  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}



$str = "SELECT id FROM transaksi WHERE midtrans_transaction_id='$transaction_id'";
$qry = $conn->query($str);
$found_in_trx = $qry->num_rows;

if($found_in_trx){
  $trx_type = "transaksi";
} else {
  $trx_type = "donasi";
}

$str = "UPDATE $trx_type SET 
        status='$status'
        WHERE midtrans_transaction_id='$transaction_id'";            
$qry = $conn->query($str);

if($status=="berhasil"){    
    $str = "SELECT p.id, t.total_donasi, p.total_saham, p.harga  FROM $trx_type t INNER JOIN perusahaan p ON t.id_perusahaan = p.id WHERE midtrans_transaction_id='$transaction_id'";
    $qry = $conn->query($str);
    $perusahaan = $qry->fetch_object();

    $terpenuhi = 0;
    IF($perusahaan->total_saham+$perusahaan->total_donasi >= $perusahaan->harga){
      $terpenuhi = 1;
    }

    $str = "UPDATE perusahaan SET total_saham=total_saham+'$perusahaan->total_donasi', terpenuhi='$terpenuhi' WHERE id='$perusahaan->id'";        
    $qry = $conn->query($str);
}