<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #312e81; font-weight: 700;">
                        <i class="fas fa-users mr-2" style="color: #f59e0b;"></i>Manajemen Akun Pemohon
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Super Admin</a></li>
                        <li class="breadcrumb-item active">Akun Pemohon</li>
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
                <div class="card-header py-3"
                     style="background: linear-gradient(135deg, #065f46, #059669); border:none;">
                    <h5 class="m-0 text-white font-weight-bold">
                        <i class="fas fa-list mr-2"></i>Daftar Akun Pemohon
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Info -->
                    <div class="alert" style="background: #ecfdf5; border:none; border-left: 4px solid #059669;
                                              border-radius: 8px; padding: 12px 16px;" role="alert">
                        <i class="fas fa-info-circle mr-2" style="color:#059669;"></i>
                        Anda dapat <strong>mengaktifkan</strong> atau <strong>menonaktifkan</strong> akun pemohon.
                        Akun yang dinonaktifkan <strong>tidak dapat login</strong> ke sistem.
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="tbl-pemohon" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telp</th>
                                    <th>Pekerjaan</th>
                                    <th width="110">Status</th>
                                    <th width="150" class="text-center">Aksi</th>
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

<!-- Modal Akses Menu Pemohon -->
<div class="modal fade" id="modal-akses-menu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-akses-menu-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    var table = $('#tbl-pemohon').DataTable({
        ajax: {
            url: '{{ route("super_admin.list_pemohon") }}',
            type: 'GET'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4 },
            { data: 5, orderable: false },
            {
                data: 6,
                orderable: false,
                className: 'text-center',
                render: function(data) {
                    var parts  = data.split('|');
                    var id     = parts[0];
                    var status = parts[1];

                    var toggleBtn = status === '1'
                        ? '<button class="btn btn-warning btn-xs mr-1" onclick="togglePemohon(' + id + ')" title="Nonaktifkan">'
                          + '<i class="fas fa-toggle-on"></i></button>'
                        : '<button class="btn btn-success btn-xs mr-1" onclick="togglePemohon(' + id + ')" title="Aktifkan">'
                          + '<i class="fas fa-toggle-off"></i></button>';

                    var aksesBtn = '<button class="btn btn-info btn-xs" onclick="openModalAksesPemohon(' + id + ')" title="Atur Akses Menu">'
                                 + '<i class="fas fa-key"></i></button>';

                    return toggleBtn + aksesBtn;
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        responsive: true,
        pageLength: 10,
    });

    window.tablePemohon = table;

    // ── Open Modal Akses Menu Pemohon ──────────────────────────
    window.openModalAksesPemohon = function(id) {
        $.post('{{ route("super_admin.getModalAksesPemohon") }}', { id: id }, function(html) {
            $('#modal-akses-menu-content').html(html);
            $('#modal-akses-menu').modal('show');
        });
    };

    // ── Toggle Status Pemohon ───────────────────────────────
    window.togglePemohon = function(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Ubah status akun pemohon ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#059669',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Ubah!',
            cancelButtonText: 'Batal',
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post('{{ route("super_admin.toggle_status_pemohon") }}', { id: id }, function(res) {
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

});
</script>
