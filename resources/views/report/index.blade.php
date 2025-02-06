@extends('layouts.app')

@section('title', 'Report')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <table id="studentTable" class="w-full mt-4 border-collapse border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">NIS</th>
                        <th class="border p-2 text-left">Nama</th>
                        <th class="border p-2 text-left">Jenis Kelamin</th>
                        <th class="border p-2 text-left">Kelas</th>
                        <th class="border p-2 text-left">Hasil</th>
                        <th class="border p-2 text-left">Score</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.tailwindcss.min.js"></script>

    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('report') }}",
                dom: 'Bfrtip', // Menampilkan tombol export
                buttons: [{
                    extend: 'pdfHtml5',
                    text: 'Export PDF',
                    className: 'bg-red-500 text-white px-4 py-2 rounded', // Styling tombol
                    title: 'Laporan Siswa', // Judul PDF
                    orientation: 'landscape', // Orientasi PDF
                    pageSize: 'A4', // Ukuran kertas
                    exportOptions: {
                        columns: ':visible' // Ekspor hanya kolom yang terlihat
                    },
                }],
                columns: [{
                        data: 'student.nis',
                        name: 'student.nis',
                        class: '!p-3'
                    },
                    {
                        data: 'student.name',
                        name: 'student.name',
                        class: '!p-3'
                    },
                    {
                        data: 'student.jenis_kelamin',
                        name: 'student.jenis_kelamin',
                        class: '!p-3'
                    },
                    {
                        data: 'student.kelas',
                        name: 'student.kelas',
                        class: '!p-3'
                    },
                    {
                        data: 'result',
                        name: 'result',
                        class: '!p-3'
                    },
                    {
                        data: 'score',
                        name: 'score',
                        class: '!p-3'
                    },
                ],
            });
        });
    </script>
@endpush
