<?php 
require_once "./init.php";

// Cek apakah ada sesi pengguna yang aktif
if (isset($_SESSION['user_login'])) {
    // Jika ada, arahkan ke halaman role_list
    header('Location: /laundry_shoes/views/dashboard/dashboard.php');
    exit();
}

// Cek apakah ada cookie untuk user_login
if (isset($_COOKIE['user_login'])) {
    // Jika ada, set sesi dari cookie
    $_SESSION['user_login'] = $_COOKIE['user_login'];

    // Arahkan ke halaman role_list
    header('Location: /laundry_shoes/views/dashboard/dashboard.php');
    exit();
}

// Jika tidak ada sesi atau cookie, tampilkan halaman login
require_once "views/loginPage.php";
?>

<!-- 
<?php 
require_once "./init.php";

// Cek apakah ada sesi pengguna yang aktif
if (isset($_SESSION['user_login'])) {
    // Jika ada sesi untuk ghost, arahkan ke halaman dashboard
    header('Location: /laundry_shoes/views/dashboard/dashboard.php');
    exit();
} elseif (isset($_SESSION['customer_login'])) {
    // Jika ada sesi untuk member, arahkan ke halaman login
    header('Location: /laundry_shoes/views/web_laundry/loginPage.php');
    exit();
}

// Cek apakah ada cookie untuk user_login
if (isset($_COOKIE['user_login'])) {
    // Jika ada, set sesi dari cookie
    $_SESSION['user_login'] = $_COOKIE['user_login'];
    // Arahkan ke halaman dashboard
    header('Location: /laundry_shoes/views/dashboard/dashboard.php');
    exit();
} elseif (isset($_COOKIE['customer_login'])) {
    // Jika ada, set sesi dari cookie
    $_SESSION['customer_login'] = $_COOKIE['customer_login'];
    // Arahkan ke halaman login
    header('Location: /laundry_shoes/views/web_laundry/loginPage.php');
    exit();
}

// Jika tidak ada sesi atau cookie, tampilkan halaman login
require_once "views/loginPage.php";
?> -->