<ul class="nav nav-pills nav-sidebar flex-column fixed top-0 left-0 h-screen w-64 overflow-y-auto bg-gray-800 text-white">

  {{-- navbar dokter --}}
  @if (Auth::user()->role == 'dokter')
    <li class="nav-item">
      <a href="{{route('dokter.index')}}" class="nav-link">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
          Dahboard
        </p>
      </a>
    </li>
    
    
    <li class="nav-item">
      <a href="{{ route('dokter.periksa') }}" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
          Pemeriksaan
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('dokter.jadwal-periksa') }}" class="nav-link">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>
          Jadwal Periksa
        </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('dokter.riwayat-pasien') }}" class="nav-link">
        <i class="nav-icon fas fa-history"></i>
        <p>
          Riwayat Pasien
        </p>
      </a>
    </li>
    
    {{-- <li class="nav-item">
      <a href="{{route('obat.index')}}" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
          Obat
        </p>
      </a>
    </li> --}}

    <li class="nav-item">
      <a href="{{ route('dokter.edit-profile') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>
          Profile
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

  <li class="nav-item" style="{{ request()->routeIs('pasien.daftar_poli.form') ? 'background-color: #3b82f6;' : '' }}">
    <a href="{{ route('pasien.daftar_poli.form') }}" class="nav-link">
      <i class="nav-icon fas fa-chart-pie" style="color: white"></i>
      <p style="color: white">
        Periksa
      </p>
    </a>
  </li>

{{-- Navbar Admin --}}
  @elseif (Auth::user()->role == 'admin')
  <li class="nav-item">
    <a href="{{ route('dokter-profiles.index') }}" style="{{ request()->routeIs('dokter-profiles.index') ? 'background-color: #3b82f6; color: white !important' : '' }}" class="nav-link bg-blue-500 {{ request()->routeIs('dokter-profiles.index') ? 'bg-blue-500 text-amber-400' : '' }}">
        <i class="nav-icon fas fa-stethoscope"></i>
        <p>
            Kelola Dokter
        </p>
    </a>
  </li>
  
  
  <li class="nav-item">
    <a href="{{ route('pasien-profiles.index') }}" style="{{ request()->routeIs('pasien-profiles.index') ? 'background-color: #3b82f6; color: white !important' : '' }}" class="nav-link bg-blue-500 {{ request()->routeIs('pasien-profiles.index') ? 'bg-blue-500 text-amber-400' : '' }}">
      <i class="nav-icon fas fa-users"></i>
      <p>
        Kelola Pasien
        </p>
      </a>
    </li>
    
    <li class="nav-item">
      <a href="{{ route('poli.index') }}" style="{{ request()->routeIs('poli.index') ? 'background-color: #3b82f6; color: white !important' : '' }}" class="nav-link bg-blue-500 {{ request()->routeIs('poli.index') ? 'bg-blue-500 text-amber-400' : '' }}">
          <i class="nav-icon fas fa-hospital"></i>
          <p>
              Kelola Poli
          </p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{ route('obat.index') }}" style="{{ request()->routeIs('obat.index') ? 'background-color: #3b82f6; color: white !important' : '' }}" class="nav-link bg-blue-500 {{ request()->routeIs('obat.index') ? 'bg-blue-500 text-amber-400' : '' }}">
          <i class="nav-icon fas fa-capsules"></i>
          <p>
              Kelola Obat
          </p>
      </a>
    </li>
    
    @endif
    <form action="{{ route('logout') }}" method="POST" class="mx-auto mt-4">
      @csrf
    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
</form>

