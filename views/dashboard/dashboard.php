<?php 

require_once __DIR__ . '../../../init.php';   
require_once __DIR__ . '../../../auth_check.php';   
$obj_role = $modelRole->getAllRoleFromDB(); 
$obj_user = $modelUser->getAllUser(); 
$obj_layanan = $modelLayanan->getAllLayananFromDB(); 
$obj_reservasi = $modelReservasi->getAllReservasi(); 

$total_reservasis = 0;
foreach ($obj_reservasi as $reservasi) {
    $total_reservasis += $reservasi->uang_bayar + $reservasi->uang_kembali;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
.w-Search-Input {
    width: 400px;
}

.card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}
</style>

<body class="bg-gray-50 font-sans leading-normal tracking-normal overflow-hidden">

    <!-- Navbar -->
    <?php include_once '../includes/navbar.php'; ?>

    <!-- Main container -->
    <div class="flex h-screen">
        <!-- Sidebar -->

        <?php include_once '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-8 overflow-y-auto h-[calc(100vh-4rem)] bg-white rounded-lg shadow-xl">
            <div class="container mx-auto">
                <h1 class="text-4xl font-bold text-gray-800 mb-6 pb-2 text-center italic">Dashboard Cuci Sepatu</h1>
                <!-- Cards Section -->
                <div class="mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-4">
                    <!-- obj_layanan Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg border-t-4 border-blue-400">
                        <div class="card-body">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-2xl font-semibold text-gray-700">Layanan</h4>
                                <div
                                    class="bg-yellow-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-yellow-600">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col gap-0">
                                <h2 class="text-3xl font-bold text-gray-800"><?= count($obj_layanan) ?></h2>
                                <p class="text-gray-600"><?= count($obj_layanan) ?> <span class="text-yellow-500">Jumlah
                                        Layanan</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Reservasi Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg border-t-4 border-purple-400">
                        <div class="card-body">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-2xl font-semibold text-gray-700">Reservasi</h4>
                                <div
                                    class="bg-yellow-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-yellow-600">
                                    <i class="fa-solid fa-calendar-check"></i>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col gap-0">
                                <h2 class="text-3xl font-bold text-gray-800"><?= count($obj_reservasi) ?></h2>
                                <p class="text-gray-600"><?= count($obj_reservasi) ?> <span
                                        class="text-yellow-500">Total Reservasi</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Role Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg border-t-4 border-teal-400">
                        <div class="card-body">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-2xl font-semibold text-gray-700">Role</h4>
                                <div
                                    class="bg-yellow-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-yellow-600">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col gap-0">
                                <h2 class="text-3xl font-bold text-gray-800"><?= count($obj_role) ?></h2>
                                <p class="text-gray-600"><?= count($obj_role) ?> <span class="text-red-500">Non
                                        Active</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Total Reservasi Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg border-t-4 border-pink-400">
                        <div class="card-body">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-2xl font-semibold text-gray-700">Total Reservasi</h4>
                                <div
                                    class="bg-yellow-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-yellow-600">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </div>
                            </div>
                            <div class="mt-6 flex flex-col gap-0">
                                <h2 class="text-3xl font-bold text-yellow-500">
                                    Rp. <?= number_format($total_reservasis, 2) ?>
                                </h2>
                                <p class="text-gray-600"><?= count($obj_reservasi) ?> <span
                                        class="text-green-500">Completed</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Content Section -->
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- New Stats Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg">
                        <h4 class="text-2xl font-semibold text-gray-700 mb-4">Users Registered</h4>
                        <p class="text-3xl font-bold text-gray-800"><?= count($obj_user) ?> Users</p>
                        <p class="text-gray-600">Total users who have registered for laundry services</p>
                    </div>

                    <!-- New Stats Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg">
                        <h4 class="text-2xl font-semibold text-gray-700 mb-4">Pending Tasks</h4>
                        <p class="text-3xl font-bold text-gray-800">5 Tasks</p>
                        <p class="text-gray-600">Tasks yet to be completed</p>
                    </div>

                    <!-- Chart Card -->
                    <div class="card bg-white p-8 rounded-lg shadow-lg col-span-2 xl:col-span-1">
                        <h4 class="text-2xl font-semibold text-gray-700 mb-4">Revenue Overview</h4>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

            </div>

            <script>
            // Revenue Chart
            var ctx = document.getElementById('revenueChart').getContext('2d');
            var revenueChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                    datasets: [{
                        label: 'Revenue',
                        data: [1200, 1500, 1100, 1700, 2000, 2100],
                        borderColor: '#4C51BF',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Revenue (Rp)'
                            }
                        }
                    }
                }
            });
            </script>

</body>

</html>