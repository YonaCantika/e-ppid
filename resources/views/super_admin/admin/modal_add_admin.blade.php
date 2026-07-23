<div class="modal-header" style="background: linear-gradient(135deg, #312e81, #4338ca); border:none;">
    <h5 class="modal-title text-white font-weight-bold">
        <i class="fas fa-user-plus mr-2"></i>Tambah User Admin Baru
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-add-admin">
        @csrf
        <!-- Nama -->
        <div class="form-group">
            <label for="admin-name" style="color:#312e81; font-weight:600;">
                <i class="fas fa-user mr-1"></i>Nama Lengkap <span class="text-danger">*</span>
            </label>
            <input type="text" id="admin-name" name="name" class="form-control"
                   placeholder="Masukkan nama lengkap..."
                   style="border-radius:8px; border: 1.5px solid #e0e7ff;" required>
            <div class="invalid-feedback" id="err-name"></div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="admin-email" style="color:#312e81; font-weight:600;">
                <i class="fas fa-envelope mr-1"></i>Email <span class="text-danger">*</span>
            </label>
            <input type="email" id="admin-email" name="email" class="form-control"
                   placeholder="Masukkan alamat email..."
                   style="border-radius:8px; border: 1.5px solid #e0e7ff;" required>
            <div class="invalid-feedback" id="err-email"></div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="admin-password" style="color:#312e81; font-weight:600;">
                <i class="fas fa-lock mr-1"></i>Password <span class="text-danger">*</span>
            </label>
            <div class="input-group">
                <input type="password" id="admin-password" name="password" class="form-control"
                       placeholder="Minimal 6 karakter..."
                       style="border-radius:8px 0 0 8px; border: 1.5px solid #e0e7ff;" required minlength="6">
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary"
                            style="border-radius: 0 8px 8px 0;"
                            onclick="togglePasswordVisibility()">
                        <i class="fas fa-eye" id="icon-pw"></i>
                    </button>
                </div>
            </div>
            <small class="text-muted">Minimal 6 karakter.</small>
            <div class="invalid-feedback" id="err-password"></div>
        </div>

        <div class="alert" style="background:#fef3c7; border:none; border-left:4px solid #f59e0b;
                                   border-radius:8px; padding: 10px 14px; font-size:0.85rem;">
            <i class="fas fa-info-circle mr-1" style="color:#d97706;"></i>
            Admin baru akan dibuat dengan <strong>status Aktif</strong> dan role <strong>Admin</strong>.
        </div>
    </form>
</div>
<div class="modal-footer" style="border-top: 1px solid #e0e7ff;">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:8px;">
        <i class="fas fa-times mr-1"></i>Batal
    </button>
    <button type="button" id="btn-submit-add-admin" class="btn btn-super-add" onclick="submitAddAdmin()">
        <i class="fas fa-save mr-1"></i>Simpan Admin
    </button>
</div>

<script>
function togglePasswordVisibility() {
    var pw = document.getElementById('admin-password');
    var icon = document.getElementById('icon-pw');
    if (pw.type === 'password') {
        pw.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        pw.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

function submitAddAdmin() {
    // Reset validation
    $('#admin-name, #admin-email, #admin-password').removeClass('is-invalid');

    var name     = $('#admin-name').val().trim();
    var email    = $('#admin-email').val().trim();
    var password = $('#admin-password').val();

    var valid = true;
    if (!name) { $('#admin-name').addClass('is-invalid'); $('#err-name').text('Nama wajib diisi.'); valid = false; }
    if (!email) { $('#admin-email').addClass('is-invalid'); $('#err-email').text('Email wajib diisi.'); valid = false; }
    if (password.length < 6) { $('#admin-password').addClass('is-invalid'); $('#err-password').text('Password minimal 6 karakter.'); valid = false; }
    if (!valid) return;

    $('#btn-submit-add-admin').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...');

    $.post('{{ route("super_admin.add_admin") }}', {
        name:     name,
        email:    email,
        password: password,
        _token:   $('meta[name="csrf-token"]').attr('content')
    }, function(res) {
        if (res.status) {
            $('#modal-add-admin').modal('hide');
            toastr.success(res.msg);
            if (typeof window.tableAdmin !== 'undefined') {
                window.tableAdmin.ajax.reload(null, false);
            }
        } else {
            toastr.error(res.msg || 'Gagal menyimpan.');
        }
    }).fail(function(xhr) {
        if (xhr.status === 422) {
            var errors = xhr.responseJSON.errors;
            if (errors.name)     { $('#admin-name').addClass('is-invalid');     $('#err-name').text(errors.name[0]); }
            if (errors.email)    { $('#admin-email').addClass('is-invalid');    $('#err-email').text(errors.email[0]); }
            if (errors.password) { $('#admin-password').addClass('is-invalid'); $('#err-password').text(errors.password[0]); }
        } else {
            toastr.error('Terjadi kesalahan server.');
        }
    }).always(function() {
        $('#btn-submit-add-admin').prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Simpan Admin');
    });
}
</script>
