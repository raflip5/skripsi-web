@extends('layouts.app')

@section('title', 'Manajemen Siswa')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
@endsection

@section('content')
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Manajemen Data Siswa</h1>
            <p class="text-gray-600">Kelola informasi siswa dengan mudah dan efisien</p>
        </div>

        <!-- Student List Card -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-2">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Daftar Siswa</h2>
                            <p class="text-sm text-gray-500">Total: <span id="totalStudents">0</span> siswa</p>
                        </div>
                    </div>
                    <a href="{{ route('siswa.create') }}" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Siswa Baru
                    </a>
                </div>
            </div>

            <!-- Filters and Table -->
            <div class="p-6 space-y-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="searchInput" 
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Cari siswa...">
                    </div>
                    <select id="kelasFilter" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Kelas</option>
                        <option value="X">Kelas X</option>
                        <option value="XI">Kelas XI</option>
                        <option value="XII">Kelas XII</option>
                    </select>
                    <select id="jenisKelaminFilter" class="block w-full pl-3 pr-10 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <table id="studentTable" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- DataTables will populate this -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            var table = $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('siswa.index') }}",
                language: {
                    processing: '<div class="flex justify-center items-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div></div>',
                    search: '',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ data',
                    paginate: {
                        first: 'Pertama',
                        last: 'Terakhir',
                        next: 'Selanjutnya',
                        previous: 'Sebelumnya'
                    }
                },
                columns: [
                    {
                        data: 'nis',
                        name: 'nis',
                        class: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        class: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900',
                    },
                    {
                        data: 'jenis_kelamin',
                        name: 'jenis_kelamin',
                        class: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900',
                    },
                    {
                        data: 'kelas',
                        name: 'kelas',
                        class: 'px-6 py-4 whitespace-nowrap text-sm text-gray-900',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        class: 'px-6 py-4 whitespace-nowrap text-sm text-gray-500',
                        render: function(data, type, row) {
                            return `
                                <div class="flex space-x-2">
                                    <a href="/siswa/${row.id}/edit" class="text-white bg-blue-500 hover:bg-blue-600 rounded-md px-3 py-1.5 text-sm transition-colors duration-200 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <button onclick="deleteStudent(${row.id})" class="text-white bg-red-500 hover:bg-red-600 px-3 py-1.5 rounded-md text-sm transition-colors duration-200 inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            `;
                        }
                    }
                ],
                drawCallback: function(settings) {
                    // Update total students count
                    $('#totalStudents').text(settings._iRecordsTotal);
                    
                    // Style pagination
                    $('.dataTables_paginate').addClass('flex flex-wrap justify-center md:justify-end gap-2 mt-4');
                    $('.dataTables_paginate .paginate_button').addClass('px-2 sm:px-3 py-1 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md text-sm sm:text-base transition-colors duration-200');
                    $('.dataTables_paginate .paginate_button.current').addClass('bg-blue-50 border-blue-500 text-blue-600 font-medium');
                    $('.dataTables_paginate .paginate_button.disabled').addClass('opacity-50 cursor-not-allowed');
                    
                    // Custom text for previous and next buttons
                    $('.dataTables_paginate .previous').html('‹');
                    $('.dataTables_paginate .next').html('›');
                    
                    // Add responsive margin and sizing
                    $('.dataTables_wrapper').addClass('sm:px-2');
                    $('.dataTables_paginate').addClass('sm:px-2');
                }
            });

            // Connect search input to DataTables
            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Connect filters to DataTables
            $('#kelasFilter, #jenisKelaminFilter').on('change', function() {
                table.draw();
            });
        });

        function deleteStudent(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data siswa ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/siswa/${id}`,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            $('#studentTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Terhapus!',
                                'Data siswa berhasil dihapus.',
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush