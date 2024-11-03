@extends('layouts.app')
@section('title', 'Manage User')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="search">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
                <div class="col">
                    <div class="float-end">
                        <a href="{{ route('admin.manage-user.create') }}" class="btn btn-primary">Add User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Eugene</td>
                        <td>Kopyov</td>
                        <td>@Kopyov</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Victoria</td>
                        <td>Baker</td>
                        <td>@Vicky</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>James</td>
                        <td>Alexander</td>
                        <td>@Alex</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Franklin</td>
                        <td>Morrison</td>
                        <td>@Frank</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadDataTable();
    
            // Fungsi pencarian
            $('input[name="search"]').on('keyup', function() {
                loadDataTable($(this).val());
            });
        });
    
        function loadDataTable(keyword = '') {
            // Hancurkan instance DataTable sebelumnya jika ada
            if ($.fn.DataTable.isDataTable('#data-table')) {
                $('#data-table').DataTable().clear().destroy();
            }
    
            $.ajax({
                type: "GET",
                url: "{{ route('admin.manage-user.data') }}",
                data: { search: keyword },  // Kirim keyword untuk filter sisi server
                dataType: "json",
                success: function(data) {
                    $('#data-table').DataTable({
                        data: data,
                        columns: [
                            { data: 'id', title: 'ID' },
                            { data: 'name', title: 'Nama' },
                            { data: 'username', title: 'Username' },
                            { data: 'email', title: 'Email' }
                        ],
                        pageLength: 10,  // Menetapkan jumlah data per halaman
                        processing: true,  // Menampilkan indikator pemrosesan
                        deferRender: true  // Meningkatkan rendering untuk data besar
                    });
                },
                error: function() {
                    alert('Gagal memuat data. Silakan coba lagi.');
                }
            });
        }
    </script>
    @endsection
