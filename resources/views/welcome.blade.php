<x-login-layout>
        <div class="w-full max-w-screen-xl rounded-lg p-8 flex flex-row items-center text-white relative">
            <div class="m-5 leading-8">
                <h1 class="text-cyan-300 text-6xl font-bold">AKM</h1>
                <p class="text-xl text-gray-300">Aplikasi Kehadiran Mahasiswa</p>
            </div>
            <div class="flex flex-row w-full items-center justify-end">
                <a href="{{ route('login') }}" class="p-3 m-4 rounded-md bg-cyan-700 hover:bg-cyan-800 hover:outline-2 hover:outline-cyan-800 hover:outline-offset-4 ease-in-out">Log In</a>
                <a href="{{ route('register') }}" class="p-3 m-4 rounded-md hover:outline-2 hover:outline-cyan-800 hover:outline-offset-4 ease-in-out">Register</a>
            </div>
        </div>
</x-login-layout>
