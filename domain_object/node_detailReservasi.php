<?php

class DetailReservasi {
    public $id;
    public $reservasi_id;
    public $layanan_id;
    public $jumlah;

    public function __construct($id,$reservasi_id,$layanan_id, $jumlah) {
        $this->id = $id;
        $this->jumlah = $jumlah;
        $this->reservasi_id = $reservasi_id;
        $this->layanan_id = $layanan_id;
    }
}
?>