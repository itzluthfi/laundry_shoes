<?php
// require_once "/laragon/www/laundry_shoes/init.php";

require_once __DIR__ . '../../init.php';
$user_login = unserialize($_SESSION['customer_login']);
$reservasiData = $modelReservasi->getReservasiByUserId($user_login->user_id);

$user = $modelUser->getUserById($user_login->user_id);
// var_dump($user);    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Reservasi Sepatu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-6 max-h-[630px] overflow-y-auto overflow-hidden">
            <!-- Profil Pengguna -->
            <div class="flex justify-end my-4">
                <button onclick="window.history.back()"
                    class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition-all">
                    Kembali
                </button>
            </div>
            <!-- Tambahkan di tempat yang sesuai dalam body -->

            <div class="flex items-center mb-8">
                <img src="../public/img/gita.jpg" alt="Foto Profil"
                    class="w-20 h-20 rounded-full border-2 border-yellow-500 object-cover">
                <div class="ml-4">
                    <h2 class="text-xl font-bold text-gray-800">Username: <?= $user->user_username ?></h2>
                    <p class="text-gray-600">Role:
                        <?php 
                            $role = $modelRole->getRoleById($user->role_id);
                            echo htmlspecialchars($role->role_nama);
                        ?>
                    </p>
                </div>
            </div>

            <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Cek Reservasi Sepatu</h1>

            <!-- Form untuk cek reservasi -->
            <form action="" method="POST" class="mb-6">
                <label for="id" class="block text-sm font-medium text-gray-700">Masukkan ID Reservasi</label>
                <div class="mt-2 flex">
                    <input type="text" id="id" name="id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"
                        placeholder="Contoh: 1" required />
                    <button type="submit"
                        class="ml-4 bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition-all">
                        Cek
                    </button>
                </div>
            </form>

            <?php
                // Ambil ID reservasi dari form
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $found = false;

                foreach ($reservasiData as $reservasi) {
                    if ($reservasi->id == $id) {
                        $found = true;
                        echo "
                        <div id='hasilSearch' class='bg-green-100 p-4 rounded-lg relative'>
                            <button class='absolute top-2 right-2 text-gray-500 hover:text-gray-700' onclick='closeSearchResult()'>
                                <i data-feather='x' class='w-6 h-6'></i>
                            </button>
                            <p class='text-sm text-gray-800'><strong>ID Reservasi:</strong> {$reservasi->id}</p>
                            <p class='text-sm text-gray-800'><strong>Status:</strong> {$reservasi->status_id}</p>
                            <p class='text-sm text-gray-800'><strong>Uang Bayar:</strong> Rp " . number_format($reservasi->uang_bayar, 0, ',', '.') . "</p>
                            <p class='text-sm text-gray-800'><strong>Uang Kembali:</strong> Rp " . number_format($reservasi->uang_kembali, 0, ',', '.') . "</p>
                            <p class='text-sm text-gray-800'><strong>Tanggal:</strong> {$reservasi->date}</p>
                            <hr class='my-4'>
                            <h3 class='font-semibold text-gray-800 mb-2'>Detail Reservasi:</h3>
                            <ul class='list-disc pl-6 text-sm text-gray-800'>";
                        
                        // Iterasi melalui detailReservasi
                        foreach ($reservasi->detailReservasi as $detail) {
                            echo "
                            <li>
                                <strong>ID Layanan:</strong> {$detail->layanan_id},
                                <strong>Jumlah:</strong> {$detail->jumlah} Pasang
                            </li>";
                        }
                        
                        echo "
                            </ul>
                        </div>";
                        break;
                    }
                }
                
                if (!$found) {
                    echo "
                    <div id='hasilSearch' class='bg-red-100 p-4 rounded-lg relative'>
                        <button class='absolute top-2 right-2 text-gray-500 hover:text-gray-700' onclick='closeSearchResult()'>
                            <i data-feather='x' class='w-6 h-6'></i>
                        </button>
                        <p class='text-sm text-gray-800'>Reservasi dengan ID <strong>$id</strong> tidak ditemukan.</p>
                    </div>";
                }
            }
            ?>

            <!-- Daftar Reservasi -->
            <h2 class="text-xl font-bold text-gray-800 mt-8 mb-4">Daftar Reservasi</h2>
            <div class="overflow-x-auto">
                <table
                    class="w-full border-collapse border border-gray-300 text-center table-auto overflow-hidden shadow-md overflow-y-auto">
                    <thead class="bg-yellow-400 text-white">
                        <tr>
                            <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID reservasi</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">User</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                            <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Total Harga</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Dibayar</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Kembalian</th>
                            <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservasiData as $reservasi): 
                                $status = $modelStatus->getStatusById($reservasi->status_id); 
                         ?>
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4 text-blue-600">
                                <?php echo htmlspecialchars($reservasi->id); ?></td>
                            <!-- <td class="w-1/4 py-3 px-4"><?php echo htmlspecialchars($reservasi->date); ?></td> -->
                            <td class="w-1/6 py-3 px-4">
                                <?php $user = $modelUser->getUserById($reservasi->user_id);$role = $modelRole->getRoleById($user->role_id); echo htmlspecialchars("{$user->user_username} - [{$role->role_nama}]"); ?>
                            </td>
                            <td class="w-1/4 py-3 px-4">
                                <span
                                    class="bg-<?= $status->status_color ?>-100 text-<?= $status->status_color ?>600 
                        inline-flex items-center justify-center px-4 py-1 rounded-full text-sm font-semibold shadow-sm transition-all duration-200 hover:shadow-md hover:scale-105">
                                    <?php echo htmlspecialchars($status->status_nama); ?>
                                </span>

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
                                        class="flex border-2 border-gray-700 bg-white hover:bg-gray-800 hover:text-white text-gray-800 font-bold py-1 px-2 rounded"
                                        onclick="openModal('modal-<?php echo $reservasi->id; ?>')">
                                        Details

                                    </button>

                                </div>

                            </td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>


    <!-- Modal untuk detail reservasi -->
    <?php if (!empty($reservasiData)) {
foreach ($reservasiData as $reservasi) { ?>
    <div id="modal-<?php echo $reservasi->id; ?>"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden"
        onclick="closeModalOnOutsideClick(event, 'modal-<?php echo $reservasi->id; ?>')">
        <div class="relative h-[500px] overflow-y-auto top-20 mx-auto p-8 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 shadow-xl rounded-lg bg-white transition-all duration-300 ease-in-out transform"
            onclick="event.stopPropagation()">
            <!-- Mencegah propagasi klik ke container -->
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-2xl font-semibold text-gray-900">Detail Reservasi
                    #<?php echo htmlspecialchars($reservasi->id); ?></h3>
                <button class="text-gray-500 hover:text-gray-700"
                    onclick="closeModal('modal-<?php echo $reservasi->id; ?>')">
                    <i data-feather="x" class="w-6 h-6"></i>
                </button>
            </div>
            <div class="space-y-4">
                <!-- Informasi reservasi -->
                <div class="flex justify-between">
                    <div class="font-semibold text-gray-700">User</div>
                    <div><?php 
                    $user = $modelUser->getUserById($reservasi->user_id);
                    $role = $modelRole->getRoleById($user->role_id);
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
                    <h4 class="text-lg font-semibold text-gray-800">Detail Layanan</h4>
                    <table class="min-w-full bg-white table-auto mt-4 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-yellow-500 text-white">
                            <tr>
                                <th class="py-3 px-4 text-left">ID</th>
                                <th class="py-3 px-4 text-left">Nama Layanan</th>
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
                                <td class="py-2 px-4 text-right"><?php echo htmlspecialchars($detail->jumlah); ?></td>
                                <td class="py-2 px-4 text-right">
                                    <?php echo htmlspecialchars($layanans->layanan_harga * $detail->jumlah); ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php } } ?>

    <script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex'); // Tambahkan untuk memastikan modal tampil
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex'); // Hapus class `flex` saat modal ditutup
        }
    }

    function closeModalOnOutsideClick(event, id) {
        const modal = document.getElementById(id);
        if (event.target === modal) {
            closeModal(id);
        }
    }

    function closeSearchResult() {
        const searchResult = document.getElementById('hasilSearch');
        if (searchResult) {
            searchResult.style.display = 'none';
        }
    }

    feather.replace();
    </script>


</body>

</html>