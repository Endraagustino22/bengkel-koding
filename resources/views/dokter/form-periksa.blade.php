@extends('layouts.main')

@section('content')
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-700">Form Pemeriksaan Pasien</h2>

        <form action="{{ route('dokter.periksa-store', $daftarPoli->id) }}" method="POST">
            @csrf

            <!-- Nama Pasien -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Nama Pasien</label>
                <input type="text" value="{{ $daftarPoli->pasien->nama }}" readonly
                       class="w-full border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600 cursor-not-allowed">
            </div>

            <!-- Tanggal Pemeriksaan -->
            <div class="mb-4">
                <label for="tanggal" class="block font-semibold text-gray-700 mb-1">Tanggal Pemeriksaan</label>
                <input type="date" name="tanggal" required
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <!-- Catatan -->
            <div class="mb-4">
                <label for="catatan" class="block font-semibold text-gray-700 mb-1">Catatan</label>
                <textarea name="catatan" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-400"></textarea>
            </div>

            <!-- Pilihan Obat -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-2">Obat</label>
                <div id="obat-container">
                    <div class="flex gap-2 mb-2">
                        <select id="obat-dropdown" class="obat-dropdown border border-gray-300 rounded-lg px-4 py-2 flex-1 focus:outline-none focus:ring focus:border-blue-400">
                            <option value="">-- Pilih Obat --</option>
                            @foreach($obats as $obat)
                                <option value="{{ $obat->id }}" data-nama="{{ $obat->nama_obat }}" data-harga="{{ $obat->harga }}">
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
                    <!-- Obat akan ditampilkan di sini -->
                </ul>
            </div>

            <!-- Hidden Inputs for Selected Obats -->
            <div id="obat-inputs"></div>

            <!-- Total Harga -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-1">Total Harga</label>
                <input type="text" id="total_harga" name="total_harga" readonly
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-100 text-gray-600 cursor-not-allowed">
            </div>

            <!-- Submit -->
            <div class="text-right">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm font-semibold">
                    Simpan Pemeriksaan
                </button>
            </div>
        </form>
    </div>

    <script>
        let totalHarga = 0;

        function addObat() {
            const dropdown = document.getElementById('obat-dropdown');
            const selectedOption = dropdown.options[dropdown.selectedIndex];
            const obatId = selectedOption.value;
            const nama = selectedOption.getAttribute('data-nama');
            const harga = parseInt(selectedOption.getAttribute('data-harga'));

            if (!obatId) return;

            // Tambahkan ke daftar obat
            const listItem = document.createElement('li');
            listItem.classList.add('flex', 'justify-between', 'items-center');
            listItem.innerHTML = `
                <span>${nama} - Rp${harga.toLocaleString()}</span>
                <button type="button" class="text-red-500 hover:text-red-700 ml-2 text-sm" onclick="removeObat(this, ${harga}, ${obatId})">✖</button>
            `;
            document.getElementById('obat-list').appendChild(listItem);

            // Tambahkan input hidden
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'obat_ids[]';
            input.value = obatId;
            input.setAttribute('data-obat-id', obatId);
            document.getElementById('obat-inputs').appendChild(input);

            // Update total
            totalHarga += harga;
            updateTotal();
        }

        function removeObat(button, harga, obatId) {
            button.parentElement.remove();
            const input = document.querySelector(`input[data-obat-id="${obatId}"]`);
            if (input) input.remove();
            totalHarga -= harga;
            updateTotal();
        }

        function updateTotal() {
            document.getElementById('total_harga').value = totalHarga.toLocaleString();
        }
    </script>
@endsection
