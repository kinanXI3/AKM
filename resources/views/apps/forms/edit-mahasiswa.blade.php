<x-app-layout>
    <x-slot>
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
                    <label class="block">NIM</label>
                    <input type="text" name="nim" value="{{ $mahasiswa->nim }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-">
                    <label class="block">Nama</label>
                    <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
                </div>
                <div class="mb-4">
                    <label class="block">Jurusan</label>
                    <input type="text" name="jurusan" value="{{ $mahasiswa->jurusan }}" class="w-full border border-gray-300 rounded px-3 py-2" required> 
                </div>
                <div class="mb-4">  
                    <label class="block">Angkatan</label>
                    <input type="number" name="angkatan" value="{{ $mahasiswa->angkatan }}" class="w-full border border-gray-300 rounded px-3 py-2" required>          
                </div>
                <div class="mb-4">
                    <label class="block">Status</label>
                    <select name="status" class="w-full border border-gray-300 rounded px-3 py-2" required>
                        <option value="Aktif" {{ $mahasiswa->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $mahasiswa->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                <x-primary-button>
                    {{ __('Update') }}
                </x-primary-button>
            </form>
        </div>
    </div>

</x-app-layout>