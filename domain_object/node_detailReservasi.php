<?php

abstract class AbstractDetailReservasi {
    public $id;
    public $reservasi_id;
    public $layanan_id;
    public $jumlah;

    public function __construct($id, $reservasi_id, $layanan_id, $jumlah) {
        $this->id = $id;
        $this->reservasi_id = $reservasi_id;
        $this->layanan_id = $layanan_id;
        $this->jumlah = $jumlah;
    }

    // Abstract method: wajib diimplementasikan di kelas turunan
    abstract public function hitungTotalHarga($layananPrice);
}

class DetailReservasi extends AbstractDetailReservasi {
    public function hitungTotalHarga($layananPrice) {
        return $this->jumlah * $layananPrice;
    }
}