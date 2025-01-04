<?php
class Reservasi {
    public $id;
    public $user_id;
    public $status_id;
    public $uang_bayar;
    public $uang_kembali;

    public array $detailReservasi = [];
   

   public function __construct($id, $layanan_id, $status_id,$uang_bayar,$uang_kembali,array $detailReservasi = []) {
        $this->id = $id;
        $this->layanan_id = $layanan_id;
        $this->status_id = $status_id;
        $this->uang_bayar = $uang_bayar;
        $this->uang_kembali = $uang_kembali;
        $this->detailReservasi = $detailReservasi;

    }
}