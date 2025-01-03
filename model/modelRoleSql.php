<?php

require_once "/laragon/www/laundry_shoes/model/dbConnect.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_role.php";

class modelRole {
    private $db;
    private $roles = [];

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'laundrysepatu');

        if (isset($_SESSION['roles'])) {
            // Ambil data dari sesi
            $this->roles = unserialize($_SESSION['roles']);
        } else {
            // Jika sesi kosong, ambil dari database
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
        }
    }

   
    public function addRole($role_name, $role_description, $role_status) {
       
        $role_status = (int)$role_status;

        $query = "INSERT INTO roles (name, description, status) 
                  VALUES ('$role_name', '$role_description', $role_status)";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function getAllRoleFromDB() {
        $query = "SELECT * FROM roles";
        $result = $this->db->select($query);

        $roles = [];
        foreach ($result as $row) {
            $roles[] = new Role($row['id'], $row['name'], $row['description'], $row['status']);
        }
        return $roles;
    }

    public function getAllRole() {
        return $this->roles;
    }

    public function getRoleById($role_id) {
        $role_id = (int)$role_id;
        $query = "SELECT * FROM roles WHERE id = $role_id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $role = new Role($row['id'], $row['name'], $row['description'], $row['status']);
            return $role;
        }

        return null;
    }

    public function updateRole($id, $role_name, $role_description, $role_status) {
        $id = (int)$id;
        $role_status = (int)$role_status;

        $query = "UPDATE roles 
                  SET name = '$role_name', description = '$role_description', status = $role_status 
                  WHERE id = $id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function deleteRole($role_id) {
        $role_id = (int)$role_id;
        $query = "DELETE FROM roles WHERE id = $role_id";
        try {
            $this->db->execute($query);
            // Perbarui data dalam sesi
            $this->roles = $this->getAllRoleFromDB();
            $_SESSION['roles'] = serialize($this->roles);
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