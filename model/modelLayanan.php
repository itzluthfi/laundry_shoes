<?php

require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '../../domain_object/node_layanan.php';

class modelLayanan {
    private $db;
    private $layanans = [];

    public function __construct() {
        // Gunakan koneksi database global
        $this->db = Databases::getInstance();
        // Ambil data dari database
        $this->layanans = $this->getAllLayananFromDB();
    }

    public function addLayanan($nama, $deskripsi, $harga) {
        $harga = (int)$harga;

        $query = "INSERT INTO layanan (nama, deskripsi, harga) 
                  VALUES ('$nama', '$deskripsi', $harga)";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->layanans = $this->getAllLayananFromDB();
            $_SESSION['layanans'] = serialize($this->layanans);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getAllLayananFromDB() {
        $query = "SELECT * FROM layanan";
        $result = $this->db->select($query);

        $layanans = [];
        foreach ($result as $row) {
            $layanans[] = new Layanan($row['id'], $row['nama'], $row['deskripsi'], $row['harga']);
        }
        return $layanans;
    }

    public function getLayananById($layanan_id) {
        $layanan_id = (int)$layanan_id;
        $query = "SELECT * FROM layanan WHERE id = $layanan_id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $layanan = new Layanan($row['id'], $row['nama'], $row['deskripsi'], $row['harga']);
            return $layanan;
        }

        return null;
    }

    public function updateLayanan($id, $nama, $deskripsi, $harga) {
        $id = (int)$id;
        $harga = (float)$harga;

        $query = "UPDATE layanan 
                  SET nama = '$nama', deskripsi = '$deskripsi', harga = $harga 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->layanans = $this->getAllLayananFromDB();
            $_SESSION['layanans'] = serialize($this->layanans);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }

    public function deleteLayanan($layanan_id) {
        $layanan_id = (int)$layanan_id;
        $query = "DELETE FROM layanan WHERE id = $layanan_id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->layanans = $this->getAllLayananFromDB();
            $_SESSION['layanans'] = serialize($this->layanans);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }

    // public function __destruct() {
    //     // Menutup koneksi database
    //     $this->db->close();
    // }
}