<ul class="nav nav-pills nav-sidebar flex-column fixed top-0 left-0 h-screen w-64 overflow-y-auto bg-gray-800 text-white">

  {{-- navbar dokter --}}
  @if (Auth::user()->role == 'dokter')
    <li class="nav-item">
      <a href="{{route('dokter.index')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dahboard
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{route('obat.index')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Obat
        </p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('dokter.periksa') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Pemeriksaan
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
    </li>
     


  {{-- Navbar Pasien --}}
  @elseif (Auth::user()->role == 'pasien')
  <li class="nav-item">
    <a href="{{ route('pasien.index') }}" style="{{ request()->routeIs('pasien.index') ? 'background-color: #3b82f6; color: white !important' : '' }}" class="nav-link bg-blue-500 {{ request()->routeIs('pasien.index') ? 'bg-blue-500 text-amber-400' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>
            Dashboard
        </p>
    </a>
</li>

  <li class="nav-item" style="{{ request()->routeIs('pasien.create') ? 'background-color: #3b82f6;' : '' }}">
    <a href="{{ route('pasien.create') }}" class="nav-link">
      <i class="nav-icon fas fa-chart-pie" style="color: white"></i>
      <p style="color: white">
        Periksa
      </p>
    </a>
  </li>
  @endif
  <form action="{{ route('logout') }}" method="POST" class="mx-auto mt-4">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
</form>

