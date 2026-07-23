<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #312e81; font-weight: 700;">
                        <i class="fas fa-user-shield mr-2" style="color: #f59e0b;"></i>Manajemen User Admin
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Super Admin</a></li>
                        <li class="breadcrumb-item active">User Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card" style="border-radius: 14px; border: none;
                                     box-shadow: 0 4px 20px rgba(0,0,0,0.07); overflow: hidden;">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center py-3"
                     style="background: linear-gradient(135deg, #312e81, #4338ca); border:none;">
                    <h5 class="m-0 text-white font-weight-bold">
                        <i class="fas fa-list mr-2"></i>Daftar User Admin
                    </h5>
                    <button id="btn-add-admin" class="btn btn-super-add btn-sm" onclick="openModalAddAdmin()">
                        <i class="fas fa-plus mr-1"></i> Tambah Admin Baru
                    </button>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Legend -->
                    <div class="alert" style="background: #eef2ff; border:none; border-left: 4px solid #4338ca;
                                              border-radius: 8px; padding: 12px 16px;" role="alert">
                        <i class="fas fa-info-circle mr-2" style="color:#4338ca;"></i>
                        <strong>Keterangan:</strong>
                        Admin yang berstatus <span class="badge badge-warning text-dark">Pernah Menjawab</span>
                        <strong>tidak dapat dihapus</strong> demi menjaga integritas data permohonan.
                        Anda tetap dapat menonaktifkan akunnya.
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="tbl-admin" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th width="120">Status</th>
                                    <th width="180">Riwayat</th>
                                    <th width="200" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- /.content-wrapper -->

<!-- Modal Tambah Admin -->
<div class="modal fade" id="modal-add-admin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="modal-add-admin-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<!-- Modal Akses Menu Admin -->
<div class="modal fade" id="modal-akses-menu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-akses-menu-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    // ── Initialize DataTable ──────────────────────────────────────
    var table = $('#tbl-admin').DataTable({
        ajax: {
            url: '{{ route("super_admin.list_admin") }}',
            type: 'GET'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3, orderable: false },
            { data: 4, orderable: false },
            {
                data: 5,
                orderable: false,
                className: 'text-center',
                render: function(data) {
                    var parts      = data.split('|');
                    var id         = parts[0];
                    var sudahJawab = parts[1] === '1';
                    var status     = parts[2];
                    var isActive   = status === '1';

                    // Toggle button
                    var toggleBtn = isActive
                        ? '<button class="btn btn-warning btn-xs mr-1 mb-1" onclick="toggleStatusAdmin(' + id + ', this)" title="Nonaktifkan">'
                          + '<i class="fas fa-toggle-on"></i></button>'
                        : '<button class="btn btn-success btn-xs mr-1 mb-1" onclick="toggleStatusAdmin(' + id + ', this)" title="Aktifkan">'
                          + '<i class="fas fa-toggle-off"></i></button>';

                    // Atur Akses Menu button
                    var aksesBtn = '<button class="btn btn-info btn-xs mr-1 mb-1" onclick="openModalAksesAdmin(' + id + ')" title="Atur Akses Menu">'
                                 + '<i class="fas fa-key"></i></button>';

                    // Hapus button — disabled jika sudah jawab permohonan
                    var deleteBtn = sudahJawab
                        ? '<button class="btn btn-secondary btn-xs mb-1" disabled title="Tidak dapat dihapus (pernah menjawab permohonan)">'
                          + '<i class="fas fa-lock"></i></button>'
                        : '<button class="btn btn-danger btn-xs mb-1" onclick="deleteAdmin(' + id + ')" title="Hapus">'
                          + '<i class="fas fa-trash"></i></button>';

                    return '<div class="d-flex flex-wrap justify-content-center">' + toggleBtn + aksesBtn + deleteBtn + '</div>';
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        responsive: true,
        pageLength: 10,
    });

    window.tableAdmin = table;

    // ── Open Modal Add Admin ──────────────────────────────────────
    window.openModalAddAdmin = function() {
        $.post('{{ route("super_admin.getModalAddAdmin") }}', function(html) {
            $('#modal-add-admin-content').html(html);
            $('#modal-add-admin').modal('show');
        });
    };

    // ── Open Modal Akses Menu Admin ───────────────────────────────
    window.openModalAksesAdmin = function(id) {
        $.post('{{ route("super_admin.getModalAksesAdmin") }}', { id: id }, function(html) {
            $('#modal-akses-menu-content').html(html);
            $('#modal-akses-menu').modal('show');
        });
    };

    // ── Toggle Status Admin ───────────────────────────────────────
    window.toggleStatusAdmin = function(id, btn) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Ubah status akun admin ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4338ca',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal',
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post('{{ route("super_admin.toggle_status_admin") }}', { id: id }, function(res) {
                    if (res.status) {
                        toastr.success(res.msg);
                        table.ajax.reload(null, false);
                    } else {
                        toastr.error(res.msg);
                    }
                });
            }
        });
    };

    // ── Delete Admin ──────────────────────────────────────────────
    window.deleteAdmin = function(id) {
        Swal.fire({
            title: 'Hapus Admin?',
            text: 'Tindakan ini tidak dapat dibatalkan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post('{{ route("super_admin.delete_admin") }}', { id: id }, function(res) {
                    if (res.status) {
                        toastr.success(res.msg);
                        table.ajax.reload(null, false);
                    } else {
                        Swal.fire('Gagal!', res.msg, 'error');
                    }
                });
            }
        });
    };

});
</script>
