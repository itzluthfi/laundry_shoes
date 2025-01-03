<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Reservasi Sepatu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-4xl w-full bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 text-center mb-6">Cek Reservasi Sepatu</h1>

            <!-- Form untuk cek reservasi -->
            <form action="" method="POST" class="mb-6">
                <label for="reservasi_id" class="block text-sm font-medium text-gray-700">Masukkan ID Reservasi</label>
                <div class="mt-2 flex">
                    <input type="text" id="reservasi_id" name="reservasi_id"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Contoh: RS123" required />
                    <button type="submit"
                        class="ml-4 bg-indigo-500 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition-all">
                        Cek
                    </button>
                </div>
            </form>

            <?php
            // Contoh data reservasi
            $reservasiData = [
                new reservasi("RS123", "L001", 2, "Diproses"),
                new reservasi("RS124", "L002", 1, "Selesai"),
                new reservasi("RS125", "L003", 3, "Dibatalkan"),
            ];

            // Ambil ID reservasi dari form
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $reservasi_id = $_POST['reservasi_id'];
                $found = false;

                foreach ($reservasiData as $reservasi) {
                    if ($reservasi->reservasi_id === $reservasi_id) {
                        $found = true;
                        echo "
                        <div class='bg-green-100 p-4 rounded-lg'>
                            <p class='text-sm text-gray-800'><strong>ID Reservasi:</strong> {$reservasi->reservasi_id}</p>
                            <p class='text-sm text-gray-800'><strong>ID Layanan:</strong> {$reservasi->layanan_id}</p>
                            <p class='text-sm text-gray-800'><strong>Jumlah:</strong> {$reservasi->reservasi_jumlah} Pasang</p>
                            <p class='text-sm text-gray-800'><strong>Status:</strong> {$reservasi->status_id}</p>
                        </div>";
                        break;
                    }
                }

                if (!$found) {
                    echo "
                    <div class='bg-red-100 p-4 rounded-lg'>
                        <p class='text-sm text-gray-800'>Reservasi dengan ID <strong>$reservasi_id</strong> tidak ditemukan.</p>
                    </div>";
                }
            }
            ?>

        </div>
    </div>
</body>

</html>

<?php
// Definisi class reservasi
class reservasi {
    public $reservasi_id;
    public $layanan_id;
    public $reservasi_jumlah;
    public $status_id;

    public function __construct($reservasi_id, $layanan_id, $reservasi_jumlah, $status_id) {
        $this->reservasi_id = $reservasi_id;
        $this->layanan_id = $layanan_id;
        $this->reservasi_jumlah = $reservasi_jumlah;
        $this->status_id = $status_id;
    }
}