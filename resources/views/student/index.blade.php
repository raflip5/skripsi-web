@extends('layouts.app')

@section('title', 'Student')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
            <div class="mb-4">
                <a href="{{ route('siswa.create') }}"
                    class="inline-block rounded-md text-white px-4 py-2 bg-blue-500 hover:bg-blue-600 transition-colors">
                    Tambah Siswa
                </a>
            </div>

            <table id="studentTable" class="w-full mt-4 border-collapse border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">NIS</th>
                        <th class="border p-2 text-left">Nama</th>
                        <th class="border p-2 text-left">Jenis Kelamin</th>
                        <th class="border p-2 text-left">Kelas</th>
                        <th class="border p-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be populated by DataTables -->
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

    <script>
        $(document).ready(function() {
            $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siswa.index') }}",
                columns: [{
                        data: 'nis',
                        name: 'nis',
                        class: '!p-3',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        class: '!p-3',
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        class: '!p-3',
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                        class: '!p-3',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <div class="flex space-x-2">
                                    <a href="/siswa/${row.id}/edit" class="text-white bg-blue-500 rounded-md px-2 py-1 hover:text-blue-700">
                                        Edit
                                    </a>
                                    <button onclick="deleteStudent(${row.id})" class="text-white bg-red-500 px-2 py-1 rounded-md hover:text-red-700">
                                        Delete
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
            });
        });

        function deleteStudent(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data siswa ini?')) {
                $.ajax({
                    url: `/siswa/${id}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#studentTable').DataTable().ajax.reload();
                    }
                });
            }
        }
    </script>
@endpush
