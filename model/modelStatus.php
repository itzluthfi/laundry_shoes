<?php

require_once "/laragon/www/laundry_shoes/model/dbConnect.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_status.php";

class modelStatus {
    private $db;
    private $statuses = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'laundrysepatu');

        if (isset($_SESSION['statuses'])) {
            // Ambil data dari sesi
            $this->statuses = unserialize($_SESSION['statuses']);
        } else {
            // Jika sesi kosong, ambil dari database
            $this->statuses = $this->getAllStatusFromDB();
            $_SESSION['statuses'] = serialize($this->statuses);
        }
    }

    public function addStatus($nama, $color) {
        $query = "INSERT INTO status (nama, color) 
                  VALUES ('$nama', '$color')";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->statuses = $this->getAllStatusFromDB();
            $_SESSION['statuses'] = serialize($this->statuses);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getAllStatusFromDB() {
        $query = "SELECT * FROM status";
        $result = $this->db->select($query);

        $statuses = [];
        foreach ($result as $row) {
            $statuses[] = new Status($row['id'], $row['nama'], $row['color']);
        }
        return $statuses;
    }

    public function getStatusById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM status WHERE id = $id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $status = new Status($row['id'], $row['nama'], $row['color']);
            return $status;
        }

        return null;
    }

    public function updateStatus($id, $nama, $color) {
        $id = (int)$id;

        $query = "UPDATE status 
                  SET nama = '$nama', color = '$color' 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->statuses = $this->getAllStatusFromDB();
            $_SESSION['statuses'] = serialize($this->statuses);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteStatus($id) {
        $id = (int)$id;
        $query = "DELETE FROM status WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->statuses = $this->getAllStatusFromDB();
            $_SESSION['statuses'] = serialize($this->statuses);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function __destruct() {
        // Menutup koneksi database
        $this->db->close();
    }
}