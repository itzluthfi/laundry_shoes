<?php

class User {
    public $user_id;
    public $user_username;
    public $user_password;
    public $id_role;
    public $no_telp;

    
    public function __construct($user_id,$user_username,$user_password,$id_role,$no_telp)
    {
        $this->user_id = $user_id;
        $this->user_username = $user_username;
        $this->user_password = $user_password;
        $this->id_role = $id_role;
        $this->no_telp = $no_telp;
    }
}

?>