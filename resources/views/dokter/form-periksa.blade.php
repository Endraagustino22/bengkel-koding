@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Form Pemeriksaan Pasien</h2>

        <form action="{{ route('dokter.periksa-store', $periksa->id) }}" method="POST">
            @csrf

            <!-- ID Pasien -->
            <div class="mb-4">
                <label for="id" class="block font-semibold text-gray-700 mb-1">Nama Pasien</label>
                <input type="text" name="id" value="{{ $periksa->pasien->nama }}" readonly class="w-full border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600 cursor-not-allowed">
            </div>

            <!-- Tanggal Pemeriksaan -->
            <div class="mb-4">
                <label for="tanggal" class="block font-semibold text-gray-700 mb-1">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400" required>
            </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="catatan" class="block font-semibold text-gray-700 mb-1">Catatan</label>
                <textarea name="catatan" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400" rows="3"></textarea>
            </div>

            <!-- Pilihan Obat -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Obat</label>
                <div id="obat-container">
                    <div class="flex gap-2 mb-2">
                        <select name="obat_ids[]" class="obat-dropdown border border-gray-300 rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring focus:border-blue-400">
                            <option value="">-- Pilih Obat --</option>
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}" data-harga="{{ $obat->harga }}">
                                    {{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp{{ number_format($obat->harga) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="button" onclick="addObat()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">+ Tambah</button>
                    </div>
                </div>
            </div>

            <!-- Obat yang Dipilih -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Obat yang Dipilih</label>
                <ul id="obat-list" class="list-disc pl-5 text-gray-700 space-y-1">
                    <!-- Obat yang dipilih tampil di sini -->
                </ul>
            </div>

            <!-- Total Harga -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-1">Total Harga</label>
                <input type="text" id="total_harga" name="total_harga" class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600 cursor-not-allowed" readonly>
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-semibold">
                    Simpan Pemeriksaan
                </button>
            </div>
        </form>
    </div>
@endsection

<script>
    let totalHarga = 0;

    function addObat() {
        const selectElement = document.querySelector('.obat-dropdown');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const obatId = selectedOption.value;
        const obatText = selectedOption.textContent;
        const harga = parseInt(selectedOption.getAttribute('data-harga'));

        if (obatId) {
            const listItem = document.createElement('li');
            listItem.classList.add('flex', 'items-center', 'justify-between');
            listItem.innerHTML = `
                <span>${obatText}</span>
                <button type="button" class="text-red-500 hover:text-red-700 ml-2 text-sm" onclick="removeObat(this, ${harga})">✖</button>`;
            document.getElementById('obat-list').appendChild(listItem);

            totalHarga += harga;
            updateTotal();
        }
    }

    function removeObat(button, harga) {
        button.parentElement.remove();
        totalHarga -= harga;
        updateTotal();
    }

    function updateTotal() {
        const totalInput = document.getElementById('total_harga');
        totalInput.value = totalHarga;
    }
</script>
