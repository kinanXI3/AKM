<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                @csrf
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                    <input type="text" name="nim"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="nama"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jurusan</label>
                    <select name="jurusan"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                        <option value="TI">TI</option>
                        <option value="SI">SI</option>
                        <option value="DKV">DKV</option>
                        <option value="AK">AK</option>
                        <option value="MI">MI</option>
                    </select>
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Angkatan</label>
                    <input type="number" name="angkatan"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                </div>
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                        <option value="Aktif">Aktif</option>
                        <option value="Nonaktif">Nonaktif</option>
                    </select>
                </div>

                {{-- Import Excel --}}
                <div class="mb-5">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Import Excel (opsional)
                    </label>
                    <input type="file" name="excel" 
                        accept=".xlsx,.xls"
                        class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black">
                </div>

                <x-primary-button>
                    {{ __('Simpan') }}
                </x-primary-button>

                <x-secondary-button class="ml-5" onclick="window.location='{{ route('data-mahasiswa') }}'">
                    {{ __('Batal') }}
                </x-secondary-button>
            </form>
        </div>
    </div>
</x-app-layout>