<?php

require_once "/laragon/www/laundry_shoes/model/dbConnect.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_reservasi.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_detailreservasi.php";

class ModelReservasiSql {
    private $db;

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'laundrysepatu');
    }

    public function addReservasi($detailReservasi, $user_id, $status_id, $uang_bayar, $uang_kembali) {
        $user_id = (int)$user_id;
        $status_id = (int)$status_id;
        $uang_bayar = (int)$uang_bayar;
        $uang_kembali = (int)$uang_kembali;
        $totalHarga = 0;
        foreach ($detailReservasi as $reservasi) {
            $totalHarga += $reservasi['layanan_harga'] * $reservasi['jumlah'];
        }


        $query = "INSERT INTO reservasi (user_id, status_id,total_harga, uang_bayar, uang_kembali) 
                  VALUES ($user_id, $status_id, $totalHarga,$uang_bayar, $uang_kembali)";

        try {
            $this->db->execute($query);
            $reservasiId = $this->db->conn->insert_id;

            foreach ($detailReservasi as $reservasi) {
                $layanan_id = (int)$reservasi['layanan_id'];
                $jumlah = (int)$reservasi['jumlah'];

                $detailQuery = "INSERT INTO detail_reservasi (reservasi_id, layanan_id, jumlah) 
                                VALUES ($reservasiId, $layanan_id, $jumlah)";
                $this->db->execute($detailQuery);
            }

            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error adding reservasi: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function getAllReservasi() {
        $query = "SELECT * FROM reservasi";
        $result = $this->db->select($query);

        $reservasiList = [];
        foreach ($result as $row) {
            $reservasiId = $row['id'];
            $details = $this->getDetailReservasiByReservasiId($reservasiId);
            $reservasiList[] = new Reservasi(
                $reservasiId,
                $row['user_id'],
                $row['status_id'],
                $row['uang_bayar'],
                $row['uang_kembali'],
                $details
            );
        }
        return $reservasiList;
    }

    public function getReservasiById($reservasiId) {
        $query = "SELECT * FROM reservasi WHERE id = $reservasiId";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $details = $this->getDetailReservasiByReservasiId($reservasiId);
            return new Reservasi(
                $row['id'],
                $row['user_id'],
                $row['status_id'],
                $row['uang_bayar'],
                $row['uang_kembali'],
                $details
            );
        }
        return null;
    }

    private function getDetailReservasiByReservasiId($reservasiId) {
        $query = "SELECT * FROM detail_reservasi WHERE reservasi_id = $reservasiId";
        $result = $this->db->select($query);

        $details = [];
        foreach ($result as $row) {
            $details[] = new DetailReservasi(
                $row['id'],
                $row['reservasi_id'],
                $row['layanan_id'],
                $row['jumlah']
            );
        }
        return $details;
    }

    public function deleteReservasi($reservasiId) {
        $reservasiId = (int)$reservasiId;

        try {
            $this->db->execute("DELETE FROM detail_reservasi WHERE reservasi_id = $reservasiId");
            $this->db->execute("DELETE FROM reservasi WHERE id = $reservasiId");

            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error deleting reservasi: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function __destruct() {
        // Menutup koneksi database
        $this->db->close();
    }
}

?>