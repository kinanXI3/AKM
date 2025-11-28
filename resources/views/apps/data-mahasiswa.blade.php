<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{-- Tombol Tambah Data--}}
                    <x-primary-button class="mb-5 flex flex-row content-around gap-3 items-center"
                        onclick="window.location='{{ route('mahasiswa.create') }}'">
                        <img src="{{ asset('images/icons/add-dark.svg') }}" alt="">
                        {{ __(' Tambah Data') }}
                    </x-primary-button>

                    <div class="flex justify-between mb-4">
                        <form method="GET" action="{{ route('data-mahasiswa') }}" class="flex space-x-2">

                            {{-- Filter Jurusan --}}
                            <select name="jurusan"
                                class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 px-3 py-2">
                                <option value="">Semua Jurusan</option>
                                <option value="TI" {{ request('jurusan') == 'TI' ? 'selected' : '' }}>TI</option>
                                <option value="SI" {{ request('jurusan') == 'SI' ? 'selected' : '' }}>SI</option>
                                <option value="DKV" {{ request('jurusan') == 'DKV' ? 'selected' : '' }}>DKV</option>
                                <option value="AK" {{ request('jurusan') == 'AK' ? 'selected' : '' }}>AK</option>
                                <option value="MI" {{ request('jurusan') == 'MI' ? 'selected' : '' }}>MI</option>
                            </select>

                            {{-- Tombol filter --}}
                            <x-primary-button>Filter</x-primary-button>
                        </form>
                    </div>


                    {{-- Tabel Data Mahasiswa --}}
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg text-left">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text_left">NO</th>
                                    <th class="px-4 py-2 text_left">NIM</th>
                                    <th class="px-4 py-2 text_left">Nama</th>
                                    <th class="px-4 py-2 text_left">Jurusan</th>
                                    <th class="px-4 py-2 text_left">Angkatan</th>
                                    <th class="px-4 py-2 text_left">Status</th>
                                    <th class="px-4 py-2 text_left">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mahasiswa as $mhs)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2">{{ $mhs->nim }}</td>
                                        <td class="px-4 py-2">{{ $mhs->nama }}</td>
                                        <td class="px-4 py-2">{{ $mhs->jurusan }}</td>
                                        <td class="px-4 py-2">{{ $mhs->angkatan }}</td>
                                        <td class="px-4 py-2">{{ $mhs->status }}</td>
                                        <td class="flex flex-row content-between gap-3 px-4 py-2 text-center">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('mahasiswa.edit', $mhs->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                                Edit
                                            </a>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-2 text-center">Tidak ada data mahasiswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>