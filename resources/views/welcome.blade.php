<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"/> 

<div class="w-full bg-gray-800 fixed p-4 flex flex-row justify-between items-center">
    <div class="flex items-center gap-3">
        <i class="material-symbols-outlined text-gray-300 text-3xl">school</i>
        <h1 class="font-bold text-3xl text-gray-300">AKM</h1>
    </div>
    <x-secondary-button>
        <a href="{{ route('login') }}">Log In</a>
    </x-secondary-button>
</div>

<x-login-layout>

    <div class="flex flex-col">
        @if(session('absen_status'))
        <div id="toast" class="w-full rounded-lg p-3 flex flex-row items-center text-white relative {{ session('absen_status') === 'success' ? 'bg-green-600' : 'bg-red-600' }}">
            {{ session('absen_message') }}
        </div>
        <script>
            setTimeout(() => {
                document.getElementById('toast').style.display = 'none';
            }, 2500);
        </script>
        @endif
        
        <div class="w-full max-w-screen-xl rounded-lg p-8 flex flex-row items-center text-white relative">
            <div class="leading-8 w-full">
                <h1 class="text-cyan-300 text-4xl font-bold">Selamat Datang</h1>
                <p class="text-md text-gray-300">Silakan pilih jenis absensi di bawah ini.</p>
            </div>

            <div class="flex flex-col w-full items-end gap-6 justify-end">

                <!-- Tombol Switch Form -->
                <div class="flex gap-3">
                    <button id="btnMahasiswa" class="px-4 py-2 rounded-lg bg-cyan-600 hover:bg-cyan-700 text-white font-semibold">Mahasiswa</button>
                    <button id="btnNonMahasiswa" class="px-4 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white font-semibold">Non-Mahasiswa</button>
                </div>

                <!-- FORM MAHASISWA -->
                <form id="formMahasiswa" method="POST" action="{{ route('absen.check') }}" class="w-full">
                    @csrf
                    <div class="mb-5 flex flex-col gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                            <input type="text" name="nim" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" name="nama" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        </div>
                        <x-primary-button class="text-center w-full">
                            {{ __('Absen') }}
                        </x-primary-button>
                    </div>
                </form>

                <!-- FORM NON-MAHASISWA -->
                <form id="formNonMahasiswa" method="POST" action="{{ route('absen.nonmahasiswa') }}" class="w-full hidden">
                    @csrf
                    <div class="mb-5 flex flex-col gap-4 mt-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                            <input type="text" name="nama" class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Instansi / Asal</label>
                            <input type="text" name="instansi" placeholder="Misal: SMA X, Umum, Alumni, Dosen Tamu..." class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keperluan</label>
                            <input type="text" name="keperluan" placeholder="Misal: Membaca, Penelitian, Kunjungan..." class="w-full border rounded px-3 py-2 bg-gray-950 border-gray-800 dark:bg-gray-800 dark:border-gray-500 dark:text-white text-black" required>
                        </div>
                        <x-primary-button class="text-center w-full">
                            {{ __('Absen') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const btnMahasiswa = document.getElementById('btnMahasiswa');
        const btnNonMahasiswa = document.getElementById('btnNonMahasiswa');
        const formMahasiswa = document.getElementById('formMahasiswa');
        const formNonMahasiswa = document.getElementById('formNonMahasiswa');

        btnMahasiswa.addEventListener('click', () => {
            formMahasiswa.classList.remove('hidden');
            formNonMahasiswa.classList.add('hidden');
            btnMahasiswa.classList.add('bg-cyan-600');
            btnNonMahasiswa.classList.remove('bg-cyan-600');
        });

        btnNonMahasiswa.addEventListener('click', () => {
            formNonMahasiswa.classList.remove('hidden');
            formMahasiswa.classList.add('hidden');
            btnNonMahasiswa.classList.add('bg-cyan-600');
            btnMahasiswa.classList.remove('bg-cyan-600');
        });
    </script>

</x-login-layout>
