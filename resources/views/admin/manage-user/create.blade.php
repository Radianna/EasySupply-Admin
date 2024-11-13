<div class="modal-header">
    <h5 class="modal-title">Create User</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form id="createUserForm">
        <div class="mb-4">
            <!-- Name Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="name" placeholder="Enter your username...">
                </div>
            </div>

            <!-- Role Input -->
            <div class="row mb-3" id="role">
                <label class="col-form-label col-lg-3" for="role_id">Pilih Role</label>
                <div class="col-lg-9">
                    <select class="form-control select2" name="role_id" id="role_id">
                        <option value="">Pilih Role</option>
                    </select>
                </div>
            </div>

            <!-- Email Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Email</label>
                <div class="col-lg-9">
                    <input type="email" class="form-control" name="email" placeholder="Enter your email...">
                </div>
            </div>

            <!-- Kontak Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Kontak</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" name="kontak" placeholder="Enter your kontak...">
                </div>
            </div>

            <!-- Alamat Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Alamat</label>
                <div class="col-lg-9">
                    <textarea class="form-control" name="alamat" placeholder="Enter your address..."></textarea>
                </div>
            </div>

            <!-- Password Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Password</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" name="password" placeholder="Enter password...">
                </div>
            </div>

            <!-- Confirm Password Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Confirm Password</label>
                <div class="col-lg-9">
                    <input type="password" class="form-control" name="password2" placeholder="Confirm password...">
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
        // Initialize Select2 for Role selection
        $('#role_id').select2({
            width: '100%',
            dropdownParent: $("#role"),
            minimumResultsForSearch: Infinity,
            ajax: {
                url: "{{ route('admin.manage-role.data') }}",
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    if (!data || !data.results) {
                        return { results: [] };
                    }

                    return {
                        results: data.results.map(item => ({
                            id: item.id,
                            text: item.name
                        }))
                    };
                },
                cache: true
            }
        });

        // Hide search input in dropdown
        $('#role').on('select2:open', function() {
            $('.select2-search--dropdown').hide();
        });

        // Handle form submission
        $('#createUserForm').on('submit', function(e) {
            e.preventDefault();

            // Show spinner on submit button
            const btnSubmit = $('#btnSubmit');
            btnSubmit.prop('disabled', true);
            btnSubmit.find('.spinner-border').removeClass('d-none');

            $.ajax({
                type: "POST",
                url: "{{ route('admin.manage-user.store') }}",
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
                        $('#createUserForm')[0].reset();
                        $('#role_id').val(null).trigger('change');
                        $('#data-table').DataTable().ajax.reload(); // Reload DataTable
                        $('#createUserModal').modal('hide');
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
