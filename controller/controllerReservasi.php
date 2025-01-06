<?php

require_once "/laragon/www/laundry_shoes/model/modelReservasiSql.php";

class ControllerReservasi {
    private $modelReservasi;

    public function __construct() {
        $this->modelReservasi = new ModelReservasiSql();
    }

    public function handleAction($action) {
        switch ($action) {
            case 'add':
                // Validasi data POST
               
                if (isset($_POST['user_id'], $_POST['status_id'], $_POST['uang_bayar'], $_POST['uang_kembali'], $_POST['layanans'])) {
                    $user_id = intval($_POST['user_id']);
                    $status_id = intval($_POST['status_id']);
                    $uang_bayar = intval($_POST['uang_bayar']);
                    $uang_kembali = intval($_POST['uang_kembali']);

                    // Validasi data layanans[]
                    $detailReservasi = json_decode($_POST['layanans'], true);
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($detailReservasi) || empty($detailReservasi)) {
                        echo "<script>alert('Data detail reservasi tidak valid!'); window.history.back();</script>";
                        break;
                    }

                    foreach ($detailReservasi as $layanan) {
                        if (!isset($layanan['layanan_id'], $layanan['jumlah']) || intval($layanan['jumlah']) <= 0) {
                            echo "<script>alert('Data layanan tidak lengkap atau tidak valid!'); window.history.back();</script>";
                            break 2;
                        }
                    }
                    // var_dump($_POST);
                    // Tambahkan reservasi dan detailnya
                    $isSuccess = $this->modelReservasi->addReservasi($detailReservasi, $user_id, $status_id, $uang_bayar, $uang_kembali);

                    if ($isSuccess) {
                        echo "<script>alert('Reservasi berhasil ditambahkan!'); ";
                    } else {
                        echo "<script>alert('Gagal menambahkan reservasi!'); window.history.back();</script>";
                    }
                } else {
                    echo "<script>alert('Data yang dikirim tidak lengkap!'); window.history.back();</script>";
                }
                break;

            case 'delete':
                // Hapus reservasi berdasarkan ID
                if (isset($_GET['id'])) {
                    $reservasiId = intval($_GET['id']);
                    if ($this->modelReservasi->deleteReservasi($reservasiId)) {
                        echo "<script>alert('Reservasi berhasil dihapus!'); window.location.href='/laundry_shoes/views/reservasi/reservasi_list.php';</script>";
                    } else {
                        echo "<script>alert('Gagal menghapus reservasi!'); window.location.href='/laundry_shoes/views/reservasi/reservasi_list.php';</script>";
                    }
                } else {
                    echo "<script>alert('ID reservasi tidak ditemukan!'); window.history.back();</script>";
                }
                break;

            default:
                echo "<script>alert('Aksi tidak dikenal!'); window.location.href='/laundry_shoes/views/reservasi/reservasi_list.php';</script>";
                break;
        }
    }
}

?>