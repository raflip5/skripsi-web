<!-- resources/views/classification/result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
   <div class="max-w-2xl mx-auto">
       <div class="bg-white shadow-lg rounded-lg overflow-hidden">
           <div class="px-6 py-8">
               <div class="text-center mb-8">
                   <h1 class="text-3xl font-bold text-gray-900 mb-2">Hasil Klasifikasi</h1>
                   <p class="text-gray-600">Analisis berdasarkan data yang diberikan</p>
               </div>

               <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
                   <div class="flex">
                       <div class="ml-3">
                           <h3 class="text-xl font-semibold text-gray-900">
                               {{ $result }}
                           </h3>
                           <p class="mt-2 text-blue-700">
                               Tingkat keyakinan: {{ $confidence }}%
                           </p>
                       </div>
                   </div>
               </div>

               <div class="space-y-4">
                   <div class="bg-gray-50 rounded-lg p-4">
                       <h2 class="text-lg font-medium text-gray-900 mb-2">Rekomendasi Tindakan</h2>
                       <p class="text-gray-600">
                           Segera laporkan insiden ini kepada pihak berwenang di sekolah untuk penanganan lebih lanjut.
                       </p>
                   </div>
               </div>

               <div class="mt-8 text-center">
                   <a 
                       href="{{ route('classification.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                   >
                       Kembali ke Form
                   </a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection