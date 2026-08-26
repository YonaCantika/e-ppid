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

    /* Action Buttons */
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
    .btn-action-red:hover {
        background-color: #ef4444;
        color: white;
    }
    .btn-action-green {
        background-color: #dcfce7;
        color: #16a34a;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-green:hover {
        background-color: #16a34a;
        color: white;
    }

    .btn-add-modern {
        background: #5a5ce2;
        color: white;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
    }
    .btn-add-modern:hover {
        background: #4338ca;
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
                        Manajemen Menu Website
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Super Admin</a></li>
                        <li class="breadcrumb-item active">Menu Website</li>
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
                        <i class="fas fa-list mr-2" style="color: #5a5ce2;"></i> Daftar Menu
                    </h5>
                    <button class="btn btn-add-modern" onclick="add_menu()">
                        <i class="fas fa-plus mr-1"></i> Tambah Menu
                    </button>
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <!-- Info -->
                    <div class="alert" style="background: #eef2ff; border:none; border-left: 4px solid #5a5ce2;
                                              border-radius: 8px; padding: 12px 16px; color: #1e293b;" role="alert">
                        <i class="fas fa-info-circle mr-2" style="color:#5a5ce2;"></i>
                        Kelola struktur menu website, termasuk menu utama dan sub-menu.
                    </div>

                    <div class="table-responsive mt-3">
                        <table id="tbl-menu" class="table table-bordered table-striped table-hover text-nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Menu</th>
                                    <th>Parent Menu</th>
                                    <th width="80">Urutan</th>
                                    <th width="100">Status Link</th>
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

<!-- Modal Add Menu -->
<div class="modal fade" id="modal-menu" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-menu-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {

    var table = $('#tbl-menu').DataTable({
        ajax: {
            url: '{{ url("super-admin/listmenu") }}',
            type: 'GET'
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3, className: 'text-center' },
            { data: 4, className: 'text-center' },
            {
                data: 5,
                orderable: false,
                className: 'text-center',
                render: function(data, type, row) {
                    var editBtn = '<button class="btn btn-sm btn-action-blue mr-1" onclick="edit_menu(' + data + ')" title="Edit Menu">'
                                 + '<i class="fas fa-edit"></i></button>';
                    var deleteBtn = '<button class="btn btn-sm btn-action-red mr-1" onclick="delete_menu(' + data + ')" title="Hapus Menu">'
                                 + '<i class="fas fa-trash"></i></button>';
                    
                    var linkValue = row[6]; // the link we just added
                    var validLinks = ['profil', 'regulasi', 'maklumat', 'informasi/7', 'informasi/9', 'layanan', 'keberatan'];
                    var validIds = [1, 2, 3, 7, 9, 11, 12]; // Fallback to legacy IDs just in case
                    var contentBtn = '';
                    if (validLinks.includes(linkValue) || validIds.includes(parseInt(data))) {
                        contentBtn = '<a href="{{ url("super-admin/menu_menu") }}/' + data + '" class="btn btn-sm btn-action-green" title="Kelola Konten"><i class="fas fa-cog"></i></a>';
                    }

                    return editBtn + deleteBtn + contentBtn;
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

    window.tableMenu = table;

    window.add_menu = function() {
        $.post('{{ url("super-admin/getModalAddMenu") }}', function(html) {
            $('#modal-menu-content').html(html);
            $('#modal-menu').modal('show');
        });
    };

    window.edit_menu = function(id) {
        $.post('{{ url("super-admin/form_editView_menu") }}', { id: id, status: 'edit', header: 'Edit Menu' }, function(html) {
            $('#modal-menu-content').html(html);
            $('#modal-menu').modal('show');
        });
    };

    window.delete_menu = function(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Apakah Anda yakin ingin menghapus menu ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then(function(result) {
            if (result.isConfirmed) {
                $.post('{{ url("super-admin/delete_menu") }}', { id: id }, function(res) {
                    if (res.status) {
                        toastr.success('Menu berhasil dihapus!');
                        table.ajax.reload(null, false);
                    } else {
                        toastr.error(res.msg || 'Gagal menghapus menu.');
                    }
                });
            }
        });
    };
});
</script>
