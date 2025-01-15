<?php
require_once __DIR__ . '../../../init.php';

$layanans = $modelLayanan->getAllLayananFromDB();

$user_id = unserialize($_SESSION['user_login'])->user_id;
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: "#3b82f6",
                    secondary: "#1d4ed8",
                    accent: "#fbbf24",
                }
            }
        }
    }
    </script>
</head>

<body class="bg-blue-50 font-sans leading-normal tracking-normal overflow-hidden">
    <!-- Navbar placeholder -->
    <!-- Navbar content -->
    <?php include '../includes/navbar.php'; ?>

    <div class="flex">
        <!-- Sidebar placeholder -->
        <!-- Sidebar content -->
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="flex-1 p-10 overflow-y-auto h-[calc(100vh-5rem)] bg-white">
            <h1 class="text-4xl font-bold mb-5 pb-2 text-primary italic">Manage Reservasi</h1>

            <form action="../../response_input.php?modul=reservasi&fitur=add" method="POST" id="reservasiForm"
                class="bg-blue-50 p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-semibold mb-4 text-secondary">Detail Reservasi</h3>

                <!-- Select and Input for new layanan -->
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div>
                        <label for="layananselect" class="block text-sm font-medium text-gray-700">Reservasi</label>
                        <select id="layananselect"
                            class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-blue-50 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Pilih Layanan</option>
                            <?php
                    foreach ($layanans as $layanan) {
                        echo "<option value='{$layanan->layanan_id}' data-name='{$layanan->layanan_nama}' data-price='{$layanan->layanan_harga}'>
                        {$layanan->layanan_id} - {$layanan->layanan_nama} - Rp{$layanan->layanan_harga}
                        </option>";
                    }
                    ?>
                        </select>
                    </div>
                    <div>
                        <label for="jumlahInput" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" id="jumlahInput"
                            class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-white focus:ring focus:ring-blue-200"
                            min="1">
                    </div>
                    <div class="flex items-end">
                        <button type="button" id="addReservasiBtn"
                            class="px-6 py-3 text-base font-semibold tracking-tight text-white bg-secondary rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-200">
                            Tambah Reservasi
                        </button>
                    </div>
                </div>

                <!-- Table selected layanans -->
                <table id="layananTable" class="w-full bg-white shadow-md rounded-lg overflow-hidden mt-6">
                    <thead class="bg-accent">
                        <tr>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">ID</th>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Nama layanan</th>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Quantity</th>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Harga</th>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Subtotal</th>
                            <th class="py-2 px-4 border-b border-blue-200 text-left text-blue-900">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>

                <!-- Display total harga -->
                <div class="mb-6 mt-4 flex items-center gap-6">
                    <div>
                        <label for="reservasi_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                        <a id="reservasi_harga"
                            class="block mt-2 p-3 w-80 rounded-lg bg-blue-100 border border-blue-300 text-blue-800">Rp
                            <span>0</span></a>
                    </div>
                    <div>
                        <label for="uang_kembali" class="block text-sm font-medium text-gray-700">Kembalian</label>
                        <a id="uang_kembali"
                            class="block mt-2 p-3 w-80 rounded-lg bg-blue-100 border border-blue-300 text-blue-800"><span>0</span></a>
                    </div>
                </div>

                <!-- Input untuk jumlah pembayaran -->
                <div class="mb-6">
                    <label for="uang_bayar" class="block text-sm font-medium text-gray-700">Pembayaran</label>
                    <input type="number" name="uang_bayar" id="uang_bayar"
                        class="mt-2 p-3 border border-blue-300 rounded-lg w-full bg-white focus:ring focus:ring-blue-200"
                        required>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-6 py-3 text-lg font-semibold text-white bg-primary rounded-lg hover:bg-blue-700 focus:ring focus:ring-blue-200">
                        Simpan Reservasi
                    </button>
                    <button type="button" id="cancelButton"
                        class="px-6 py-3 text-lg font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring focus:ring-red-200">
                        Batal
                    </button>
                </div>

                <!-- Hidden inputs -->
                <input type="hidden" name="reservasi_harga" id="reservasi_hargaHidden" value="0">
                <input type="hidden" name="uang_kembali" id="uang_kembaliHidden" value="0">
                <input type="hidden" name="layanans" id="layanans">
                <input type="hidden" name="status_id" id="status_id" value="1">
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?>">
            </form>
        </div>
    </div>

    <script>
    const totalPriceDisplay = document.getElementById('reservasi_harga');
    const salePayInput = document.getElementById('uang_bayar');
    const saleChangeDisplay = document.getElementById('uang_kembali');

    // Form submission event to check payment amount
    document.getElementById('reservasiForm').addEventListener('submit', function(event) {
        const totalPrice = parseInt(document.getElementById('reservasi_harga').value);
        const payment = parseInt(salePayInput.value);

        console.log("Form akan dikirim dengan:");
        console.log("Total Price (hidden input):", document.getElementById('reservasi_harga').value);
        console.log("Change (hidden input):", document.getElementById('uang_kembali').value);
        if (payment < totalPrice) {
            event.preventDefault();
            alert('Uang yang dibayarkan kurang!');
            return;
        }

    });

    document.getElementById('reservasiForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form dikirim langsung agar bisa diproses dulu
        const formData = new FormData(event.target); // Mengambil semua data form
        const formObject = {}; // Objek untuk menyimpan data form

        // Iterasi melalui FormData untuk membuat objek
        formData.forEach((value, key) => {
            formObject[key] = value;
        });

        // Tampilkan data di console.log
        console.log('Data yang akan dikirim:', formObject);

        // Untuk debug dalam format JSON
        console.log('Data JSON:', JSON.stringify(formObject));

        // Jika sudah benar, bisa lanjutkan dengan submit form
        event.target.submit();
    });


    // Add layanan event
    document.getElementById('addReservasiBtn').addEventListener('click', function() {
        const layananselect = document.getElementById('layananselect');
        const memberSelect = document.getElementById('memberSelect');
        const jumlahInput = document.getElementById('jumlahInput');
        const layananTable = document.getElementById('layananTable').querySelector('tbody');
        const layanansInput = document.getElementById('layanans');

        const selectedOption = layananselect.options[layananselect.selectedIndex];
        const layananId = selectedOption.value;
        const layananName = selectedOption.getAttribute('data-name');
        const layananPrice = parseFloat(selectedOption.getAttribute('data-price'));
        const quantity = parseInt(jumlahInput.value);

        if (layananId && quantity > 0) {
            const subtotal = layananPrice * quantity;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="py-2 px-1 border-b border-gray-300">${layananId}</td>
                <td class="py-2 px-1 border-b border-gray-300">${layananName}</td>
                <td class="py-2 px-1 border-b border-gray-300">${quantity}</td>
                <td class="py-2 px-1 border-b border-gray-300">Rp${layananPrice.toLocaleString()}</td>
                <td class="py-2 px-1 border-b border-gray-300">Rp${subtotal.toLocaleString()}</td>
                <td class="px-1 py-2 border-b border-gray-300">
                    <button type="button" class="text-red-500 remove-layanan">Hapus</button>
                </td>
            `;

            layananTable.appendChild(newRow);

            // Update hidden input for layanans
            const currentlayanans = JSON.parse(layanansInput.value || "[]");
            currentlayanans.push({
                layanan_id: layananId,
                layanan_nama: layananName,
                layanan_harga: layananPrice,
                jumlah: quantity
            });
            layanansInput.value = JSON.stringify(currentlayanans);

            updateTotalPrice();

            // Clear the selection and input
            layananselect.value = '';
            jumlahInput.value = '';
        }
    });

    // Remove layanan event
    document.getElementById('layananTable').addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-layanan')) {
            const row = event.target.closest('tr');
            row.remove();

            const layanansInput = document.getElementById('layanans');
            const currentlayanans = JSON.parse(layanansInput.value || "[]");
            const layananId = row.children[0].textContent;
            const updatedlayanans = currentlayanans.filter(layanan => layanan.layanan_id !== layananId);
            layanansInput.value = JSON.stringify(updatedlayanans);

            updateTotalPrice();
        }
    });

    salePayInput.addEventListener('keyup', updateChange);

    function updateTotalPrice() {
        const layananRows = document.querySelectorAll('#layananTable tbody tr');
        let total = 0;

        layananRows.forEach(row => {
            const subtotalText = row.children[4].textContent.replace('Rp', '').replace(/\./g, '');
            const subtotal = parseInt(subtotalText);
            total += (subtotal * 1000);
        });

        totalPriceDisplay.textContent = 'Rp' + total.toLocaleString();

        document.getElementById('reservasi_harga').value = total;
        document.getElementById('reservasi_hargaHidden').value = total;
        console.log("Total Price (hidden input):", document.getElementById('reservasi_hargaHidden').value);

        updateChange();
    }

    function updateChange() {
        const totalPrice = parseInt(document.getElementById('reservasi_harga').value) || 0;
        const payment = parseInt(salePayInput.value) || 0;
        const change = payment - totalPrice;

        saleChangeDisplay.textContent = 'Rp' + (change < 0 ? 0 : change).toLocaleString();

        document.getElementById('uang_kembali').value = change < 0 ? 0 : change;
        document.getElementById('uang_kembaliHidden').value = change < 0 ? 0 : change;
        console.log("Change (hidden input):", document.getElementById('uang_kembaliHidden').value);
    }

    document.getElementById('cancelButton').addEventListener('click', function() {
        // Reset member select
        document.getElementById('memberSelect').value = '';

        // Reset layanan select and quantity
        document.getElementById('layananselect').value = '';
        document.getElementById('jumlahInput').value = '';

        // Clear the layanan table
        const layananTableBody = document.querySelector('#layananTable tbody');
        layananTableBody.innerHTML = '';

        // Reset hidden inputs
        document.getElementById('reservasi_hargaHidden').value = '0';
        document.getElementById('uang_kembaliHidden').value = '0';
        document.getElementById('layanans').value = '[]';

        // Reset total price and change displays
        document.getElementById('reservasi_harga').textContent = 'Rp 0';
        document.getElementById('uang_kembali').textContent = 'Rp 0';

        // Reset payment input
        document.getElementById('uang_bayar').value = '';

        console.log('Semua form telah direset.');
    });
    </script>

</body>

</html>