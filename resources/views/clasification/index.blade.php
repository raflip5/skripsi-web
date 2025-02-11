@extends('layouts.app')

@section('title', 'Klasifikasi')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-center text-gray-800">Form Klasifikasi C4.5</h1>
                <p class="text-center text-gray-600 mt-2">Silakan isi data dengan lengkap dan benar</p>

                <div class="mt-8 border-t pt-6">
                    <form action="{{ route('classification.predict') }}" method="POST" class="space-y-6"
                        id="classificationForm">
                        @csrf

                        {{-- NIS Lookup Section --}}
                        <div class="mb-6 pb-6 border-b">
                            <div class="form-group">
                                <label for="nis" class="block text-sm font-medium text-gray-700">Cari Data Siswa dengan
                                    NIS</label>
                                <div class="relative">
                                    <input type="text" name="nis_lookup" id="nis_lookup"
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        placeholder="Masukkan NIS untuk mengisi otomatis">
                                    <button type="button" id="cariNIS"
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </button>
                                </div>
                                <p id="nisError" class="text-red-500 text-xs mt-1 hidden">NIS tidak ditemukan</p>
                            </div>
                        </div>

                        <input type="hidden" name="nis" id="nis" value="{{ $student->nis ?? null }}">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Kolom Kiri --}}
                            <div class="space-y-4">
                                <div class="form-group">
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" id="nama" disabled
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required value="{{ $student->name ?? null }}">
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis
                                        Kelamin</label>
                                    <select name="jenis_kelamin" id="jenis_kelamin"
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required disabled>
                                        <option value="" disabled selected>Pilih jenis kelamin</option>
                                        <option value="Laki-Laki"
                                            {{ isset($student) && $student->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="Perempuan"
                                            {{ isset($student) && $student->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="kelas"
                                        class="block text-sm font-medium text-gray-700">Kelas</label>
                                    <select name="kelas" id="kelas" disabled
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                        <option value="" disabled selected>Pilih kelas</option>
                                        @foreach (['X 1','X 2','X 3','XI 1', 'XI 2','XI 3', 'XII 1','XII 2','XII 3'] as $kelas)
                                            <option value="{{ $kelas }}"
                                                {{ isset($student) && str_replace('\r', '', $student->kelas) == $kelas ? 'selected' : '' }}>
                                                {{ $kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="umur" class="block text-sm font-medium text-gray-700">Umur</label>
                                    <select name="umur" id="umur"
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                        <option value="" disabled selected>Pilih umur</option>
                                        @foreach (range(15, 18) as $umur)
                                            <option value="{{ $umur }}">{{ $umur }} tahun</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="insiden" class="block text-sm font-medium text-gray-700">Insiden Yang
                                        Dialami</label>
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
                                                'PSO' => 'Mengirim pesan berbau seksual',
                                            ];
                                        @endphp
                                        @foreach ($insiden as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi
                                        Kejadian</label>
                                    <select name="lokasi" id="lokasi"
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                        @php
                                            $lokasi = [
                                                'Kelas',
                                                'Media sosial',
                                                'Koridor sekolah',
                                                'Kantin',
                                                'Toilet',
                                                'Lapangan',
                                            ];
                                        @endphp
                                        @foreach ($lokasi as $lok)
                                            <option value="{{ $lok }}">{{ ucfirst($lok) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Kolom Kanan --}}
                            <div class="space-y-4">
                                <div class="form-group">
                                    <label for="frekuensi" class="block text-sm font-medium text-gray-700">Frekuensi
                                        Kejadian</label>
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
                                    <label for="insiden_langsung" class="block text-sm font-medium text-gray-700">Insiden
                                        terjadi langsung atau tidak langsung?</label>
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
                                    <label for="siapa_pelaku" class="block text-sm font-medium text-gray-700">Siapa Pelaku
                                        Insiden?</label>
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
                                    <label for="jenis_kelamin_pelaku"
                                        class="block text-sm font-medium text-gray-700">Jenis Kelamin Pelaku</label>
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
                                    <label for="dampak_psikologis" class="block text-sm font-medium text-gray-700">Dampak
                                        Psikologis Yang Dirasakan</label>
                                    <select name="dampak_psikologis" id="dampak_psikologis"
                                        class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        required>
                                        <option value="" disabled selected>Pilih dampak psikologis</option>
                                        <option value="rendah">Rendah (contoh: merasa terganggu sesaat)</option>
                                        <option value="sedang">Sedang (contoh: merasa tertekan beberapa hari)</option>
                                        <option value="tinggi">Tinggi (contoh: berdampak pada kesehatan mental jangka
                                            panjang)</option>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const button = $('#cariNIS');

            button.on('click', function() {
                const nis = $('#nis_lookup').val(); // Get the value inside the event handler
                window.location.href = 'clasification?nis=' + encodeURIComponent(nis); // Correct assignment
            });
        });
    </script>
@endpush
