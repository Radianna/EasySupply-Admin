@extends('layouts.app')
@section('title', 'Manage User')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengguna</h5>
            <button type="button" onclick="create()" class="btn btn-primary">Tambah Pengguna</button>
        </div>
        <div class="card-body custom-card-action p-3">
            <div class="table-responsive">
                <table class="table datatable-basic" id="data-table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Alamat</th>
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
    // Destroy existing DataTable instance if it exists
    if ($.fn.DataTable.isDataTable('#data-table')) {
        $('#data-table').DataTable().clear().destroy();
    }

    $.ajax({
        type: "GET",
        url: "{{ route('admin.manage-user.data') }}",
        dataType: "json",
        success: function(data) {
            // Ensure 'data' is an array
            if (Array.isArray(data)) {
                $('#data-table').DataTable({
                    data: data,
                    columns: [
                        {
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
                            data: 'email',
                            title: 'Email'
                        },
                        {
                            data: 'roles.name', // Use dot notation for nested property
                            title: 'Role',
                            defaultContent: '-'
                        },
                        {
                            data: 'alamat',
                            title: 'Alamat'
                        },
                        {
                            data: null,
                            title: 'Aksi',
                            render: function(data, type, row) {
                                let editUrl = `{{ url('admin/manage-user') }}/${row.id}/edit`;
                                return `
                                    <a href="${editUrl}" class="btn btn-sm btn-primary">Edit</a>
                                    <button onclick="deleteUser('${row.id}')" class="btn btn-sm btn-danger">Hapus</button>
                                `;
                            }
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
                url: "{{ route('admin.manage-user.create') }}",
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
