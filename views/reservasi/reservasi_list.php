<?php
require_once "/laragon/www/laundry_shoes/init.php";
require_once "/laragon/www/laundry_shoes/auth_check.php";
$reservasis = $modelReservasi->getAllReservasi();
var_dump($reservasis);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Script untuk mengaktifkan modal -->
    <script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function confirmDelete(reservasiId) {
        if (confirm('Apakah Anda yakin ingin menghapus reservasi ini?')) {
            // Redirect ke halaman delete dengan fitur=delete
            window.location.href = "/laundry_shoes/response_input.php?modul=reservasi&fitur=delete&id=" + reservasiId;
        } else {
            // Batalkan penghapusan
            alert("gagal menghapus data reservasi");
            return false;
        }
    }
    </script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal overflow-hidden">

    <!-- Navbar -->
    <?php include '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex">
        <!-- Sidebar -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto h-[calc(100vh-4rem)]">

            <h1 class="text-4xl font-bold mb-5 pb-2 text-gray-800 italic">Manage reservasis</h1>


            <!-- Main Container for Transactions -->
            <div class="container mx-auto">
                <input id="search-input" type="text" name="query" placeholder="Search By Name Or Id"
                    class="p-2 border border-gray-300 rounded-xl w-Search-Input " style="width: 26rem;" />
                <!-- reservasi Table -->
                <div class="bg-white shadow-md  my-6">
                    <table class="min-w-full bg-white table-auto mt-4 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID reservasi</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">User</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Total Harga</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Dibayar</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Kembalian</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php if (!empty($reservasis)) {
                                // var_dump($reservasis);
                                foreach ($reservasis as $reservasi) { ?>
                            <tr class="text-center">
                                <td class="py-3 px-4 text-blue-600">
                                    <?php echo htmlspecialchars($reservasi->id); ?></td>
                                <!-- <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($reservasi->date); ?></td> -->
                                <td class="w-1/6 py-3 px-4">
                                    <?php $user = $modelUser->getUserById($reservasi->user_id);$role = $modelRole->getRoleById($user->id_role); echo htmlspecialchars("{$user->user_username} - [{$role->role_nama}]"); ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <?php echo htmlspecialchars($reservasi->status_id); ?>
                                </td>

                                <td class="w-1/4 py-3 px-4">
                                    <?php 
                                    $total_harga = 0;
                                    foreach ($reservasi->detailReservasi as $detail) {
                                        $layanans = $modelLayanan->getlayananById($detail->layanan_id);
                                        $total_harga += htmlspecialchars($layanans->layanan_harga * $detail->jumlah); 
                                    }
                                    echo htmlspecialchars($total_harga); ?></td>
                                <td class="w-1/6 py-3 px-4"><?php echo htmlspecialchars($reservasi->uang_bayar); ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <?php echo htmlspecialchars($reservasi->uang_kembali); ?></td>
                                <td class="w-1/6 py-3 px-4">
                                    <div class="flex items-center space-x-4">


                                        <button
                                            class="border-2 border-gray-700 bg-white hover:bg-gray-800 hover:text-white text-gray-800 font-bold py-1 px-2 rounded"
                                            onclick="openModal('modal-<?php echo $reservasi->id; ?>')">
                                            Details
                                        </button>
                                        <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                            onclick="return confirmDelete(<?= $reservasi->id ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>

                                </td>
                            </tr>
                            <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk detail reservasi -->
    <?php if (!empty($reservasis)) {
    foreach ($reservasis as $reservasi) { ?>
    <div id="modal-<?php echo $reservasi->id; ?>"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div
            class="relative top-20 mx-auto p-8 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 shadow-xl rounded-lg bg-white transition-all duration-300 ease-in-out transform">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-2xl font-semibold text-gray-900">Detail Penjualan
                    #<?php echo htmlspecialchars($reservasi->id); ?></h3>
                <button class="text-gray-500 hover:text-gray-700"
                    onclick="closeModal('modal-<?php echo $reservasi->id; ?>')">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <div class="space-y-4">
                <!-- Informasi reservasis -->
                <div class="flex justify-between">
                    <div class="font-semibold text-gray-700">User</div>
                    <div><?php 
                        $user = $modelUser->getUserById($reservasi->user_id);
                        $role = $modelRole->getRoleById($user->id_role);
                        echo htmlspecialchars("{$user->user_username} - [{$role->role_nama}]");
                    ?></div>
                </div>



                <div class="flex justify-between">
                    <div class="font-semibold text-gray-700">Total Harga</div>
                    <div><?php echo htmlspecialchars($total_harga); ?></div>
                </div>

                <div class="flex justify-between">
                    <div class="font-semibold text-gray-700">Dibayar</div>
                    <div><?php echo htmlspecialchars($reservasi->uang_bayar); ?></div>
                </div>

                <div class="flex justify-between">
                    <div class="font-semibold text-gray-700">Kembalian</div>
                    <div><?php echo htmlspecialchars($reservasi->uang_kembali); ?></div>
                </div>

                <!-- Table Detail Barang -->
                <div class="mt-6">
                    <h4 class="text-lg font-semibold text-gray-800">Detail Barang</h4>
                    <table class="min-w-full bg-white table-auto mt-4 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-[#b6895b] text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">ID</th>
                                <th class="py-3 px-4 text-left">Nama</th>
                                <th class="py-3 px-4 text-right">Harga</th>
                                <th class="py-3 px-4 text-right">Jumlah</th>
                                <th class="py-3 px-4 text-right">Sub Total</th>
                            </tr>
                        </thead>

                        <tbody class="text-gray-700">
                            <?php foreach ($reservasi->detailReservasi as $detail) { 
                                 $layanans = $modelLayanan->getlayananById($detail->layanan_id);
                            ?>

                            <tr class="hover:bg-gray-100 transition-all duration-300">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($detail->layanan_id); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($layanans->layanan_nama); ?></td>
                                <td class="py-2 px-4 text-right">
                                    <?php echo htmlspecialchars($layanans->layanan_harga); ?>
                                </td>
                                <td class="py-2 px-4 text-right"><?php echo htmlspecialchars($detail->jumlah); ?>
                                </td>
                                <td class="py-2 px-4 text-right">
                                    <?php echo htmlspecialchars($layanans->layanan_harga * $detail->jumlah); ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Close Button -->
            <div class="mt-6 text-center">
                <button class="bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 transition duration-200"
                    onclick="closeModal('modal-<?php echo $reservasi->id; ?>')">
                    Close
                </button>
            </div>
        </div>
    </div>
    <?php } } ?>





</body>

</html>