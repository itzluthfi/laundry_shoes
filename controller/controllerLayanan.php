<?php
require_once __DIR__  . '../../model/modelLayanan.php';

class ControllerLayanan {
    private $modelLayanan;

    public function __construct() {
        $this->modelLayanan = new modelLayanan();
    }

    public function handleAction($action) {
        $message = ""; // Default pesan

        switch ($action) {
            case 'add':
                if (isset($_POST['nama'], $_POST['deskripsi'], $_POST['harga'])) {
                    $nama = trim($_POST['nama']);
                    $deskripsi = trim($_POST['deskripsi']);
                    $harga = (int)$_POST['harga'];

                    if ($this->modelLayanan->addLayanan($nama, $deskripsi, $harga)) {
                        $message = "Layanan berhasil ditambahkan!";
                    } else {
                        $message = "Gagal menambahkan layanan.";
                    }
                } else {
                    $message = "Data layanan tidak lengkap.";
                }
                break;

            case 'update':
                if (isset($_GET['id'], $_POST['nama'], $_POST['deskripsi'], $_POST['harga'])) {
                    $id = intval($_GET['id']);
                    $nama = trim($_POST['nama']);
                    $deskripsi = trim($_POST['deskripsi']);
                    $harga = floatval($_POST['harga']);

                    if ($this->modelLayanan->updateLayanan($id, $nama, $deskripsi, $harga)) {
                        $message = "Layanan berhasil diperbarui!";
                    } else {
                        $message = "Gagal memperbarui layanan.";
                    }
                } else {
                    $message = "Data layanan tidak lengkap atau ID tidak disediakan.";
                }
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);

                    if ($this->modelLayanan->deleteLayanan($id)) {
                        $message = "Layanan berhasil dihapus!";
                    } else {
                        $message = "Gagal menghapus layanan.";
                    }
                } else {
                    $message = "ID layanan tidak disediakan.";
                }
                break;

            default:
                $message = "Aksi tidak dikenali untuk layanan.";
                break;
        }

        // Redirect setelah aksi dilakukan
        echo "<script>alert('$message'); window.location.href='./views/layanan/layanan_list.php';</script>";
    }
}