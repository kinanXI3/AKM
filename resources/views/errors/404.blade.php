@include('components.header', ['title' => 'Not Found'])
    <div class="flex flex-col items-center justify-center w-full h-screen leading-8 gap-6 text-center">
        <h1 class="text-6xl text-white">404</h1>
        <p class="text-gray-500">The requested resource is not found. Well... you've found this cat instead. Say hi!</p>
        <img src="{{ asset('images/cat.svg') }}" alt="cartoon cat sitting with a curious expression in a minimalistic background, conveying a lighthearted and friendly mood" class="mt-5"/>
    </div>
@include('components.footer')