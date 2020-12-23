Algoritma Register

BEGIN
    DO
        Read nama
        Read telp
        Read alamat
        Read pekerjaan
        Read tanggal_lahir
        Read jenis_kelamin
        Read username
        Read password
        Read konfirmasi_password

        input_salah = false
        IF username telah terdaftar
            print "Username telah digunakan, silahkan gunakan username lain"
            input_salah = true
        END IF
        
        IF password tidak sama dengan konfirmasi_password
            print "Konfirmasi password berbeda, silahkan cek kembali"
            input_salah = true
        END IF

    WHILE input_salah

    simpan_pengguna(nama, telp, alamat, pekerjaan, tanggal_lahir, jenis_kelamin, username, password)
END


Algoritma Login

BEGIN
    Read username
    Read password

    data_pengguna = ambil data pengguna berdasarkan username dan password

    IF data_pengguna tidak ditemukan
        print "login gagal, username dan password tidak ditemukan"
    ELSE
        print "login berhasil"
        goto halaman beranda aplikasi
    END IF
END


Algoritma Transaksi

BEGIN
    Read id_perusahaan
    Read id_pengguna
    Read nominal

    snap_result = snap_api_midtrans(nominal, SNAP_CLIENT_KEY)

    simpan_transaksi(id_perusahaan, id_pengguna, nominal, snap_result.status, snap_result.transaction_id)
END



Algoritma Donasi

BEGIN
    Read id_perusahaan
    Read id_pengguna
    Read nominal

    snap_result = snap_api_midtrans(nominal, SNAP_CLIENT_KEY)

    simpan_donasi(id_perusahaan, id_pengguna, nominal, snap_result.status, snap_result.transaction_id)
END


Algoritma Midtrans_Notification_Handler

BEGIN
    Read midtrans_notification

    IF midtrans_notification.transaction_id tersedia pada data transaksi 
        update transaksi set status=midtrans_notification.status berdasarkan midtrans_notification.transaction_id
        id_perusahaan = get id_perusahaan dari transaksi berdasarkan midtrans_notification.transaction_id
    ELSE IF
        update donasi set status=midtrans_notification.status berdasarkan midtrans_notification.transaction_id
        id_perusahaan = get id_perusahaan dari transaksi berdasarkan midtrans_notification.transaction_id
    END IF

    IF midtrans_notification.status == "Berhasil"
        update perusahaan set total_saham=total_saham+midtrans_notification.gross_amount berdasarkan id_perusahaan
    END IF
END