<?php

require_once __DIR__ . '../../../init.php';
// require_once __DIR__ . '../../../auth_check.php';

$user_name = unserialize($_SESSION['user_login'])->user_username;

$user_role = $modelRole->getRoleById(unserialize($_SESSION['user_login'])->role_id);
?>

<nav class="bg-blue-600 p-4 shadow-lg rounded-lg">
    <div class="container mx-auto flex justify-between items-center">
        <div class="ml-1 text-white font-bold text-2xl italic flex items-center">
            <i class="fas fa-shoe-prints text-yellow-300 mr-2"></i>
            <span class="text-yellow-300">laundry</span>_shoes
        </div>

        <div class="relative flex items-center text-white mr-3">

            <!-- Tempat untuk foto berbentuk lingkaran -->
            <div class="group relative">

                <img src="../../public/img/gita.jpg" alt="Profile Image"
                    class="w-12 h-12 rounded-full mr-4 object-cover border-2 border-gray-300">

                <!-- Teks Username dan Role, hidden secara default dan muncul saat hover -->
                <div
                    class="absolute right-0 top-14 bg-blue-800 text-white p-4 rounded-lg hidden group-hover:flex flex-col items-center justify-center border-2 border-gray-400 transition-all duration-300 ease-in-out">
                    <!-- Foto Profil yang muncul saat hover -->
                    <img src="../../public/img/gita.jpg" alt="Profile Image"
                        class="w-10 h-10 rounded-full my-1 object-cover border-2 border-gray-300">
                    <!-- Username dan Role -->
                    <span class="text-white text-center font-semibold">
                        <?= $user_name ?></span>
                    <span class="text-slate-300 text-center italic"><?= $user_role->role_nama ?></span>
                </div>
            </div>

            <form action="../../response_input.php?modul=logout&fitur=user" method="POST">
                <button type="submit"
                    class="ml-6 bg-yellow-500 hover:bg-yellow-400 hover:text-black text-white font-semibold py-2 px-6 rounded-xl flex items-center border-2 border-yellow-600 transition-all duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                    </svg>
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>