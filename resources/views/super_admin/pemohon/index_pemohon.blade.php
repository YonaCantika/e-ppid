<style>
    /* Match Dashboard Aesthetics */
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
        position: relative;
    }
    
    /* The Blue Hero Background (Small version for list page) */
    .hero-bg-list {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 160px;
        background: #5a5ce2;
        border-bottom-left-radius: 30px;
        z-index: 0;
    }

    /* Container holding the card */
    .content {
        position: relative;
        z-index: 2;
        padding-top: 25px;
    }

    /* Main Card Styling */
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: none;
        margin-top: 20px;
    }
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f1f5f9;
        border-radius: 16px 16px 0 0 !important;
        padding: 20px 25px;
    }

    /* Table Styling */
    .table {
        margin-top: 10px;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #1E293B !important;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
        padding: 16px 20px;
    }
    .table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }
    .table-bordered {
        border: none;
    }
    .table-bordered td, .table-bordered th {
        border-left: none;
        border-right: none;
    }
    
    .table.table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table.table-hover tbody tr:hover {
        background-color: #f0f9ff !important;
    }

    /* Modern Toolbar */
    .filter-btn-modern {
        background: #5a5ce2;
        color: white;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
    }
    .filter-btn-modern:hover {
        background: #4338ca;
        color: white;
    }

    /* Action Buttons */
    .btn-action-purple {
        background-color: #f3e8ff;
        color: #9333ea;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-purple:hover:not(.disabled) {
        background-color: #9333ea;
        color: white;
    }
    .btn-action-blue {
        background-color: #dbeafe;
        color: #2563eb;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-blue:hover {
        background-color: #2563eb;
        color: white;
    }
    .btn-action-red {
        background-color: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-red:hover:not(:disabled) {
        background-color: #ef4444;
        color: white;
    }
    .btn-action-gray {
        background-color: #f1f5f9;
        color: #94a3b8;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-green {
        background-color: #dcfce7;
        color: #16a34a;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-green:hover:not(.disabled) {
        background-color: #16a34a;
        color: white;
    }
    .btn-action-orange {
        background-color: #ffedd5;
        color: #ea580c;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-orange:hover:not(.disabled) {
        background-color: #ea580c;
        color: white;
    }
    
    /* Pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #5a5ce2 !important;
        color: #fff !important;
        border: none;
        border-radius: 6px;
    }
    
    /* Enhanced Table UI */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 5px 10px;
        outline: none;
        transition: border-color 0.2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #5a5ce2;
        box-shadow: 0 0 0 2px rgba(90,92,226,0.2);
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        padding: 4px;
        outline: none;
    }
    
    /* Breadcrumb colors for hero background */
    .content-header h1 { color: white !important; font-weight: 700 !important; }
    .breadcrumb-item a, .breadcrumb-item.active { color: rgba(255, 255, 255, 0.8) !important; }
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- The Blue Hero Background -->
    <div class="hero-bg-list"></div>

    <div class="content-header" style="position: relative; z-index: 2;">
        <div class="container-fluid">
            <div class="row mb-2 mt-3">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        Manajemen Akun Pemohon
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
            <div class="card">
                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold" style="color: #1E293B;">
                        <i class="fas fa-list mr-2" style="color: #5a5ce2;"></i> Daftar Akun Pemohon
                    </h5>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Info -->
                    <div class="alert" style="background: #eef2ff; border:none; border-left: 4px solid #5a5ce2;
                                              border-radius: 8px; padding: 12px 16px; color: #1e293b;" role="alert">
                        <i class="fas fa-info-circle mr-2" style="color:#5a5ce2;"></i>
                        Anda dapat <strong>mengaktifkan</strong> atau <strong>menonaktifkan</strong> akun pemohon.
                        Akun yang dinonaktifkan <strong>tidak dapat login</strong> ke sistem.
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="tbl-pemohon" class="table table-bordered table-striped table-hover text-nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No. Telp</th>
                                    <th>Pekerjaan</th>
                                    <th width="110">Status</th>
                                    <th width="120" class="text-center">Aksi</th>
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
                        ? '<button class="btn btn-sm btn-action-orange mr-1" onclick="togglePemohon(' + id + ')" title="Nonaktifkan">'
                          + '<i class="fas fa-toggle-on"></i></button>'
                        : '<button class="btn btn-sm btn-action-green mr-1" onclick="togglePemohon(' + id + ')" title="Aktifkan">'
                          + '<i class="fas fa-toggle-off"></i></button>';

                    var aksesBtn = '<button class="btn btn-sm btn-action-blue" onclick="openModalAksesPemohon(' + id + ')" title="Atur Akses Menu">'
                                 + '<i class="fas fa-key"></i></button>';

                    return toggleBtn + aksesBtn;
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        responsive: false,
        scrollX: true,
        autoWidth: false,
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
