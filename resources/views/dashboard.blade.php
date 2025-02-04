@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative h-[50vh] bg-gradient-to-r from-blue-600 to-purple-600">
        <div class="container mx-auto h-full flex items-center px-6">
            <div class="text-white">
                <h1 class="text-4xl font-bold mb-4">Welcome Back!</h1>
                <p class="text-lg opacity-90">Sistem Klasifikasi C4.5 untuk Analisis Data</p>
                <div class="mt-6 flex gap-4">
                    <a href="{{ route('klasifikasi.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-600 rounded-lg hover:bg-gray-100 transition-colors">
                        Mulai Klasifikasi
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Section -->
    <div class="container mx-auto px-6 py-12">
        <div class="grid md:grid-cols-2 gap-8 items-center">
            <div>
                <img src="{{ Vite::asset('resources/assets/cover-home.png') }}" alt="Information" class="rounded-lg shadow-lg">
            </div>
            <div class="space-y-6">
                <h2 class="text-3xl font-bold text-gray-800">Sistem Klasifikasi C4.5</h2>
                <div class="space-y-4">
                    <div class="flex items-start space-x-4">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Analisis Akurat</h3>
                            <p class="text-gray-600">Menggunakan algoritma C4.5 untuk hasil klasifikasi yang tepat</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Proses Cepat</h3>
                            <p class="text-gray-600">Hasil klasifikasi instan dengan performa tinggi</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-4">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Hasil Tervalidasi</h3>
                            <p class="text-gray-600">Validasi data menyeluruh untuk akurasi maksimal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection