@extends('layouts.main')
@section('content')
    <div class="max-w-3xl mx-auto p-6">
        <!-- Data Periksa Sebagai Dokter -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Periksa sebagai Dokter</h2>
            @if($user->dokter->isEmpty())
                <p class="text-gray-500">Belum ada data periksa sebagai dokter.</p>
            @else
                <table class="table-auto w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">Tanggal Periksa</th>
                            <th class="px-4 py-2 text-left">Catatan</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Biaya Periksa</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($user->dokter as $periksa)
                            <tr>
                                <td class="px-4 py-2">{{ $periksa->tgl_periksa ?? 'Null' }}</td>
                                <td class="px-4 py-2">{{ $periksa->catatan }}</td>
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="px-2 py-1 rounded {{ $periksa->status == 'belum diperiksa' ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                        {{ $periksa->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-2">Rp {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>

                                {{-- belum periksa --}}
                                @if($periksa->status == 'belum diperiksa')
                                <td class="px-4 py-2 whitespace-nowrap">
                                    <span class="bg-blue-400 px-2 py-1 rounded">
                                        <a href="{{route('dokter.form-periksa', $periksa->id)}}" class="text-white no-underline">periksa<i class="fa fa-stethoscope ml-2"></i></a>
                                    </span>
                                </td>   
                                
                                {{-- sudah periksa --}}
                                @else
                                    <td class="px-4 py-2 whitespace-nowrap">
                                        <span class="bg-blue-400 px-2 py-1 rounded">
                                            <a href="{{ route('dokter.edit-periksa', $periksa->id) }}" class="text-white no-underline">Edit <i class="fa fa-edit"></i></a>
                                        </span>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
