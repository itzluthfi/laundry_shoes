<?php
require_once __DIR__  . '../../model/modelStatus.php';

class ControllerStatus {
    private $modelStatus;

    public function __construct() {
        $this->modelStatus = new modelStatus();
    }

    public function handleAction($action) {
        $message = ""; // Default pesan

        switch ($action) {
            case 'add':
                if (isset($_POST['status_nama'], $_POST['status_color'])) {
                    $status_nama = trim($_POST['status_nama']);
                    $status_color = trim($_POST['status_color']);

                    if ($this->modelStatus->addStatus($status_nama, $status_color)) {
                        $message = "Status berhasil ditambahkan!";
                    } else {
                        $message = "Gagal menambahkan status.";
                    }
                } else {
                    $message = "Data status tidak lengkap.";
                }
                break;

            case 'update':
                if (isset($_POST['id'], $_POST['status_nama'], $_POST['status_color'])) {
                    $id = intval($_POST['id']);
                    $status_nama = trim($_POST['status_nama']);
                    $status_color = trim($_POST['status_color']);

                    if ($this->modelStatus->updateStatus($id, $status_nama, $status_color)) {
                        $message = "Status berhasil diperbarui!";
                    } else {
                        $message = "Gagal memperbarui status.";
                    }
                } else {
                    $message = "Data status tidak lengkap atau ID tidak disediakan.";
                }
                break;

            case 'delete':
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);

                    if ($this->modelStatus->deleteStatus($id)) {
                        $message = "Status berhasil dihapus!";
                    } else {
                        $message = "Gagal menghapus status.";
                    }
                } else {
                    $message = "ID status tidak disediakan.";
                }
                break;

            default:
                $message = "Aksi tidak dikenali untuk status.";
                break;
        }

        // Redirect setelah aksi dilakukan
        echo "<script>alert('$message'); window.location.href='./views/status/status_list.php';</script>";
    }
}