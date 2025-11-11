<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-container-layout>
        <div class="w-full flex sm:flex-row flex-col gap-3">

            <!-- Total Pengunjung Hari Ini -->
            <div class="w-full dark:bg-gray-700 p-4 rounded rounded-md dark:text-gray-100">
                <h1>Total Pengunjung Hari Ini</h1>
                <div class="w-full h-max flex flex-row items-center gap-4 p-3 my-3">
                    <img src="{{ asset('images/icons/person.svg') }}" alt="person" class="h-10 w-10">
                    <h1 class="text-3xl font-bold">{{ $totalHariIni }}</h1>
                </div>
                <x-primary-button class="w-full">
                    <a href="{{ route('data-kunjungan') }}" class="w-full h-max">Lihat Selengkapnya</a>
                </x-primary-button>

                <!-- Total Jurusan -->
            </div>
            <div class="w-full dark:bg-gray-700 p-4 rounded rounded-md dark:text-gray-100">
                <h1>Total Jurusan</h1>
                <div class="w-full h-max flex flex-row items-center gap-4 p-3 my-3">
                    <img src="{{ asset('images/icons/person.svg') }}" alt="person" class="h-10 w-10">
                    <h1 class="text-3xl font-bold">5</h1>
                </div>
                <x-primary-button class="w-full">
                    <a href="{{ route('data-kunjungan') }}"></a>
                    {{ __('Lihat Detail') }}
                </x-primary-button>
            </div>

            <!-- Total Mahasiswa Terdaftar -->
            <div class="w-full dark:bg-gray-700 p-4 rounded rounded-md dark:text-gray-100">
                <h1>Total Mahasiswa Terdaftar</h1>
                <div class="w-full h-max flex flex-row items-center gap-4 p-3 my-3">
                    <img src="{{ asset('images/icons/person.svg') }}" alt="person" class="h-10 w-10">
                    <h1 class="text-3xl font bold">
                        {{ $totalMahasiswa ?? \App\Models\Mahasiswa::count() }}
                    </h1>
                </div>
                <x-primary-button class="w-full">
                    {{ __('Lihat Detail') }}
                </x-primary-button>
            </div>
        </div>
    </x-container-layout>
</x-app-layout>
