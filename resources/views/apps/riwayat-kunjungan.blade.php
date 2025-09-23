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
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">NIM</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="px-4 py-2">Waktu</th>
                                    <th class="px-4 py-2">Metode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayat as $i => $r)
                                    <tr class="border-t border-gray-200 dark:border-gray-700">
                                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                                        <td class="px-4 py-2">{{ $r->nim }}</td>
                                        <td class="px-4 py-2">{{ $r->nama }}</td>
                                        <td class="px-4 py-2">{{ $r->tanggal }}</td>
                                        <td class="px-4 py-2">{{ $r->waktu }}</td>
                                        <td class="px-4 py-2">{{ $r->metode }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                            Riwayat kunjungan belum ada.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $riwayat->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>