@extends('layouts.app')

@section('title', 'Data Latih')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.tailwindcss.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-8 px-4">
        <div class="container mx-auto">
            <div class="bg-white shadow-2xl rounded-xl overflow-hidden">
                <!-- Enhanced Header Section -->
                <div class="p-8 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-extrabold text-blue-800 tracking-tight">Data Latih</h2>
                            <p class="mt-2 text-blue-600 text-sm">Data latih algoritma C45</p>
                        </div>
                    </div>
                </div>
                
                <!-- Table Section -->
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table id="studentTable" class="w-full border-collapse">
                            <thead>
                                <tr class="bg-blue-50 text-blue-700 uppercase text-sm">
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">JK Korban</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Kelas</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Umur</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Insiden</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Lokasi</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Frekuensi</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Insiden Kejadian</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Pelaku</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">JK Pelaku</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Dampak Psikologis</th>
                                    <th class="px-4 py-3 text-left border-b border-blue-200 font-semibold">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables akan mengisi -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Section Moved to Bottom -->
                    <div class="mt-6 flex justify-between items-center border-t border-gray-200 pt-4">
                        <div id="pageInfo" class="text-gray-600 text-sm"></div>
                        <div class="flex space-x-2">
                            <button id="prevPage" class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Sebelumnya
                            </button>
                            <button id="nextPage" class="bg-white border border-blue-600 text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                                Selanjutnya
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.tailwindcss.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            const table = $('#studentTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 4,
                ajax: {
                    url: "{{ route('data.training') }}",
                    type: 'GET'
                },
                dom: 'frtip',
                columns: [
                    { 
                        data: 'student.jenis_kelamin', 
                        name: 'student.jenis_kelamin',
                        render: function(data) {
                            return data === 'L' ? 'Laki-laki' : 
                                   data === 'P' ? 'Perempuan' : 
                                   data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'student.kelas', 
                        name: 'student.kelas',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'umur', 
                        name: 'umur',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'insiden', 
                        name: 'insiden',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'lokasi', 
                        name: 'lokasi',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'frekuensi', 
                        name: 'frekuensi',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'insiden_kejadian', 
                        name: 'insiden_kejadian',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'pelaku', 
                        name: 'pelaku',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'jenis_kelamin_pelaku', 
                        name: 'jenis_kelamin_pelaku',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'dampak', 
                        name: 'dampak',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    { 
                        data: 'hasil', 
                        name: 'hasil',
                        render: function(data) {
                            return data || '-';
                        },
                        className: 'px-4 py-3 text-sm border-b border-gray-100'
                    },
                    
                ],
                language: {
                    processing: '<div class="flex justify-center"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div></div>',
                    zeroRecords: 'Tidak ada data yang cocok',
                },
                drawCallback: function() {
                    updatePageInfo();
                }
            });

            // Previous and Next page buttons
            $('#prevPage').on('click', function() {
                table.page('previous').draw('page');
            });

            $('#nextPage').on('click', function() {
                table.page('next').draw('page');
            });

            // Update page information
            function updatePageInfo() {
                const info = table.page.info();
                $('#pageInfo').html(`<span class="font-medium">Halaman ${info.page + 1}</span> dari <span class="font-medium">${info.pages}</span>`);
                
                // Update button states
                $('#prevPage').prop('disabled', !table.page.info().page);
                $('#nextPage').prop('disabled', table.page.info().page >= table.page.info().pages - 1);
                
                // Update button styles based on state
                if (!table.page.info().page) {
                    $('#prevPage').addClass('opacity-50 cursor-not-allowed');
                } else {
                    $('#prevPage').removeClass('opacity-50 cursor-not-allowed');
                }
                
                if (table.page.info().page >= table.page.info().pages - 1) {
                    $('#nextPage').addClass('opacity-50 cursor-not-allowed');
                } else {
                    $('#nextPage').removeClass('opacity-50 cursor-not-allowed');
                }
            }

            // Filter button with enhanced modal
            $('#filterBtn').on('click', function() {
                Swal.fire({
                    title: 'Filter Data',
                    html: `
                        <div class="space-y-4">
                            <div class="text-left">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas</label>
                                <select id="kelasFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Kelas</option>
                                    <option value="X1">Kelas X1</option>
                                    <option value="X2">Kelas X2</option>
                                    <option value="XI">Kelas XI</option>
                                    <option value="XII">Kelas XII</option>
                                </select>
                            </div>
                            <div class="text-left">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select id="jenisKelaminFilter" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Semua Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Terapkan Filter',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3b82f6',
                    cancelButtonColor: '#6b7280',
                    customClass: {
                        container: 'custom-swal-container',
                        popup: 'custom-swal-popup',
                        confirmButton: 'bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-all duration-200',
                        cancelButton: 'bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-all duration-200'
                    },
                    focusConfirm: false,
                    preConfirm: () => {
                        const kelas = document.getElementById('kelasFilter').value;
                        const jenisKelamin = document.getElementById('jenisKelaminFilter').value;
                        
                        table.column(3).search(kelas).column(2).search(jenisKelamin).draw();
                    }
                });
            });
        });
    </script>
@endpush