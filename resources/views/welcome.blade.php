@include('components.header', ['title' => 'Main'])
    <body class="bg-gray-900">
        <div class="min-w-full h-screen flex flex-col items-center justify-center p-10">
            <div class="min-w-full min-h-full rounded-lg p-8 flex flex-row items-center text-white relative">
                <div class="m-5 leading-8">
                    <h1 class="text-cyan-300 text-6xl font-bold">AKM</h1>
                    <p class="text-xl text-gray-300">Aplikasi Kehadiran Mahasiswa</p>
                </div>
                <div class="flex flex-row itmes-center align-center absolute bottom-0 right-0">
                    <a href="{{ route('login') }}" class="p-3 m-4 rounded-md bg-cyan-700 hover:bg-cyan-800 hover:outline-2 hover:outline-cyan-800 hover:outline-offset-4 ease-in-out">Log In</a>
                    <a href="{{ route('register') }}" class="p-3 m-4 rounded-md hover:outline-2 hover:outline-cyan-800 hover:outline-offset-4 ease-in-out">Register</a>
                </div>
            </div>
        </div>
        <section class="min-w-full h-screen flex flex-col items-center justify-center p-10">
            <div class="mt-5 p-3 min-w-full flex flex-col items-center gap-6 text-center">
                <h1 class="text-white text-4xl">Tentang Aplikasi Ini</h1>
                <p class="mt-3 w-6xl leading-9 text-gray-300">Nulla diam risus, fringilla maximus nunc non, euismod sagittis massa. Etiam eu posuere orci. Aenean ultrices augue nibh, vitae viverra neque ultrices eget. Sed non facilisis nulla. Sed viverra a quam quis maximus. Donec hendrerit pellentesque est, quis placerat urna placerat vehicula. In libero felis, pulvinar a turpis sit amet, molestie tincidunt lorem. Duis congue sodales enim, ut consequat elit rhoncus pretium. Aliquam porttitor elit eget nibh tempus, non porttitor neque lobortis. Maecenas feugiat hendrerit eleifend. Etiam dapibus nisi id nulla blandit, vestibulum sollicitudin justo placerat. Sed pulvinar, diam id vehicula imperdiet, orci mi auctor dui, in commodo tortor ex sed felis. Phasellus vehicula elit eu tellus blandit, sit amet auctor mauris gravida. Maecenas quis luctus ipsum. In eget justo diam.</p>
            </div>
        </section>
    </body>
</html>
