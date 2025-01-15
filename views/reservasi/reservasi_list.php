<?php


require_once __DIR__ . '../../../init.php';
require_once __DIR__ . '../../../auth_check.php';

$reservasis = $modelReservasi->getAllReservasi();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar reservasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
    .modal {
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 50;
    }

    .hidden {
        display: none;
    }
    </style>

    <!-- Script untuk mengelola modal -->
    <script>
    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
        } else {
            console.error(`Modal with ID "${id}" not found.`);
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
        } else {
            console.error(`Modal with ID "${id}" not found.`);
        }
    }

    function confirmDelete(reservasiId) {
        if (confirm('Apakah Anda yakin ingin menghapus reservasi ini?')) {
            window.location.href = "../../response_input.php?modul=reservasi&fitur=delete&id=" + reservasiId;
        } else {
            alert("Gagal menghapus data reservasi.");
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

            <h1 class="text-4xl font-bold mb-5 pb-2 text-gray-800 italic">Manage Reservasi</h1>


            <!-- Main Container for Transactions -->
            <div class="container mx-auto">
                <input id="search-input" type="text" name="query" placeholder="Search By Name Or Id"
                    class="p-2 border border-gray-300 rounded-xl w-Search-Input " style="width: 26rem;" />
                <!-- reservasi Table -->
                <div class="bg-white shadow-md  my-6">
                    <table
                        class="min-w-full bg-white table-auto mt-4 rounded-lg overflow-y-hidden shadow-md max-h-[500px] overflow-auto">
                        <thead class="bg-yellow-500 text-white">
                            <tr>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">ID reservasi</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">User</th>
                                <th class="w-1/4 py-3 px-4 uppercase font-semibold text-sm">Status</th>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Total Harga</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Dibayar</th>
                                <th class="w-1/12 py-3 px-4 uppercase font-semibold text-sm">Kembalian</th>
                                <th class="w-1/6 py-3 px-4 uppercase font-semibold text-sm">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            <?php if (!empty($reservasis)) {
                             foreach ($reservasis as $reservasi) {
                                $status = $modelStatus->getStatusById($reservasi->status_id); 
                                $user = $modelUser->getUserById($reservasi->user_id);
                                
                                $detailReservasis = [];
                                $total_harga = 0;
                                    foreach ($reservasi->detailReservasi as $detail) {
                                        $layanan = $modelLayanan->getLayananById($detail->layanan_id);
                                        $total_harga += $layanan->layanan_harga * $detail->jumlah;
                                
                                        $detailReservasis[] = [
                                            'layanan_id' => $layanan->layanan_id,
                                            'layanan_name' => $layanan->layanan_nama,
                                            'layanan_price' => $layanan->layanan_harga,
                                            'layanan_qty' => $detail->jumlah, 
                                            'sub_total' => $layanan->layanan_harga * $detail->jumlah, 
                                        ];
                                        
                                    }
                            
                                    $reservasiPrint = [
                                        'reservasi_id' => $reservasi->id,
                                        'reservasi_date' => $reservasi->date,
                                        'reservasi_status' => $status->status_nama,
                                        'reservasi_totalPrice' => $total_harga,
                                        'reservasi_pay' => $reservasi->uang_bayar,
                                        'reservasi_change' => $reservasi->uang_kembali,
                                        'user_username' => $user->user_username,
                                        'role_name' => $user->role_nama,
                                        'detailReservasi' => $detailReservasis,
                                    ];
                                    
                                    
                            ?>
                            <tr class="text-center">
                                <td class="py-3 px-4 text-blue-600">
                                    <?php echo htmlspecialchars($reservasi->id); ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <?php 
                                $user = $modelUser->getUserById($reservasi->user_id);
                                $role = $modelRole->getRoleById($user->role_id); 
                                echo htmlspecialchars("{$user->user_username} - {$role->role_nama}"); 
                               
                            ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <span
                                        class="bg-<?= $status->status_color ?>-100 text-<?= $status->status_color ?>600 
                        inline-flex layanans-center justify-center px-4 py-1 rounded-full text-sm font-semibold shadow-sm transition-all duration-200 hover:shadow-md hover:scale-105">
                                        <?php echo htmlspecialchars($status->status_nama); ?>
                                    </span>
                                    <button class="ml-2 text-blue-600 hover:text-blue-800"
                                        onclick="openModal('modal-update-<?= $reservasi->id ?>')">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td class="w-1/12 py-3 px-4">
                                    <?php 
                                  $total_harga = 0;
                                    foreach ($reservasi->detailReservasi as $detail) {
                                        $layanans = $modelLayanan->getlayananById($detail->layanan_id);
                                        $total_harga += htmlspecialchars($layanans->layanan_harga * $detail->jumlah);
                                    }
                                    echo htmlspecialchars($total_harga); 
                                ?>
                                </td>
                                <td class="w-1/12 py-3 px-4">
                                    <?php echo htmlspecialchars($reservasi->uang_bayar); ?>
                                </td>
                                <td class="w-1/12 py-3 px-4">
                                    <?php echo htmlspecialchars($reservasi->uang_kembali); ?>
                                </td>
                                <td class="w-1/6 py-3 px-4">
                                    <div class="flex layanans-center space-x-4">
                                        <button
                                            class="border-2 border-gray-700 bg-white hover:bg-gray-800 hover:text-white text-gray-800 font-bold py-1 px-2 rounded"
                                            onclick="openModal('modal-details-<?php echo $reservasi->id; ?>')">
                                            Details
                                        </button>
                                        <button
                                            class="border-2 border-gray-700 bg-yellow-500 text-white hover:bg-yellow-700 font-bold py-1 px-2 rounded flex layanans-center space-x-2"
                                            onclick="printReservasi(<?= htmlspecialchars(json_encode($reservasiPrint), ENT_QUOTES, 'UTF-8') ?>)">
                                            <i class="fa-solid fa-file-pdf"></i>
                                            <span>PDF</span>
                                        </button>
                                        <!-- <button
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2"
                                            onclick="return confirmDelete(<?= $reservasi->id ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button> -->
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Update Status -->
                            <div id="modal-update-<?= $reservasi->id ?>"
                                class="modal hidden fixed inset-0 flex layanans-center justify-center">
                                <div class="modal-content bg-white rounded-lg shadow-lg p-6 w-1/3">
                                    <h2 class="text-lg font-bold mb-4">Update Status Reservasi</h2>
                                    <form action="../../response_input.php?modul=reservasi&fitur=updateStatus"
                                        method="POST">
                                        <input type="hidden" name="reservasi_id" value="<?= $reservasi->id ?>">
                                        <div class="mb-4">
                                            <label for="status_id" class="block text-gray-700 font-medium">Pilih Status
                                                Baru:</label>
                                            <select name="status_id" id="status_id"
                                                class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                                <?php foreach ($modelStatus->getAllStatusFromDb() as $statusOption) { ?>
                                                <option value="<?= $statusOption->status_id ?>"
                                                    <?= $statusOption->status_id == $reservasi->status_id ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($statusOption->status_nama) ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button"
                                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded mr-2"
                                                onclick="closeModal('modal-update-<?= $reservasi->id ?>')">Batal</button>
                                            <button type="submit"
                                                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
    <div id="modal-details-<?= $reservasi->id ?>"
        class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div
            class="relative top-20 mx-auto p-8 border w-11/12 md:w-3/4 lg:w-1/2 xl:w-1/3 shadow-xl rounded-lg bg-white transition-all duration-300 ease-in-out transform">
            <div class="flex justify-between layanans-center mb-5">
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
                    <h4 class="text-lg font-semibold text-gray-800">Detail Barang</h4>
                    <table class="min-w-full bg-white table-auto mt-4 rounded-lg overflow-hidden shadow-md">
                        <thead class="bg-yellow-500 text-white">
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
                    onclick="closeModal('modal-details-<?= $reservasi->id ?>')">Close</button>

                </button>
            </div>
        </div>
    </div>
    <?php } } ?>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode/build/qrcode.min.js"></script>
    <script>
    function printReservasi(reservasi) {
        const printWindow = window.open('', '_blank');
        printWindow.document.open();

        let htmlContent = `
    <html>
    <head>
        <title>Cetak Reservasi</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                color: #333;
            }
            h1, h2 {
                text-align: center;
                color:#F7B500;
            }
            .info-section {
                margin: 10px 0;
                line-height: 1.6;
                font-size: 14px;
            }
            .info-section .label {
                font-weight: bold;
                display: inline-block;
                width: 120px;
            }
            .reservasi-summary {
                background-color: #f7f7f7;
                padding: 15px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
                font-size: 14px;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }
            th {
                background-color: #F7B500;
                color: white;
            }
            tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            .footer {
                text-align: center;
                margin-top: 20px;
                font-size: 12px;
                color: #666;
            }
        </style>
    </head>
    <body>
        <h1>Reservasi Sepatu</h1>
        <h2>#${reservasi.reservasi_id}</h2>
        <div class="reservasi-summary">
            <div class="info-section">
                <span class="label">ID Reservasi:</span> ${reservasi.reservasi_id}
            </div>
            <div class="info-section">
                <span class="label">Tanggal:</span> ${reservasi.reservasi_date}
            </div>
            <div class="info-section">
                <span class="label">Status:</span> ${reservasi.reservasi_status}
            </div>
            <div class="info-section">
                <span class="label">Pelanggan:</span> ${reservasi.user_username} (${reservasi.role_name})
            </div>
            <div class="info-section">
                <span class="label">Total Harga:</span> Rp ${reservasi.reservasi_totalPrice.toLocaleString()}
            </div>
            <div class="info-section">
                <span class="label">Dibayar:</span> Rp ${reservasi.reservasi_pay.toLocaleString()}
            </div>
            <div class="info-section">
                <span class="label">Kembalian:</span> Rp ${reservasi.reservasi_change.toLocaleString()}
            </div>
        </div>
        
        <h2>Detail Reservasi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Layanan</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </tr>
            </thead>
            <tbody>
    `;

        reservasi.detailReservasi.forEach(detail => {
            htmlContent += `
        <tr>
            <td>${detail.layanan_id}</td>
            <td>${detail.layanan_name}</td>
            <td>Rp ${detail.layanan_price.toLocaleString()}</td>
            <td>${detail.layanan_qty}</td>
            <td>Rp ${detail.sub_total.toLocaleString()}</td>
        </tr>
        `;
        });

        htmlContent += `
            </tbody>
        </table>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami!</p>
        </div>
    </body>
    </html>
    `;

        printWindow.document.write(htmlContent);
        printWindow.document.close();

        printWindow.onload = function() {
            printWindow.print();
        };
    }
    </script>
</body>

</html>