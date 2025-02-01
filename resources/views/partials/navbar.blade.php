<nav class="px-6 py-4 flex items-center justify-between bg-white border-b-2 shadow">
    <div class="flex items-center gap-4">
        <a href="{{route('dashboard')}}" class="{{request()->routeIs('dashboard') ? 'bg-blue-500 px-4 py-2 text-white rounded' : ''}}">Home</a>
        <a href="{{route('klasifikasi.index')}}" class="{{request()->routeIs('klasifikasi.index') ? 'bg-blue-500 px-4 py-2 text-white rounded' : ''}}">Klasifikasi C4.5</a>
        <a href="">Riwayat</a>
        <a href="{{route('ganti.index')}}" class="{{request()->routeIs('ganti.index') ? 'bg-blue-500 px-4 py-2 text-white rounded' : ''}}">Akun</a>
    </div>

    <button class="bg-red-500 px-4 py-2 text-white rounded">Logout</button>
</nav>