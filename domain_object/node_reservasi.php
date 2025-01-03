<?php
class reservasi {
    public $reservasi_id;
    public $layanan_id;
    public $reservasi_jumlah;
    public $status_id;
   

   public function __construct($reservasi_id, $layanan_id, $reservasi_jumlah, $status_id) {
        $this->reservasi_id = $reservasi_id;
        $this->layanan_id = $layanan_id;
        $this->reservasi_jumlah = $reservasi_jumlah;
        $this->status_id = $status_id;
    }
}