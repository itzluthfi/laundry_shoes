<?php

require_once __DIR__ . '../../model/modelReservasiSql.php';

class ControllerReservasi {
    private $modelReservasi;

    public function __construct() {
        $this->modelReservasi = new ModelReservasiSql();
    }

    public function handleAction($action) {
        switch ($action) {
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            // die();
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

                    if ($isSuccess === true) {
                        echo "<script>alert('Reservasi berhasil ditambahkan!'); window.history.back(); </script>";
                    } else {
                        echo "<script>alert('Gagal menambahkan reservasi!'); window.history.back();</scrip>";
                    }
                } else {
                    echo "<script>alert('Data yang dikirim tidak lengkap!'); window.history.back();</script>";
                }
                break;

                case 'delete':
                    // Hapus reservasi berdasarkan ID
                    if (isset($_GET['id'])) {
                        $reservasiId = intval($_GET['id']);
                        $deleteResult = $this->modelReservasi->deleteReservasi($reservasiId);
                
                        if ($deleteResult === true) {
                            // Jika berhasil dihapus
                            echo "<script>alert('Reservasi berhasil dihapus!'); window.history.back();</script>";
                        } else {
                            // Jika terjadi kesalahan, tampilkan pesan dari model
                            echo "<script>alert('Gagal menghapus reservasi: " . addslashes($deleteResult) . "'); window.history.back();</script>";
                        }
                    } else {
                        echo "<script>alert('ID reservasi tidak ditemukan!'); window.history.back();</script>";
                    }
                    break;
                



            case 'updateStatus':
                // Update status reservasi berdasarkan ID
                   if (isset($_POST['reservasi_id'], $_POST['status_id'])) {
                       $reservasiId = intval($_POST['reservasi_id']);
                       $statusId = intval($_POST['status_id']);
                
                       if ($this->modelReservasi->updateReservasiStatus($reservasiId, $statusId)) {
                           echo "<script>alert('Status reservasi berhasil diperbarui!'); window.history.back();</script>";
                             header("location: ./views/reservasi/reservasi_list.php");
                             exit();

                       } else {
                           echo "<script>alert('Gagal memperbarui status reservasi!'); window.history.back();</script>";
                       }
                    } else {
                      echo "<script>alert('Data yang dikirim tidak lengkap!'); window.history.back();</script>";
                    }
                break;

            default:
                 echo "<script>alert('Aksi tidak dikenal!'); </script>";
                 header("location: ./views/reservasi/reservasi_list.php");
                break;
                
        }
    }
}

?>