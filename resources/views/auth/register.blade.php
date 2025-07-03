<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Pasien</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Registrasi Pasien</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full mt-1 p-2 border rounded-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full mt-1 p-2 border rounded-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full mt-1 p-2 border rounded-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="no_hp" class="w-full mt-1 p-2 border rounded-md" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" class="w-full mt-1 p-2 border rounded-md" rows="3" required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nomor KTP</label>
                <input type="text" name="no_ktp" class="w-full mt-1 p-2 border rounded-md" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Daftar
            </button>
        </form>
    </div>

</body>
</html>
