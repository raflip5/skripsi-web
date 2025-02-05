@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header Profile Section -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 p-6">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <!-- School Logo -->
                        <img src="{{ Vite::asset('resources/assets/logo-sman1.png') }}" alt="Logo SMAN 1 Gedong Tataan" class="w-20 h-20 rounded-full bg-white p-2"/>
                        <div class="text-white">
                            <h1 class="text-3xl font-bold">SMAN 1 Gedong Tataan</h1>
                            <p class="mt-2 opacity-90">Kabupaten Pesawaran, Lampung</p>
                        </div>
                    </div>
                    <div>
                        <a href="https://maps.google.com/?q=SMAN+1+Gedong+Tataan" target="_blank" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors">
                            Lokasi Sekolah
                            <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Alamat</h4>
                            <p class="text-gray-600">Jl. Swadaya VI, Sukaraja, Kec. Gedong Tataan</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">Akreditasi</h4>
                            <p class="text-gray-600">A (Unggul)</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">NPSN</h4>
                            <p class="text-gray-600">10809744</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-800">No Telepon</h4>
                            <p class="text-gray-600">0882-6829-5977</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rest of the code remains the same... -->
        <!-- Photo Gallery Section -->
        <div class="mb-8">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Galeri Sekolah</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Gallery Item 1 -->
                    <div class="relative group">
                        <img src="{{ Vite::asset('resources/assets/gedung-sekolah.jpeg') }}" alt="Gedung Sekolah" class="w-full h-48 object-cover rounded-lg"/>
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Gedung Sekolah</span>
                        </div>
                    </div>
                    <!-- Gallery Item 2 -->
                    <div class="relative group">
                        <img src="{{ Vite::asset('resources/assets/kegiatan-upacara-sekolah.jpg') }}" alt="Kegiatan Upacara Sekolah" class="w-full h-48 object-cover rounded-lg"/>
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Kegiatan Upacara Sekolah</span>
                        </div>
                    </div>
                    <!-- Gallery Item 3 -->
                    <div class="relative group">
                        <img src="{{ Vite::asset('resources/assets/foto-lab.jpg') }}" alt="Lab Komputer" class="w-full h-48 object-cover rounded-lg"/>
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Lab Komputer</span>
                        </div>
                    </div>
                    <!-- Gallery Item 4 -->
                    <div class="relative group">
                        <img src="{{ Vite::asset('resources/assets/paskib-smansageta.jpeg') }}" alt="pelantikan paskib" class="w-full h-48 object-cover rounded-lg"/>
                        <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                            <span class="text-white text-sm font-medium">Pelantikan Paskib</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- School Profile Section (Moved below gallery) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Visi & Misi Section -->
            <div class="md:col-span-2">
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Visi & Misi</h2>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold text-blue-600 mb-3">Visi</h3>
                            <p class="text-gray-700">"TERWUJUDNYA INSAN YANG RELIGIUS, BERPRESTASI, BERKARAKTER DAN BERWAWASAN GLOBAL"</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-blue-600 mb-3">Misi</h3>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Menumbuhkan penghayatan dan pengamalan terhadap agama yang dianut dan juga budaya bangsa, sehingga menjadi sumber kearifan dalam bertindak
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Melaksanakan pembelajaran dan bimbingan secara efektif sehingga setiap siswa dapat berkembang secara optimal, sesuai potensi yang dimiliki.
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mengembangkan sikap ilmiah disertai santun dan bertanggungjawab dalam bekerja dan kehidupan sehari-hari
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mengakses dan memberikan informasi sebagai perbaikan dan inovasi
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Memupuk dan meningkatkan kerjasama antar warga sekolah, lingkungan, masyarakat dan orang tua siswa
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-5 h-5 text-blue-500 mr-2 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Mengembangkan Prestasi akademik dan non akademik
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Facilities Section -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Fasilitas</h2>
                    <ul class="space-y-4">
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">Perpustakaan</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">Lab Komputer</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">Lab IPA</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">Lapangan Olahraga</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">Mushola</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <div class="p-2 bg-blue-100 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <span class="text-gray-700">UKS</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection