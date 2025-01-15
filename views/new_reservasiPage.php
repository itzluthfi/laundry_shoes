<?php
require_once __DIR__ . '../../init.php';
$layanans = $modelLayanan->getAllLayananFromDB();

$user_id = unserialize($_SESSION['customer_login'])->user_id;
// var_dump($user_id);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@latest/dist/full.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: "#3b82f6",
                    secondary: "#1d4ed8",
                }
            }
        }
    }
    </script>
</head>

<body class="bg-blue-50">
    <div class="min-h-screen py-8">
        <div class="container mx-auto px-4">
            <button onclick="window.history.back()"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-300 mb-4 right-20 absolute">
                Kembali
            </button>
            <h1 class="text-4xl font-bold mb-8 text-blue-800">Reservasi Baru</h1>

            <form action="../response_input.php?modul=reservasi&fitur=add" method="POST" id="reservasiForm">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Left Section -->
                    <div class="lg:w-3/4">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-semibold mb-6 text-blue-700">Place Order Layanan</h2>
                            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="form-control">
                                    <label for="layananselect" class="label">
                                        <span class="label-text">Reservasi</span>
                                    </label>
                                    <select id="layananselect" class="select select-bordered w-full">
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
                                <div class="form-control">
                                    <label for="jumlahInput" class="label">
                                        <span class="label-text">Jumlah</span>
                                    </label>
                                    <input type="number" id="jumlahInput" class="input input-bordered w-full" min="1">
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Aksi</span>
                                    </label>
                                    <button type="button" id="addReservasiBtn"
                                        class="btn btn-primary bg-blue-600">Tambah
                                        Reservasi</button>
                                </div>
                            </div>
                            <div class="overflow-x-auto">
                                <table id="layananTable" class="table w-full">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama layanan</th>
                                            <th>Quantity</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Right Section -->
                    <div class="lg:w-1/4">
                        <div class="bg-white rounded-lg shadow-lg p-6">
                            <h2 class="text-2xl font-semibold mb-6 text-blue-700">Payment</h2>
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Total Harga</span>
                                </label>
                                <input type="text" id="reservasi_harga" class="input input-bordered" readonly
                                    value="Rp 0">
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Pembayaran</span>
                                </label>
                                <input type="number" name="uang_bayar" id="uang_bayar" class="input input-bordered"
                                    value="Rp 0">
                            </div>
                            <div class="form-control mt-4">
                                <label class="label">
                                    <span class="label-text">Kembalian</span>
                                </label>
                                <input type="text" id="uang_kembali" class="input input-bordered" readonly value="Rp 0">
                            </div>
                            <button type="submit" class="btn btn-primary mt-6 w-full bg-blue-600">Bayar</button>
                            <button type="button" id="cancelButton" class="btn bg-red-600 mt-2 w-full">Batal</button>
                        </div>
                    </div>
                </div>
                <!-- Hidden Inputs -->
                <input type="hidden" name="reservasi_harga" id="reservasi_hargaHidden" value="0">
                <input type="hidden" name="uang_kembali" id="uang_kembaliHidden" value="0">
                <input type="hidden" name="layanans" id="layanans">
                <input type="hidden" name="status_id" id="status_id" value="1">
                <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
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

    // document.getElementById('reservasiForm').addEventListener('submit', function(event) {
    //     event.preventDefault(); // Mencegah form dikirim langsung agar bisa diproses dulu
    //     const formData = new FormData(event.target); // Mengambil semua data form
    //     const formObject = {}; // Objek untuk menyimpan data form

    //     // Iterasi melalui FormData untuk membuat objek
    //     formData.forEach((value, key) => {
    //         formObject[key] = value;
    //     });

    //     // Tampilkan data di console.log
    //     console.log('Data yang akan dikirim:', formObject);

    //     // Untuk debug dalam format JSON
    //     console.log('Data JSON:', JSON.stringify(formObject));

    //     // Jika sudah benar, bisa lanjutkan dengan submit form
    //     event.target.submit();
    // });


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