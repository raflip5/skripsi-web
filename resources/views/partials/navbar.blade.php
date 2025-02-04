<nav class="px-6 py-4 bg-white border-b border-gray-200 shadow-sm sticky top-0">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-1 sm:gap-4">
            @php
                $navItems = [
                    ['name' => 'Home', 'route' => 'dashboard'],
                    ['name' => 'Klasifikasi C4.5', 'route' => 'klasifikasi.index'],
                    ['name' => 'Akun', 'route' => 'ganti.index']
                ];
            @endphp

            @foreach ($navItems as $item)
                <a href="{{ route($item['route']) }}" 
                   class="px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-blue-50 hover:text-blue-600
                        {{ request()->routeIs($item['route']) ? 'bg-blue-500 text-white hover:bg-blue-600 hover:text-white' : 'text-gray-700' }}">
                    {{ $item['name'] }}
                </a>
            @endforeach
        </div>

        <form action="" method="POST" class="m-0">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="hidden sm:inline">Logout</span>
            </button>
        </form>
    </div>
</nav>