<div class="modal-header">
    <h5 class="modal-title">Create User</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
    <div class="mb-4">
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Name</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="name" placeholder="Enter your username...">
            </div>
        </div>

        //role
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Role</label>
            <div class="col-lg-9">
                <select class="form-select" name="role">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>
        </div>
        
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Email</label>
            <div class="col-lg-9">
                <input type="email" class="form-control" name="email" placeholder="Enter your email...">
            </div>
        </div>
        
        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Kontak</label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="kontak" placeholder="Enter your kontak...">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Alamat</label>
            <div class="col-lg-9">
                <textarea type="text" class="form-control" name="alamat"></textarea>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Password</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="password" placeholder="Enter password...">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-lg-3">Confirm Password</label>
            <div class="col-lg-9">
                <input type="password" class="form-control" name="password2" placeholder="Confirm password...">
            </div>
        </div>

    </div>
</div>
