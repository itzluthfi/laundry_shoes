<?php


require_once __DIR__ . '../../../init.php';
require_once __DIR__ . '../../../auth_check.php';


$obj_status = $modelStatus->getAllStatusFromDB();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Status</title>
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
    <?php include '../includes/navbar.php'; ?>


    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>



        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="container mx-auto overflow-y-auto h-[calc(100vh-4rem)] overflow-hidden max-h-[200px)]">
                <h1 class="text-4xl font-bold mb-5 pb-2 text-gray-800 italic">Manage Status</h1>

                <!-- Button to Insert New Status -->
                <div class="mb-4">
                    <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-plus"></i>
                        <a href="./status_input.php"> Add New Status</a>
                    </button>
                </div>
                <input id="search-input" type="text" name="query" placeholder="Search By Name Or Id"
                    class="p-2 border border-gray-300 rounded-xl w-Search-Input" />

                <!-- Status Table -->
                <div class="bg-white shadow-md rounded my-6">
                    <table class="min-w-full bg-white grid-cols-1">
                        <thead class="bg-yellow-500 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Status ID</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status Name</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Color</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <!-- Dynamic Data Rows -->
                            <?php foreach ($obj_status as $status) { ?>
                            <tr class="text-center">
                                <td class="py-3 px-4 text-yellow-600"><?= $status->status_id ?></td>
                                <td class="w-1/6 py-3 px-4"><?= $status->status_nama ?></td>
                                <td class="w-1/6 py-3 px-4">
                                    <span class="inline-block w-6 h-6 rounded-full"
                                        style="background-color: <?= $status->status_color ?>;"></span>
                                    <?= $status->status_color ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <button
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded mr-2">
                                        <a href="./status_update.php?id=<?= $status->status_id ?>"><i
                                                class="fa-regular fa-pen-to-square"></i></a>
                                    </button>
                                    <button
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                        onclick="return confirmDelete(<?= $status->status_id ?>)">
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
    function confirmDelete(statusId) {
        if (confirm('Apakah Anda yakin ingin menghapus status ini?')) {
            // Redirect ke halaman delete dengan fitur=delete
            window.location.href = "../../response_input.php?modul=status&fitur=delete&id=" + statusId;
        } else {
            // Batalkan penghapusan
            alert("Gagal menghapus data");
            return false;
        }
    }
    </script>

</body>

</html>