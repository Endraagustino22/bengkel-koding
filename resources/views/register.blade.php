<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Aplikasi</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-200 to-pink-300 min-h-screen flex items-center justify-center">
  <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-lg">
    <h2 class="text-2xl font-bold text-center text-purple-700 mb-6">Registrasi Akun</h2>

    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
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
        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
        <input type="text" id="nama" name="nama" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500" value="{{ old('nama') }}" required>
      </div>

      <div>
        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
        <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500" value="{{ old('alamat') }}" required>
      </div>

      <div>
        <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
        <input type="text" id="no_hp" name="no_hp" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500" value="{{ old('no_hp') }}" required>
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500" value="{{ old('email') }}" required>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-purple-500" required>
      </div>

      <div class="pt-2">
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-md transition duration-200">
          Register
        </button>
      </div>
    </form>
  </div>
</body>
</html>
