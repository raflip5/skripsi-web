<nav class="px-6 py-4 bg-white border-b border-gray-200 shadow-sm sticky top-0 z-[2]">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <div class="flex items-center gap-1 sm:gap-4">
            @php
                $navItems = [
                    ['name' => 'Beranda', 'route' => 'dashboard'],
                    [
                        'name' => 'Klasifikasi C4.5',
                        'route' => 'klasifikasi.index',
                        'submenu' => [
                            ['name' => 'Mulai Klasifikasi C4.5', 'route' => 'klasifikasi.start'],
                            ['name' => 'Laporan Hasil', 'route' => 'report'],
                        ],
                    ],
                    ['name' => 'Akun', 'route' => 'ganti.index'],
                    ['name' => 'Siswa', 'route' => 'siswa.index'],
                ];
            @endphp

            @foreach ($navItems as $item)
                <div class="relative group">
                    <a href="{{ isset($item['submenu']) ? '#' : route($item['route']) }}"
                        class="px-3 py-2 rounded-md text-sm font-medium transition-colors hover:bg-blue-50 hover:text-blue-600
                            {{ request()->routeIs($item['route']) ? 'bg-blue-500 text-white hover:bg-blue-600 hover:text-white' : 'text-gray-700' }}">
                        {{ $item['name'] }}
                        @if (isset($item['submenu']))
                            <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </a>

                    @if (isset($item['submenu']))
                        <div
                            class="absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden group-hover:block">
                            <div class="py-1" role="menu">
                                @foreach ($item['submenu'] as $submenu)
                                    <a href="{{ route($submenu['route']) }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                            {{ request()->routeIs($submenu['route']) ? 'bg-blue-500 text-white hover:bg-blue-600 hover:text-white' : '' }}"
                                        role="menuitem">
                                        {{ $submenu['name'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="hidden sm:inline">Keluar</span>
            </button>
        </form>
    </div>
</nav>
