<div class="w-full dark:bg-gray-700 p-4 rounded rounded-md dark:text-gray-100">
    <h1>{{ $slot }}</h1>
    {{ $slot }}
    <x-primary-button class="w-full">
        {{ __('Lihat Detail') }}
    </x-primary-button>
</div>
