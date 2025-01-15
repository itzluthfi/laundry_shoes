<?php
require_once __DIR__ . '/dbConnection.php';
require_once __DIR__ . '../../domain_object/node_user.php';

class modelUser {
    private $db;

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = Databases::getInstance();
    }

    public function initializeDefaultUser() {
        // Cek apakah ada user yang terdaftar di database
        if (empty($this->getAllUser())) {
            $this->addUser("maul", "maul123", 1, "081234567890");
            $this->addUser("habib", "habib123", 3, "081234567891");
            $this->addUser("adam", "adam123", 4, "081234567892");
        }
    }

    public function addUser($user_username, $user_password, $role_id, $no_telp) {
        // Escape input untuk mencegah SQL Injection
        $user_username = mysqli_real_escape_string($this->db->conn, $user_username);
        $user_password = mysqli_real_escape_string($this->db->conn, $user_password);
        $no_telp = mysqli_real_escape_string($this->db->conn, $no_telp);
        $role_id = (int)$role_id;

        // Hash password sebelum disimpan
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users (username, password, role_id, no_telp) VALUES ('$user_username', '$hashed_password', $role_id, '$no_telp')";
        try {
            $this->db->execute($query);
            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }

    private function getRoleById($role_id) {
        $role_id = (int)$role_id;
        $query = "SELECT * FROM roles WHERE id = $role_id";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $role = new Role($row['id'], $row['nama'], $row['deskripsi'], $row['status']);
            return $role;
        }

        return null;
    }

    public function getAllUser() {
        $query = "SELECT * FROM users";
        $result = $this->db->select($query);

        if (count($result) == 0) {
            return null;
        }
        
        $users = [];
        foreach ($result as $row) {
            // Membuat objek User dan menyimpannya ke array
            $role = $this->getRoleById($row['role_id']);
            $users[] = new User($row['id'], $row['username'], $row['password'], $row['no_telp'],$row['role_id'],$role->role_nama, $role->role_deskripsi, $role->role_status);
        }

        return $users;
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $this->db->select($query);

        
        if (count($result) > 0) {
            $role = $this->getRoleById($result[0]['role_id']);
            $row = $result[0];
            $user = new User($row['id'], $row['username'], $row['password'], $row['no_telp'],$row['role_id'],$role->role_nama, $role->role_deskripsi, $role->role_status);
            return $user;
        }
        
        return null;
    }

    public function updateUser($id, $user_username, $user_password, $role_id, $no_telp) {
        // Escape input untuk mencegah SQL Injection
        $user_username = mysqli_real_escape_string($this->db->conn, $user_username);
        $user_password = mysqli_real_escape_string($this->db->conn, $user_password);
        $no_telp = mysqli_real_escape_string($this->db->conn, $no_telp);
        $role_id = (int)$role_id;

        // Hash password sebelum disimpan
        $hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

        $query = "UPDATE users SET username = '$user_username', password = '$hashed_password', role_id = $role_id, no_telp = '$no_telp' WHERE id = $id";
        try {
            $this->db->execute($query);

            // Update sesi setelah berhasil diupdate di DB
            $updatedUser = $this->getUserById($id);
            $_SESSION['user'] = $updatedUser;

            return true;
        } catch (Exception $e) {
             return $e->getMessage();

        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = $id";
        try {
            $this->db->execute($query);

            return true;
        } catch (Exception $e) {
            return $e->getMessage();

        }
    }
}
?>