{{-- resources/views/klasifikasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Klasifikasi')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md">
        <div class="p-6">
            <h1 class="text-3xl font-bold text-center text-gray-800">Form Klasifikasi C4.5</h1>
            <p class="text-center text-gray-600 mt-2">Silakan isi data dengan lengkap dan benar</p>
            
            <div class="mt-8 border-t pt-6">
                <form action="{{ route('classification.predict') }}" method="POST" class="space-y-6" id="classificationForm">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kolom Kiri --}}
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="kelas" id="kelas" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih kelas</option>
                                    @foreach(['X', 'XI', 'XII'] as $kelas)
                                        <option value="{{ $kelas }}">{{ $kelas }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                                <select name="umur" id="umur" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih umur</option>
                                    @foreach(range(15, 18) as $umur)
                                        <option value="{{ $umur }}">{{ $umur }} tahun</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="insiden" class="block text-sm font-medium text-gray-700">Insiden Yang Dialami</label>
                                <select name="insiden" id="insiden" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih insiden</option>
                                    @php
                                        $insiden = [
                                            'BV' => 'Diejek, dihina, diberi julukan negatif',
                                            'BS' => 'Dikucilkan, dirumorkan yang jelek',
                                            'BF' => 'Dipukul, ditendang, didorong',
                                            'PSV' => 'Dikommentari seksual, dicatcalling',
                                            'PSNV' => 'Gestur tidak pantas',
                                            'PSF' => 'Menyentuh tanpa izin, memeluk tanpa izin',
                                            'PSO' => 'Mengirim pesan berbau seksual'
                                        ];
                                    @endphp
                                    @foreach($insiden as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi Kejadian</label>
                                <select name="lokasi" id="lokasi" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    @php
                                        $lokasi = ['kelas', 'media sosial', 'koridor sekolah', 'kantin', 'toilet', 'lapangan'];
                                    @endphp
                                    @foreach($lokasi as $lok)
                                        <option value="{{ $lok }}">{{ ucfirst($lok) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="space-y-4">
                            <div class="form-group">
                                <label for="frekuensi" class="block text-sm font-medium text-gray-700">Frekuensi Kejadian</label>
                                <select name="frekuensi" id="frekuensi" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih frekuensi</option>
                                    <option value="jarang">Jarang (1-3 kali)</option>
                                    <option value="kadang-kadang">Kadang-Kadang (3-7 kali)</option>
                                    <option value="tinggi">Tinggi (lebih dari 7 kali)</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="insiden_langsung" class="block text-sm font-medium text-gray-700">Insiden terjadi langsung atau tidak langsung?</label>
                                <select name="insiden_langsung" id="insiden_langsung" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih jenis insiden</option>
                                    <option value="Langsung">Langsung</option>
                                    <option value="Tidak Langsung">Tidak Langsung</option>
                                    <option value="Online">Online</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="siapa_pelaku" class="block text-sm font-medium text-gray-700">Siapa Pelaku Insiden?</label>
                                <select name="siapa_pelaku" id="siapa_pelaku" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih pelaku</option>
                                    <option value="Teman Sebaya">Teman Sebaya</option>
                                    <option value="Senior">Senior</option>
                                    <option value="Guru/Staff">Guru/Staff</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin_pelaku" class="block text-sm font-medium text-gray-700">Jenis Kelamin Pelaku</label>
                                <select name="jenis_kelamin_pelaku" id="jenis_kelamin_pelaku" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih jenis kelamin pelaku</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                    <option value="Campuran">Campuran</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dampak_psikologis" class="block text-sm font-medium text-gray-700">Dampak Psikologis Yang Dirasakan</label>
                                <select name="dampak_psikologis" id="dampak_psikologis" 
                                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    required>
                                    <option value="" disabled selected>Pilih dampak psikologis</option>
                                    <option value="rendah">Rendah (contoh: merasa terganggu sesaat)</option>
                                    <option value="sedang">Sedang (contoh: merasa tertekan beberapa hari)</option>
                                    <option value="tinggi">Tinggi (contoh: berdampak pada kesehatan mental jangka panjang)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Klasifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
<script>
document.getElementById('classificationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const button = this.querySelector('button[type="submit"]');
    button.disabled = true;
    button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Memproses...
    `;
    this.submit();
});
</script>
@endpush