<?php
class Layanan {
    public $layanan_id;
    public $layanan_nama;
    public $layanan_deskripsi;
    public $layanan_harga;
   

    public function __construct($layanan_id, $layanan_nama, $layanan_deskripsi, $layanan_harga) {
        $this->layanan_id = $layanan_id;
        $this->layanan_nama = $layanan_nama;
        $this->layanan_deskripsi = $layanan_deskripsi;
        $this->layanan_harga = $layanan_harga;
    }
}