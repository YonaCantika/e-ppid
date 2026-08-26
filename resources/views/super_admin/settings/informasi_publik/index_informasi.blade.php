<style>
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
    }
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
    .table thead th {
        background-color: #f8fafc;
        color: #1E293B !important;
        font-weight: 700;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
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
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold">Informasi Publik</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-info-circle mr-2"></i> Daftar Informasi
                    </h5>
                    <button class="btn btn-add-modern" onclick="add_informasi({{ $id }})">
                        <i class="fas fa-plus mr-1"></i> Tambah Informasi
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-informasi" class="table table-bordered table-striped table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Judul Informasi</th>
                                    <th>Kategori</th>
                                    <th>Menu</th>
                                    <th>Tipe</th>
                                    <th>Link / File</th>
                                    <th width="100">Status</th>
                                    <th width="100" class="text-center">Aksi</th>
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

<!-- Modal Informasi -->
<div class="modal fade" id="modal-informasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-informasi-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var table = $('#tbl-informasi').DataTable({
        ajax: {
            url: '{{ url("super-admin/list_informasi_publik") }}',
            type: 'GET',
            data: function (d) {
                d.id = {{ $id }};
            }
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { data: 2 },
            { data: 3 },
            { data: 4, className: 'text-center' },
            { 
                data: 5,
                render: function(data, type, row) {
                    // Check if row[4] contains "Download"
                    if(row[4] && row[4].includes("Download")) {
                        return '<a href="{{ url("upload/Informasi") }}/' + data + '" target="_blank"><i class="fas fa-download mr-1"></i> File</a>';
                    } else {
                        return '<a href="' + data + '" target="_blank"><i class="fas fa-external-link-alt mr-1"></i> Link</a>';
                    }
                }
            },
            { data: 6, className: 'text-center' },
            {
                data: 7,
                orderable: false,
                className: 'text-center',
                render: function(data) {
                    return '<button class="btn btn-sm btn-action-blue" onclick="edit_informasi(' + data + ')" title="Edit"><i class="fas fa-edit"></i> Edit</button>';
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        pageLength: 10,
    });

    window.tableInformasi = table;

    window.add_informasi = function(menu_id) {
        $.post('{{ url("super-admin/getModalAddMenu_informasi") }}', { id: menu_id }, function(html) {
            $('#modal-informasi-content').html(html);
            $('#modal-informasi').modal('show');
        });
    };

    window.edit_informasi = function(id) {
        $.post('{{ url("super-admin/form_editView_informasi") }}', { id: id, status: 'edit', header: 'Edit Informasi' }, function(html) {
            $('#modal-informasi-content').html(html);
            $('#modal-informasi').modal('show');
        });
    };
});
</script>
