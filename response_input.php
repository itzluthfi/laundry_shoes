<?php
require_once "/laragon/www/laundry_shoes/init.php";

// Check request method (POST atau GET)
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SERVER['REQUEST_METHOD'] == 'GET') {
    // Tentukan modul dan action dari request
    $modul = isset($_POST["modul"]) ? $_POST["modul"] : $_GET["modul"];
    $action = isset($_POST["fitur"]) ? $_POST["fitur"] : $_GET["fitur"] ;

    // Arahkan setiap modul ke controller masing-masing
    switch ($modul) {
        case 'role':
            require_once 'controller/ControllerRole.php';
            $roleController = new ControllerRole();
            $roleController->handleAction($action);
            break;

       

        case 'user':
            require_once 'controller/ControllerUser.php';
            $userController = new ControllerUser();
            $userController->handleAction($action);
            break;

        
        // case 'sale':
        //     require_once 'controller/ControllerSale.php';
        //     $saleController = new ControllerSale();
        //     $saleController->handleAction($action);
        //     break;

        // case 'cart':
        //     require_once 'controller/ControllerCart.php';
        //     $cartController = new ControllerCart();
        //     $cartController->handleAction($action);
        //     break;
            
        case 'auth':
                switch ($action) {
                    case 'login':
                        $username = $_POST["username_login"];
                        $password = $_POST["password_login"];
                        $rememberMe = isset($_POST["remember_me"]); // Cek apakah "Remember Me" dicentang
                        $users = $modelUser->getAllUser();
                    
                        foreach ($users as $user) {
                            // Cocokkan username dan verifikasi password
                            if ($user->user_username == $username && password_verify($password, $user->user_password)) {
                                // Simpan data member ke session
                                $_SESSION['user_login'] = serialize($user);
                    
                                // Jika "Remember Me" dicentang, simpan cookie yang berlaku selama 1 hari
                                if ($rememberMe) {
                                    setcookie('user_login', serialize($user), time() + 86400, "/"); // 86400 detik = 1 hari
                                }
                                
                                // Redirect berdasarkan role
                                if ($user->id_role == 1) {
                                    echo "<script>alert('Login berhasil, welcome back again admin!'); window.location.href='/laundry_shoes/views/dashboard/dashboard.php';</script>";
                                    return;
                                } else if ($user->id_role == 2) {
                                    echo "<script>alert('Login berhasil, welcome back again customer!'); window.location.href='/laundry_shoes/views/web_laundry/index.php';</script>";
                                    return;
                                }
                            }
                        }
                    
                        // Jika tidak ditemukan user yang cocok
                        echo "<script>alert('Login gagal'); window.location.href='/laundry_shoes/views/loginPage.php';</script>";
                        break;
                    

                case 'registrasi':
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    $no_telp = $_POST["no_telp"];
                    $id_role = $_POST["id_role"];
                    $modelUser->addUser($username, $password, $id_role, $no_telp);
                    echo "<script>alert('Registrasi berhasil'); window.location.href='/laundry_shoes/views/web_laundry/loginPage.php';</script>";
                    break;
               
                }
            break;
        case 'logout':
                // Hapus sesi dan cookie
                session_unset();
                session_destroy(); 
                switch ($action) {
                case 'user':
                if (isset($_COOKIE['user_login'])) {
                    setcookie('user_login', '', time() - 3600, "/");
                }
                echo "<script>alert('Logout berhasil!'); window.location.href='/laundry_shoes/';</script>";

                break;

                case 'member':
                if (isset($_COOKIE['member_login'])) {
                    
                    setcookie('member_login', '', time() - 3600, "/");
                }
                echo "<script>alert('Logout berhasil!'); window.location.href='/laundry_shoes/views/web_laundry/index.php';</script>";
                break;
                }
                echo "<script>alert('Logout gagal!fitur tak di kenal');</script>";
                
                break;

        default:
            echo "<script>alert('Module tidak dikenal.'); window.location.href='/laundry_shoes/{$modul}/{$modul}_list.php';</script>";
            break;
    }
}


?>