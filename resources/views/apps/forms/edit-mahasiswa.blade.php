<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                @csrf 
                @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                    <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jurusan</label>
                    <select name="jurusan" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        <option value="TI" {{ $mahasiswa->jurusan == 'TI' ? 'selected' : '' }}>TI</option>
                        <option value="SI" {{ $mahasiswa->jurusan == 'SI' ? 'selected' : '' }}>SI</option>
                        <option value="DKV" {{ $mahasiswa->jurusan == 'DKV' ? 'selected' : '' }}>DKV</option>
                        <option value="AK" {{ $mahasiswa->jurusan == 'AK' ? 'selected' : '' }}>AK</option>
                        <option value="MI" {{ $mahasiswa->jurusan == 'MI' ? 'selected' : '' }}>MI</option>
                    </select>
                </div>
                <div class="mb-4">  
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Angkatan</label>
                    <input type="number" name="angkatan" value="{{ $mahasiswa->angkatan }}" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>          
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        <option value="Aktif" {{ $mahasiswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $mahasiswa->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <x-primary-button>
                    {{ __('Update') }}
                </x-primary-button>
            </form>
        </div>
    </div>

</x-app-layout>