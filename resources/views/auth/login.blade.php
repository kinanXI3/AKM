@include('components.header', ['title' => 'Login'])
        <div class="flex flex-col items-center justify-center bg-[url('{{ asset('images/bg.svg') }}')] w-full h-screen leading-8 text-center">
            <h1 class="text-white font-light text-2xl space-y-1.5">Selamat Datang di Aplikasi Kehadiran Mahasiswa!</h1>
            <p class="text-gray-500 font-light">Silahkan masuk ke <span class="text-cyan-800">Akun anda</span>!</p>
            <div class="w-2xl h-xs flex flex-col bg-gray-800 p-6 mt-8 rounded-md text-white">
            <form method="POST" action="{{ route('show.login') }}" class="flex flex-col w-full h-full">
                @csrf

                @session('error')
                <div class="text-red-500 mb-3">
                    <p>{{ $value }}</p>
                </div>
                @endsession
                
                <label for="username"><h1 class="text-left">Username</h1></label>
                <input type="text" name="username" id="username" class="bg-gray-700 text-white rounded-md p-2 mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-cyan-800" placeholder="Enter your Username" value="{{ old('username') }}" />
                <label for="password"><h1 class="text-left">Password</h1></label>
                <input type="password" name="password" id="password" class="bg-gray-700 text-white rounded-md p-2 mt-1 mb-3 focus:outline-none focus:ring-2 focus:ring-cyan-800" placeholder="Enter your Password" />
                <input type="submit" value="Login" class="bg-cyan-800 text-white rounded-md p-2 mt-1 hover:bg-cyan-700 transition-colors duration-300 cursor-pointer" />
            </form>
            </div>
        </div>
@include('components.footer')
