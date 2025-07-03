@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">Profil Pengguna</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-semibold">Nama:</label>
                <p>{{ auth()->user()->nama }}</p>
            </div>
            <div>
                <label class="font-semibold">Email:</label>
                <p>{{ auth()->user()->email }}</p>
            </div>
            <div>
                <label class="font-semibold">No HP:</label>
                <p>{{ auth()->user()->no_hp }}</p>
            </div>
            <div>
                <label class="font-semibold">Role:</label>
                <p class="capitalize">{{ auth()->user()->role }}</p>
            </div>
            <div class="md:col-span-2">
                <label class="font-semibold">Alamat:</label>
                <p>{{ auth()->user()->alamat }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
