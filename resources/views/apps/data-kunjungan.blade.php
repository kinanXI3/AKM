<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Kunjungan Hari Ini') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Search --}}
                    <div class="flex justify-end mb-4">
                        <form method="GET" action="{{ route('data-kunjungan') }}" class="flex space-x-2">
                            <input type="text" name="search" placeholder="Cari NIM / Nama"
                                value="{{ request('search') }}"
                                class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 px-3 py-2 w-64">
                            <x-primary-button>
                                Cari
                            </x-primary-button>
                        </form>
                    </div>

                    {{-- Tabel Data Kunjungan --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg text-left">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">NIM / Instansi</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Waktu</th>
                                    <th class="px-4 py-2">Metode</th>
                                    <th class="px-4 py-2">Kategori</th>
                                    <th class="px-4 py-2">Keperluan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kunjungan as $k)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $loop->iteration + ($kunjungan->currentPage() - 1) * $kunjungan->perPage() }}</td>
                                        <td class="px-4 py-2">
                                            {{ ($k->kategori === 'Non-Mahasiswa' && !empty($k->instansi)) ? $k->instansi : ($k->nim ?? '-') }}
                                        </td>
                                        <td class="px-4 py-2">{{ $k->nama }}</td>
                                        <td class="px-4 py-2">{{ optional($k->tanggal)->format('d/m/Y') ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $k->waktu ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $k->metode ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $k->kategori ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $k->keperluan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                            Belum ada kunjungan hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $kunjungan->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
