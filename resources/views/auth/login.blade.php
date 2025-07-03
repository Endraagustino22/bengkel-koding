<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | Aplikasi</title>
  @vite('resources/css/app.css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-to-br from-blue-200 via-blue-300 to-blue-400 min-h-screen flex items-center justify-center font-sans">

  <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 relative overflow-hidden">
    <!-- Header -->
    <div class="flex flex-col items-center mb-6">
      <div class="bg-blue-100 p-4 rounded-full shadow-lg mb-3">
        <i class="fas fa-user-md text-blue-600 text-3xl"></i>
      </div>
      <h1 class="text-3xl font-bold text-gray-800">Selamat Datang</h1>
      <p class="text-gray-500 text-sm mt-1">Login ke Rumah Sakit Online</p>
    </div>

    <!-- Error Message -->
    @if ($errors->any())
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Form -->
    <form action="{{ route('login') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
        <div class="relative">
          <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
            class="w-full px-4 py-2 border rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="masukkan email" />
          <i class="fas fa-envelope absolute top-2.5 left-3 text-gray-400"></i>
        </div>
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
        <div class="relative">
          <input type="password" name="password" id="password" required
            class="w-full px-4 py-2 border rounded-md pl-10 focus:outline-none focus:ring-2 focus:ring-blue-400"
            placeholder="********" />
          <i class="fas fa-lock absolute top-2.5 left-3 text-gray-400"></i>
        </div>
      </div>

      <button type="submit"
        class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-700 transition duration-200 shadow-md">
        <i class="fas fa-sign-in-alt mr-2"></i> Masuk
      </button>
    </form>

    <!-- Footer -->
    <div class="mt-6 text-center text-sm text-gray-600">
      Belum punya akun? Daftar sebagai  pasien
      <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar sekarang</a>
    </div>
  </div>

</body>
</html>
