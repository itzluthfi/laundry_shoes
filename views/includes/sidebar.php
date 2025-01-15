<?php
require_once __DIR__ . '../../../init.php';

$user_name = unserialize($_SESSION['user_login'])->user_username;
$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->role_id);
?>

<div class="relative flex h-[calc(100vh-2rem)]">
    <!-- Sidebar -->
    <div id="sidebar"
        class="relative flex flex-col w-64 bg-blue-700 text-white p-4 shadow-lg rounded-xl transition-transform duration-300 transform ">
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between mb-6">
            <h5 class="text-xl font-semibold italic tracking-wide">WELCOME BACK!!</h5>
            <button id="closeSidebar" class="text-gray-400 hover:text-white">
                <i class="fa-solid fa-times"></i>
            </button>
        </div>

        <!-- User Info -->
        <div class="flex items-center mb-6">
            <img src="../../public/img/gita.jpg" alt="User"
                class="w-16 h-16 rounded-full object-cover border-2 border-white">
            <div class="p-4 ml-4">
                <h6 class="font-bold text-white text-xl"> <?= $user_name ?> </h6>
                <span class="italic text-sm text-gray-300 "> <?= $user_role->role_nama ?> </span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col gap-4">
            <a href="../dashboard/dashboard.php" class="nav-link">
                <i class="fa-solid fa-house"></i>
                <span>Dashboard</span>
            </a>
            <a href="../role/role_list.php" class="nav-link">
                <i class="fa-solid fa-circle-user"></i>
                <span>Master Data Role</span>
            </a>
            <a href="../status/status_list.php" class="nav-link">
                <i class="fa-solid fa-bell"></i>
                <span>Master Data Status</span>
            </a>
            <a href="../user/user_list.php" class="nav-link">
                <i class="fa-solid fa-users"></i>
                <span>Master Data User</span>
            </a>
            <a href="../layanan/layanan_list.php" class="nav-link">
                <i class="fa-solid fa-handshake"></i>
                <span>Master Data Layanan</span>
            </a>

            <div class="relative group">
                <button class="nav-link">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Manage Reservasi</span>
                    <i class="fa-solid fa-chevron-down ml-auto"></i>
                </button>
                <div class="hidden pl-6 group-hover:block">
                    <a href="../reservasi/reservasi_input.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>Add Reservasi</span>
                    </a>
                    <a href="../reservasi/reservasi_list.php" class="sub-nav-link">
                        <i class="fa-solid fa-clipboard"></i>
                        <span>List Reservasi</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-4">
        <button id="openSidebar" class="p-2 bg-gray-900 text-white rounded-lg shadow-lg hover:bg-gray-800">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
</div>

<script>
const sidebar = document.getElementById('sidebar');
const openSidebarBtn = document.getElementById('openSidebar');
const closeSidebarBtn = document.getElementById('closeSidebar');

openSidebarBtn.addEventListener('click', () => {
    sidebar.classList.remove('-translate-x-full');
    sidebar.classList.add('translate-x-0');
});

closeSidebarBtn.addEventListener('click', () => {
    sidebar.classList.add('-translate-x-full');
});
</script>

<style>
.nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    border-radius: 0.5rem;
    background: rgb(138, 181, 255);
    color: rgb(3, 9, 15);
    text-decoration: none;
    transition: all 0.2s;
}

.nav-link:hover {
    background: #4a5568;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.sub-nav-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem;
    border-radius: 0.375rem;
    background: rgb(138, 181, 255);
    color: rgb(3, 9, 15);
    text-decoration: none;
    transition: all 0.2s;
}

.sub-nav-link:hover {
    background: #4a5568;
    color: rgb(3, 9, 15);
}
</style>