<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Selamat Datang di Klinik Online</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-[#87CEEB] min-h-screen flex items-center justify-center">

    <div class="max-w-5xl mx-auto bg-white bg-opacity-90 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <!-- Left Side / Hero -->
        <div class="md:w-1/2 p-12 flex flex-col justify-center bg-gradient-to-br from-blue-600 to-purple-700 text-white">
            <h1 class="text-4xl font-extrabold mb-4 drop-shadow-lg">Selamat Datang di Klinik Online</h1>
            <p class="mb-8 text-lg leading-relaxed drop-shadow-md">
                Mudah dan cepat mengatur jadwal pemeriksaan kesehatan Anda.<br />
                Pilih peran Anda dan mulai akses layanan kami.
            </p>
            <i class="fas fa-hospital text-white fa-8x"></i>
        </div>

        <!-- Right Side / Login Options -->
        <div class="md:w-1/2 p-12 bg-white flex flex-col justify-center">
            <h2 class="text-3xl font-bold mb-10 text-gray-800 text-center">Login sebagai</h2>

            <div class="space-y-8">
                <!-- Login Pasien -->
                <a href="{{ route('login-pasien') }}" 
                   class="flex items-center justify-center gap-4 px-6 py-4 border-2 border-blue-600 rounded-xl text-[#4300FF] font-semibold hover:bg-blue-600 hover:text-white transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fa-solid fa-user-injured fa-lg"></i>
                    <span class="text-lg">Pasien</span>
                </a>

                <!-- Login Dokter -->
                <a href="{{ route('login-dokter') }}" 
                   class="flex items-center justify-center gap-4 px-6 py-4 border-2 border-purple-600 rounded-xl text-purple-700 font-semibold hover:bg-purple-600 hover:text-white transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fa-solid fa-user-doctor fa-lg"></i>
                    <span class="text-lg">Dokter</span>
                </a>
            </div>
        </div>
    </div>

</body>
</html>
