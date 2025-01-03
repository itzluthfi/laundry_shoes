<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laundry Web</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans text-gray-800">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-400 text-white fixed w-full z-20 shadow-lg">
        <div class="container mx-auto flex justify-between items-center px-6 py-4">
            <!-- Brand Name -->
            <div class="text-2xl font-extrabold tracking-wide">
                Laundry<span class="text-yellow-300">App</span>
            </div>

            <!-- Navigation Links -->
            <ul class="hidden md:flex space-x-8 text-lg font-medium">
                <li>
                    <a href="#hero" class="hover:text-yellow-300 transition duration-300 ease-in-out">Beranda</a>
                </li>
                <li>
                    <a href="#tentang_kami" class="hover:text-yellow-300 transition duration-300 ease-in-out">Tentang
                        Kami</a>
                </li>
                <li>
                    <a href="#img" class="hover:text-yellow-300 transition duration-300 ease-in-out">Layanan</a>
                </li>
                <li>
                    <a href="#contact" class="hover:text-yellow-300 transition duration-300 ease-in-out">Kontak</a>
                </li>
                <li>
                    <a href="../reservasi.php"
                        class="bg-yellow-300 text-blue-600 px-5 py-2 rounded-full font-medium hover:bg-white hover:text-blue-900 transition duration-300 ease-in-out shadow-md">
                        Cek Reservasimu
                    </a>
                </li>
            </ul>

            <!-- Auth Buttons -->
            <div class="flex space-x-4">
                <a id="authButton" href="../loginPage.php"
                    class="bg-white text-blue-600 px-5 py-2 rounded-full font-medium hover:bg-yellow-300 hover:text-blue-900 transition duration-300 ease-in-out shadow-md">
                    Login
                </a>
                <a id="registerButton" href="../registerPage.php"
                    class="bg-yellow-300 text-blue-600 px-5 py-2 rounded-full font-medium hover:bg-white hover:text-blue-900 transition duration-300 ease-in-out shadow-md">
                    Registrasi
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="block md:hidden text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <!-- <div
        id="mobileMenu"
        class="hidden md:hidden bg-blue-500 text-white absolute w-full left-0 top-full py-4 px-6 shadow-lg"
      >
        <ul class="space-y-4 text-lg font-medium">
          <li>
            <a href="#hero" class="hover:text-yellow-300 hover:underline"
              >Beranda</a
            >
          </li>
          <li>
            <a href="#about" class="hover:text-yellow-300">Tentang Kami</a>
          </li>
          <li><a href="#img" class="hover:text-yellow-300">Layanan</a></li>
          <li><a href="#contact" class="hover:text-yellow-300">Kontak</a></li>
        </ul>
      </div> -->
    </nav>
    <!-- Navbar End -->

    <!-- hero section start -->
    <section id="hero" class="bg-blue-50 py-16 px-4 h-screen relative overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('img/decor3.jpg')">
        </div>

        <!-- Content -->
        <div
            class="container mx-auto flex flex-col-reverse md:flex-row items-center gap-12 h-full top-[10%] relative z-9">
            <!-- Left Content -->
            <div class="text-center md:text-left flex-grow bg-white/80 p-8 rounded-lg shadow-lg">
                <h1 class="text-5xl md:text-6xl font-bold text-blue-600 leading-tight">
                    Bersihkan Sepatumu, Maksimalkan Gaya!
                </h1>
                <ul class="mt-8 space-y-6">
                    <li class="flex items-center gap-4">
                        <div class="bg-white shadow-lg rounded-full p-6">
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9 21h6v-2H9v2zm8.707-9.707L16 8.586V3h-2v6.414L7.293 4.707 6 6l8 8 8-8-1.293-1.293z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-medium text-gray-700">Pickup dalam 30 menit</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="bg-white shadow-lg rounded-full p-6">
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path d="M20 6h-4V4H8v2H4v15h16V6zM8 9h8v2H8V9zm0 4h8v2H8v-2zm0 4h8v2H8v-2z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-medium text-gray-700">Harga Mulai Dari IDR 8.000</span>
                    </li>
                    <li class="flex items-center gap-4">
                        <div class="bg-white shadow-lg rounded-full p-6">
                            <svg class="w-8 h-8 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path d="M20 4H4v2H16V4zm0 6H4v2H16v-2zm0 6H4v2H16v-2z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-medium text-gray-700">Express 3 Jam Selesai</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Decorative Images -->
        <img src="img/decor1.jpg" alt="Decorative Image 1"
            class="absolute top-10 z-10 left-10 w-40 h-40 object-cover rounded-full shadow-lg transform rotate-6 opacity-80" />
        <img src="img/decor2.jpg" alt="Decorative Image 2"
            class="absolute top-32 z-10 right-10 w-48 h-48 object-cover rounded-lg shadow-lg transform -rotate-12 opacity-90" />
        <img src="img/decor4.jpg" alt="Decorative Image 3"
            class="absolute bottom-10 z-10 left-1/3 w-56 h-56 object-cover rounded-full shadow-md transform rotate-3 opacity-75" />
    </section>
    <!-- hero section end -->

    <!-- Tentang Kami -->
    <section id="tentang_kami" class="">
        <div class="py-12 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:text-center">
                    <h2
                        class="font-heading mb-4 bg-blue-100 text-blue-800 px-4 py-2 rounded-lg md:w-64 md:mx-auto text-xs font-semibold tracking-widest text-black uppercase title-font">
                        Mengapa memilih layanan cuci sepatu kami?
                    </h2>
                    <p
                        class="font-heading mt-2 text-3xl leading-8 font-semibold tracking-tight text-gray-900 sm:text-4xl">
                        Kami memberikan layanan cuci sepatu terbaik dan perawatan sepatu
                        profesional.
                    </p>
                    <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto">
                        Kami tahu cara merawat semua jenis sepatu dan memastikan sepatu
                        Anda terlihat bersih, segar, dan baru. Kami memberikan perawatan
                        sepatu terbaik agar selalu tampak prima.
                    </p>
                </div>

                <div class="mt-10">
                    <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                        <!-- Peralatan Cuci Canggih -->
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                    <img src="https://www.svgrepo.com/show/366244/cleaning.svg"
                                        alt="Peralatan Cuci Sepatu" />
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">
                                    Peralatan Cuci Canggih
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Kami menggunakan teknologi dan peralatan cuci terbaru untuk
                                memastikan sepatu Anda bersih secara menyeluruh.
                            </dd>
                        </div>

                        <!-- Produk Ramah Lingkungan -->
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                    <img src="https://www.svgrepo.com/show/499135/eco-friendly.svg"
                                        alt="Produk Ramah Lingkungan" />
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">
                                    Produk Ramah Lingkungan
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Kami peduli dengan sepatu Anda dan juga lingkungan. Solusi
                                pembersih kami ramah lingkungan dan aman.
                            </dd>
                        </div>

                        <!-- Layanan Pengeringan Cepat -->
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                    <img src="https://www.svgrepo.com/show/416101/fast-drying.svg"
                                        alt="Pengeringan Cepat" />
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">
                                    Pengeringan Cepat
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Layanan pengeringan cepat kami memastikan sepatu Anda siap
                                digunakan kembali dalam waktu singkat.
                            </dd>
                        </div>

                        <!-- Perawatan Sepatu Profesional -->
                        <div class="relative">
                            <dt>
                                <div
                                    class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-blue-500 text-white">
                                    <img src="https://www.svgrepo.com/show/74289/shoe-care.svg"
                                        alt="Perawatan Sepatu" />
                                </div>
                                <p class="font-heading ml-16 text-lg leading-6 font-bold text-gray-700">
                                    Perawatan Sepatu Profesional
                                </p>
                            </dt>
                            <dd class="mt-2 ml-16 text-base text-gray-500">
                                Kami memberikan layanan perawatan sepatu profesional yang
                                menjaga kualitas dan penampilan sepatu Anda.
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Kami -->
    <!-- Layanan Kami -->
    <section id="img" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-blue-500">Layanan Kami</h2>
            <p class="text-gray-600 mt-4">
                Kami telah mencuci lebih dari
                <span class="font-bold">264,645</span> pasang sepatu, dan akan terus
                bertambah...
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <!-- Layanan 1 -->
                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('easy')">
                    <img src="img/easyWash.jpg" alt="Easy Wash"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Easy Wash</h3>
                            <p class="text-sm mt-2">
                                Cuci bagian midsole dan outsole saja.
                            </p>
                            <div class="flex justify-center space-x-4 mt-4">
                                <button onclick="openModal('unyellowing')"
                                    class="flex items-center bg-gray-700 hover:bg-gray-800 text-white px-3 py-2 rounded-md">
                                    <i class="fas fa-eye mr-2"></i> Detail
                                </button>
                                <a href="./regReservasi.php"
                                    class="flex items-center bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md">
                                    <i class="fas fa-shopping-cart mr-2"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Layanan tambahan -->
                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('repair')">
                    <img src="img/repair.jpg" alt="Repair"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Repair</h3>
                            <p class="text-sm mt-2">
                                Perbaikan untuk sepatu Anda agar terlihat seperti baru lagi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('unyellowing')">
                    <img src="img/unyellowing.jpg" alt="Unyellowing"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Unyellowing</h3>
                            <p class="text-sm mt-2">
                                Mengembalikan warna midsole yang menguning menjadi putih lagi.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('repaint')">
                    <img src="img/repaint.jpg" alt="Repaint"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Repaint</h3>
                            <p class="text-sm mt-2">
                                Pengecatan ulang sepatu Anda agar tampil segar dan baru.
                            </p>
                        </div>
                    </div>
                </div>



                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('premiumSuede')">
                    <img src="img/premium-suede.jpg" alt="Premium Suede"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Premium Suede</h3>
                            <p class="text-sm mt-2">
                                Perawatan khusus untuk sepatu berbahan suede.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative bg-gray-900 text-white rounded-lg shadow-lg overflow-hidden group cursor-pointer"
                    onclick="openModal('leatherShining')">
                    <img src="img/leather-shining.jpg" alt="Leather Shining"
                        class="w-full h-60 object-cover opacity-75 group-hover:opacity-100 transition duration-300" />
                    <div
                        class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-semibold">Leather Shining</h3>
                            <p class="text-sm mt-2">
                                Poles sepatu kulit agar tampak bersinar dan elegan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg w-96 p-6 shadow-lg">
            <h3 id="modalTitle" class="text-2xl font-bold text-blue-500"></h3>
            <p id="modalContent" class="text-gray-600 mt-4"></p>
            <button onclick="closeModal()" class="mt-6 bg-blue-500 text-white px-4 py-2 rounded-md">
                Tutup
            </button>
        </div>
    </div>

    <!-- Kontak -->
    <section class="bg-blue-50 dark:bg-slate-800" id="contact">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="mb-4">
                <div class="mb-6 max-w-3xl text-center sm:text-center md:mx-auto md:mb-12">
                    <p class="text-base font-semibold uppercase tracking-wide text-blue-600 dark:text-blue-200">
                        Hubungi Kami
                    </p>
                    <h2
                        class="font-heading mb-4 font-bold tracking-tight text-gray-900 dark:text-white text-3xl sm:text-5xl">
                        Buat Sepatu Anda Kembali Baru Sekarang!
                    </h2>
                    <p class="mx-auto mt-4 max-w-3xl text-xl text-gray-600 dark:text-slate-400">
                        Layanan cuci sepatu kami akan membuat sepatu Anda kembali seperti
                        baru.
                    </p>
                </div>
            </div>

            <div class="flex items-stretch justify-center">
                <div class="grid md:grid-cols-2 gap-8 w-full">
                    <!-- Kiri: Informasi Kontak -->
                    <div class="h-full pr-6">
                        <p class="mt-3 mb-12 text-lg text-gray-600 dark:text-slate-400">
                            Ingin sepatu Anda terlihat baru? Layanan cuci sepatu profesional
                            kami akan memastikan sepatu Anda bersih dan terawat dengan baik.
                            Jangan ragu untuk menghubungi kami jika ada pertanyaan.
                        </p>
                        <ul class="mb-6 md:mb-0">
                            <li class="flex mb-6">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-blue-900 text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-6 w-6">
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path
                                            d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                        Alamat Kami
                                    </h3>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Jl. Cuci Sepatu No.123, Jakarta
                                    </p>
                                    <p class="text-gray-600 dark:text-slate-400">Indonesia</p>
                                </div>
                            </li>
                            <li class="flex mb-6">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-blue-900 text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-6 w-6">
                                        <path
                                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2">
                                        </path>
                                        <path d="M15 7a2 2 0 0 1 2 2"></path>
                                        <path d="M15 3a6 6 0 0 1 6 6"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                        Kontak Kami
                                    </h3>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Telepon: +62 (123) 456-7890
                                    </p>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Email: cuci.sepatumurah@gmail.com
                                    </p>
                                </div>
                            </li>
                            <li class="flex mb-6">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded bg-blue-900 text-gray-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="h-6 w-6">
                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                                        <path d="M12 7v5l3 3"></path>
                                    </svg>
                                </div>
                                <div class="ml-4 mb-4">
                                    <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                        Jam Kerja
                                    </h3>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Senin - Jumat: 08:00 - 18:00
                                    </p>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Sabtu: 08:00 - 14:00
                                    </p>
                                    <p class="text-gray-600 dark:text-slate-400">
                                        Minggu: Tutup
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Kanan: Formulir Kontak -->
                    <div class="card h-fit max-w-6xl p-5 md:p-12" id="form">
                        <h2 class="mb-4 text-2xl font-bold dark:text-white">
                            Siap Mencuci Sepatu Anda?
                        </h2>
                        <form id="contactForm">
                            <div class="mb-6">
                                <div class="mx-0 mb-1 sm:mb-4">
                                    <label for="name" class="pb-1 text-xs uppercase tracking-wider">Nama Anda</label>
                                    <input type="text" id="name" autocomplete="given-name"
                                        placeholder="Masukkan nama Anda"
                                        class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                                        name="name" />
                                </div>
                                <div class="mx-0 mb-1 sm:mb-4">
                                    <label for="email" class="pb-1 text-xs uppercase tracking-wider">Email Anda</label>
                                    <input type="email" id="email" autocomplete="email"
                                        placeholder="Masukkan alamat email Anda"
                                        class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                                        name="email" />
                                </div>
                            </div>
                            <div class="mx-0 mb-1 sm:mb-4">
                                <label for="textarea" class="pb-1 text-xs uppercase tracking-wider">Pesan Anda</label>
                                <textarea id="textarea" name="textarea" cols="30" rows="5"
                                    placeholder="Tulis pesan Anda..."
                                    class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit"
                                    class="w-full bg-blue-800 text-white px-6 py-3 font-xl rounded-md sm:mb-0">
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <div class="text-center py-6">
        <a href="#" class="flex items-center justify-center mb-5 text-2xl font-semibold text-gray-900">
            <img src="https://www.svgrepo.com/show/499962/shoe.svg" class="h-12 mr-3 sm:h-9" alt="Sepatu Logo" />
            SepatuLand
        </a>

        <span class="block text-sm text-center text-gray-500">© 2021-2022 SepatuLand™. All Rights Reserved. Built with
            <a href="https://flowbite.com" class="text-purple-600 hover:underline">Flowbite</a>
            and
            <a href="https://tailwindcss.com" class="text-purple-600 hover:underline">Tailwind CSS </a>.
        </span>

        <ul class="flex justify-center mt-5 space-x-5">
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path
                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                        </path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#" class="text-gray-500 hover:text-gray-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li>
        </ul>
    </div>

    <!-- Script -->
    <script>
    //scrolling
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
            });
        });
    });
    </script>
</body>

</html>