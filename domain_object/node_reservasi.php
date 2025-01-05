<?php
class Reservasi {
    public $id;
    public $user_id;
    public $status_id;
    public $uang_bayar;
    public $uang_kembali;
    public $date;

    public array $detailReservasi = [];
   

   public function __construct($id, $user_id, $status_id,$uang_bayar,$uang_kembali,$date,array $detailReservasi = []) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->status_id = $status_id;
        $this->uang_bayar = $uang_bayar;
        $this->uang_kembali = $uang_kembali;
        $this->detailReservasi = $detailReservasi;
        $this->date = $date;
    }
}