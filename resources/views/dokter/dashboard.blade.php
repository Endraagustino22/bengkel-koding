@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-xl font-semibold mb-6">Dashboard</h1>

        <!-- Profil User -->
        <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
            <h5 class="text-2xl font-medium text-gray-800 mb-4">{{ $user->nama }}</h5>
            <p class="text-gray-600">
                <strong class="font-semibold">Email:</strong> {{ $user->email }}<br>
                <strong class="font-semibold">No HP:</strong> {{ $user->no_hp }}<br>
                <strong class="font-semibold">Role:</strong> {{ ucfirst($user->role) }}<br>
                <strong class="font-semibold">Alamat:</strong> {{ $user->alamat }}
            </p>
        </div>

       
    </div>
@endsection
