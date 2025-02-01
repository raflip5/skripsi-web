@extends('layouts.app')

@section('title', 'Klasifikasi')

@section('content')
<div class="lg:w-1/2 bg-white border-r-2 border-l-2 min-h-screen mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-6">Form Klasifikasi C4.5</h1>
    
    <hr class="border-2">

    <form action="" method="POST" class="mt-4">
        @csrf

        <div class="flex flex-col space-y-4 mb-4">
            <div class="flex flex-col">
                <label for="nama" class="font-semibold text-sm mb-1">Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Masukkan nama lengkap" class="px-4 py-2 border outline-none">
            </div>

            <div class="flex flex-col">
                <label for="jenis_kelamin" class="font-semibold text-sm mb-1">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih jenis kelamin</option>
                    <option value="L">Laki - Laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="kelas" class="font-semibold text-sm mb-1">Kelas</label>
                <select name="kelas" id="kelas" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih kelas</option>
                    <option value="X">X</option>
                    <option value="XI">XI</option>
                    <option value="XII">XII</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="umur" class="font-semibold text-sm mb-1">Umur</label>
                <select name="umur" id="umur" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih umur</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="insiden" class="font-semibold text-sm mb-1">Insiden Yang Dialami</label>
                <select name="insiden" id="insiden" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih insiden</option>
                    <option value="BV">Diejek, dihina, diberi julukan negatif</option>
                    <option value="BS">Dikucilkan, dirumorkan yang jelek, memengaruhi orang lain</option>
                    <option value="BF">Dipukul,ditendang,didorong,dirampas barang anda</option>
                    <option value="PSV">Dikommentari seksual, dicatcalling, dilecehkan secara verbal</option>
                    <option value="PSNV">Gestur tidak pantas, menatap dengan maksud tertentu</option>
                    <option value="PSF">Menyentuh , memegang, atau memeluk tanpa izin dan bersifat melecehkan</option>
                    <option value="PSO">Mengirim pesan teks, gambar, atau video seksual melalui media sosial</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="kejadian" class="font-semibold text-sm mb-1">Apakah insiden itu terjadi secara langsung, tidak langsung, atau online?</label>
                <select name="kejadian" id="kejadian" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih insiden kejadian</option>
                    <option value="Langsung">Langsung</option>
                    <option value="Tidak Langsung">Tidak Langsung</option>
                    <option value="Online">Online</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="pelaku" class="font-semibold text-sm mb-1">Pelaku</label>
                <select name="pelaku" id="pelaku" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih pelaku</option>
                    <option value="Teman Sebaya">Teman Sebaya</option>
                    <option value="Senior">Senior</option>
                    <option value="Guru/Staff">Guru/Staff</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="jk_pelaku" class="font-semibold text-sm mb-1">Jenis Kelamin Pelaku</label>
                <select name="jk_pelaku" id="jk_pelaku" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih jenis kelamin pelaku</option>
                    <option value="L">Laki-Laki</option>
                    <option value="P">Perempuan</option>
                    <option value="C">Campuran</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="lokasi_kejadian" class="font-semibold text-sm mb-1">Lokasi Kejadian</label>
                <select name="lokasi_kejadian" id="lokasi_kejadian" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih lokasi kejadian</option>
                    <option value="Kelas">Kelas</option>
                    <option value="Media Sosial">Media Sosial</option>
                    <option value="Koridor Sekolah">Koridor Sekolah</option>
                    <option value="Kantin">Kantin</option>
                    <option value="Toilet">Toilet</option>
                    <option value="Lapangan">Lapangan</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="frekuensi_kejadian" class="font-semibold text-sm mb-1">Frekuensi Kejadian</label>
                <select name="frekuensi_kejadian" id="frekuensi_kejadian" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih frekuensi kejadian</option>
                    <option value="Jarang">1-3 kali</option>
                    <option value="Kadang-kadang">3-7 kali</option>
                    <option value="Sering">> 7 kali</option>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="dampak_psikologis" class="font-semibold text-sm mb-1">Dampak Psikologis</label>
                <select name="dampak_psikologis" id="dampak_psikologis" class="px-4 py-2 border outline-none">
                    <option value="" disabled selected>Pilih dampak psikologis</option>
                    <option value="Rendah">Merasa terganggu sesaat</option>
                    <option value="Sedang">Merasa tertekan beberapa hari</option>
                    <option value="Tinggi">Berdampak pada kesehatan mental dalam jangka panjang</option>
                </select>
            </div>
        </div>

        <button class="px-4 py-2 w-full bg-blue-500 rounded text-white font-semibold">Klasifikasi</button>
    </form>
</div>
@endsection

@push('scripts')
    
@endpush