<div class="modal-header">
    <h5 class="modal-title">Create Produk</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form id="createProdukForm">
        <div class="mb-4">
            <!-- Name Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="name" placeholder="Enter your produkname...">
                </div>
            </div>

            <!-- Kategori Input -->
            <div class="row mb-3" id="role">
                <label class="col-form-label col-lg-3" for="kategori">Pilih Kategori</label>
                <div class="col-lg-9">
                    <select class="form-control select2" name="kategori" id="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="makanan">Makanan</option>
                        <option value="minuman">Minuman</option>
                        <option value="perabotan">Perabotan</option>
                        <option value="lain-lain">Lain-lain</option>
                    </select>
                </div>
            </div>

            <!-- Gambar Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Gambar</label>
                <div class="col-lg-9">
                    <input type="file" class="form-control" name="gambar" placeholder="Enter your gambar...">
                </div>
            </div>
        </div>

        <!-- Button Submit -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="btnSubmit">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                Submit
            </button>
        </div>
    </form>
</div>

<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/vendor/forms/selects/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // Handle form submission
        $('#createProdukForm').on('submit', function(e) {
            e.preventDefault();

            // Show spinner on submit button
            const btnSubmit = $('#btnSubmit');
            btnSubmit.prop('disabled', true);
            btnSubmit.find('.spinner-border').removeClass('d-none');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.manage-produk.store') }}",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response,
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#createProdukForm')[0].reset();
                        $('#kategori').val(null).trigger('change');
                        $('#data-table').DataTable().ajax.reload(); // Reload DataTable
                        $('#createProdukModal').modal('hide');
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan. Silakan coba lagi.';
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: errorMessage,
                        showConfirmButton: true
                    });
                },
                complete: function() {
                    // Hide spinner and enable button
                    btnSubmit.prop('disabled', false);
                    btnSubmit.find('.spinner-border').addClass('d-none');
                }
            });
        });
    });
</script>
