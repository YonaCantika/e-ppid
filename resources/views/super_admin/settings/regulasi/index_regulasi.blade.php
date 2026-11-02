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
                    <h1 class="m-0 text-dark font-weight-bold">Regulasi</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-balance-scale mr-2"></i> Daftar Regulasi
                    </h5>
                    <button class="btn btn-add-modern" onclick="add_regulasi({{ $id }})">
                        <i class="fas fa-plus mr-1"></i> Tambah Regulasi
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-regulasi" class="table table-bordered table-striped table-hover" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Regulasi (Aturan)</th>
                                    <th>File Terlampir</th>
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

<!-- Modal Regulasi -->
<div class="modal fade" id="modal-regulasi" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-regulasi-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var table = $('#tbl-regulasi').DataTable({
        ajax: {
            url: '{{ url("super-admin/list_regulasi") }}',
            type: 'GET',
            data: function (d) {
                d.id = {{ $id }};
            }
        },
        columns: [
            { data: 0 },
            { data: 1 },
            { 
                data: 2,
                render: function(data) {
                    if(data) {
                        return '<a href="{{ url("upload/Regulasi") }}/' + data + '" target="_blank"><i class="fas fa-file-pdf text-danger mr-1"></i> ' + data + '</a>';
                    }
                    return '-';
                }
            },
            { data: 3, className: 'text-center' },
            {
                data: 4,
                orderable: false,
                className: 'text-center',
                render: function(data) {
                    return '<button class="btn btn-sm btn-action-blue" onclick="edit_regulasi(' + data + ')" title="Edit Regulasi"><i class="fas fa-edit"></i> Edit</button>';
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        pageLength: 10,
    });

    window.tableRegulasi = table;

    window.add_regulasi = function(menu_id) {
        $.post('{{ url("super-admin/getModalAddMenu_regulasi") }}', { id: menu_id }, function(html) {
            $('#modal-regulasi-content').html(html);
            $('#modal-regulasi').modal('show');
        });
    };

    window.edit_regulasi = function(id) {
        $.post('{{ url("super-admin/form_editView_regulasi") }}', { id: id, status: 'edit', header: 'Edit Regulasi' }, function(html) {
            $('#modal-regulasi-content').html(html);
            $('#modal-regulasi').modal('show');
        });
    };
});
</script>
