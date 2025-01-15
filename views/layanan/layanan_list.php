<?php
require_once __DIR__ . '../../../init.php';
require_once __DIR__ . '../../../auth_check.php';

$obj_layanan = $modelLayanan->getAllLayananFromDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Layanan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<style>
.w-Search-Input {
    width: 400px;
}
</style>

<body class="bg-gray-100 font-sans leading-normal tracking-normal overflow-hidden">

    <!-- Navbar -->
    <?php include_once "../includes/navbar.php"; ?>"
    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include_once "../includes/sidebar.php"; ?>"

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <!-- Main Content -->
            <div class="container mx-auto overflow-y-auto max-h-[650px] overflow-hidden">
                <h1 class="text-4xl font-bold mb-5 pb-2 text-gray-800 italic">Manage Layanan</h1>

                <!-- Button to Insert New Layanan -->
                <div class="mb-4">
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-plus"></i>
                        <a href="./layanan_input.php"> Add New Layanan</a>
                    </button>
                </div>

                <input id="search-input" type="text" name="query" placeholder="Search By Name or ID"
                    class="p-2 border border-gray-300 rounded-xl w-Search-Input" />

                <!-- Layanan Table -->
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-full bg-white">
                        <thead class="bg-yellow-500 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Nama</th>
                                <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Deskripsi</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Harga</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <!-- Dynamic Data Rows -->
                            <?php foreach($obj_layanan as $layanan){ ?>
                            <tr class="text-center">
                                <td class="w-1/12 py-3 px-4 text-yellow-600"><?= $layanan->layanan_id ?></td>
                                <td class="w-1/4 py-3 px-4"><?= $layanan->layanan_nama ?></td>
                                <td class="w-1/3 py-3 px-4"><?= $layanan->layanan_deskripsi ?></td>
                                <td class="w-1/6 py-3 px-4">Rp. <?= number_format($layanan->layanan_harga) ?></td>
                                <td class="w-1/6 py-3 px-4">
                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">
                                        <a href="./layanan_update.php?id=<?= $layanan->layanan_id ?>"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                    </button>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                        onclick="return confirmDelete(<?= $layanan->layanan_id ?>)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    function confirmDelete(layananId) {
        if (confirm('Apakah Anda yakin ingin menghapus layanan ini?')) {
            window.location.href = "../../response_input.php?modul=layanan&fitur=delete&id=" + layananId;
        } else {
            alert("Gagal menghapus data");
            return false;
        }
    }
    </script>

</body>

</html>