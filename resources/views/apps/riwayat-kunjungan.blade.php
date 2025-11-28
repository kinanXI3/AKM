<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Riwayat Kunjungan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Filter & Search --}}
                    <div class="flex justify-between items-center mb-4">
                        <form method="GET" action="{{ route('riwayat-kunjungan') }}" class="flex space-x-2">
                            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 px-3 py-2">
                            <input type="text" name="search" placeholder="Cari NIM / Nama"
                                value="{{ request('search') }}"
                                class="rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 px-3 py-2 w-64">
                            <x-primary-button>
                                Cari
                            </x-primary-button>
                        </form>
                    </div>

                    {{-- Tabel Riwayat Kunjungan --}}
                    <div class="overflow-x-auto rounded-lg">
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
                                @forelse ($riwayat as $r)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $loop->iteration + ($riwayat->currentPage() - 1) * $riwayat->perPage() }}</td>
                                        <td class="px-4 py-2">
                                            {{ ($r->kategori === 'Non-Mahasiswa' && !empty($r->instansi)) ? $r->instansi : ($r->nim ?? '-') }}
                                        </td>
                                        <td class="px-4 py-2">{{ $r->nama }}</td>
                                        <td class="px-4 py-2">{{ optional($r->tanggal)->format('d/m/Y') ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $r->waktu ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $r->metode ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $r->kategori ?? '-' }}</td>
                                        <td class="px-4 py-2">{{ $r->keperluan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                            Riwayat kunjungan belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $riwayat->withQueryString()->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>