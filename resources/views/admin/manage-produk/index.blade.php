@extends('layouts.app')
@section('title', 'Manage Produk')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Produk</h5>
            <button type="button" onclick="create()" class="btn btn-primary">Tambah Produk</button>
        </div>
        <div class="card-body custom-card-action p-3">
            <div class="table-responsive">
                <table class="table datatable-basic" id="data-table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div id="modal-ce" class="modal modal-lg fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content" id="content-modal-ce">
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/tables/datatables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadDataTable();
        });

        function loadDataTable() {
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().clear().destroy();
            }

            $.ajax({
                type: "GET",
                url: "{{ route('admin.manage-produk.data') }}",
                dataType: "json",
                success: function(data) {
                    if (Array.isArray(data.results)) {
                        $('#data-table').DataTable({
                            data: data.results,
                            columns: [{
                                    data: null,
                                    title: 'ID',
                                    render: function(data, type, row, meta) {
                                        return meta.row + 1;
                                    },
                                    orderable: false,
                                    searchable: false
                                },
                                {
                                    data: 'name',
                                    title: 'Nama'
                                },
                                {
                                    data: null,
                                    title: 'Gambar',
                                    render: function(data, type, row) {
                                        const gambarPath = row.gambar ?
                                            `{{ asset('storage/produk') }}/${row.gambar}` : 'https://via.placeholder.com/100';
                                        return `<img src="${gambarPath}" width="100" height="100" alt="Gambar Produk">`;
                                    }
                                },
                                {
                                    data: 'kategori',
                                    title: 'Kategori'
                                },
                                {
                                    data: null,
                                    title: 'Aksi',
                                    render: function(data, type, row) {
                                        return `
                                    <button onclick="edit('${row.id}')" class="btn btn-sm btn-warning"><i class="ph-pencil-line"></i></button>
                                    <button onclick="deleteProduk('${row.id}')" class="btn btn-sm btn-danger"><i class="ph-trash"></i></button>
                                `;
                                    },
                                    orderable: false,
                                    searchable: false
                                }
                            ],
                            pageLength: 10,
                            processing: true,
                            deferRender: true,
                            dom: 'Bfrtip',
                            language: {
                                search: "Cari:<span class='text-muted ms-2'>_INPUT_</span>",
                                lengthMenu: "Tampilkan _MENU_ entri per halaman",
                                info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                                paginate: {
                                    previous: "Sebelumnya",
                                    next: "Berikutnya"
                                }
                            }
                        });
                    } else {
                        alert("Data tidak valid. Silakan coba lagi.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert('Gagal memuat data. Silakan coba lagi. Kesalahan: ' + error);
                }
            });
        }

        function create() {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.manage-produk.create') }}",
                dataType: "html",
                success: function(data) {
                    $('#content-modal-ce').html(data);
                    $('#modal-ce').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert('Gagal memuat data. Silakan coba lagi. Kesalahan: ' + error);
                }
            });
        }

        function edit(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('admin.manage-produk.edit', ':id') }}".replace(':id', id),
                dataType: "html",
                success: function(data) {
                    $('#content-modal-ce').html(data);
                    $('#modal-ce').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error:", xhr.responseText);
                    alert('Gagal memuat data. Silakan coba lagi. Kesalahan: ' + error);
                }
            });
        }
    </script>
@endsection
