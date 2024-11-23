<div class="modal-header">
    <h5 class="modal-title">Edit Produk</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <form id="formEdit" action="{{ route('admin.manage-produk.update', $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <!-- Name Input -->
            <div class="row mb-3">
                <label class="col-form-label col-lg-3">Name</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" value="{{ $data->name }}" name="name" placeholder="Enter your produkname...">
                </div>
            </div>

            <!-- Kategori Input -->
            <div class="row mb-3" id="role">
                <label class="col-form-label col-lg-3" for="kategori">Pilih Kategori</label>
                <div class="col-lg-9">
                    <select class="form-control" name="kategori" id="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="makanan" {{ $data->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                        <option value="minuman" {{ $data->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
                        <option value="perabotan" {{ $data->kategori == 'perabotan' ? 'selected' : '' }}>Perabotan</option>
                        <option value="lain-lain" {{ $data->kategori == 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('formEdit').addEventListener('submit', function(event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);
        const url = form.action;

        fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.errors) {
                    let errorMessages = '';
                    for (const [field, messages] of Object.entries(data.errors)) {
                        errorMessages += messages.join('<br>') + '<br>';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        html: errorMessages
                    });
                } else if (!data.status) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then(() => {
                        location.reload();
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            });
    });
</script>
