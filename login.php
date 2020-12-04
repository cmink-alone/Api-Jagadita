<?php
    include "connection.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = $conn->query("SELECT * FROM pengguna WHERE username='$username' AND password='$password'");
    $user = $qry->fetch_object();
    if($user){
        echo json_encode($user);
    } else {
        echo "{id:-1}";
    }