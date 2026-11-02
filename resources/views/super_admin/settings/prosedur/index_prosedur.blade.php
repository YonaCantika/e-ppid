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
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark font-weight-bold">Prosedur Layanan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-sitemap mr-2"></i> Daftar Prosedur
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tbl-prosedur" class="table table-bordered table-striped table-hover text-nowrap" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Judul Prosedur</th>
                                    <th>Gambar Infografis</th>
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

<!-- Modal Prosedur -->
<div class="modal fade" id="modal-prosedur" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" id="modal-prosedur-content" style="border-radius:14px; overflow:hidden;">
            {{-- Dimuat via AJAX --}}
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var table = $('#tbl-prosedur').DataTable({
        ajax: {
            url: '{{ url("super-admin/list_prosedur") }}',
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
                className: 'text-center'
            },
            { data: 3, className: 'text-center' },
            {
                data: 4,
                orderable: false,
                className: 'text-center',
                render: function(data) {
                    return '<button class="btn btn-sm btn-action-blue" onclick="edit_prosedur(' + data + ')" title="Edit Prosedur"><i class="fas fa-edit"></i> Edit</button>';
                }
            }
        ],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Indonesian.json'
        },
        pageLength: 10,
    });

    window.tableProsedur = table;

    window.edit_prosedur = function(id) {
        $.post('{{ url("super-admin/form_editView_prosedur") }}', { id: id, status: 'edit', header: 'Edit Prosedur' }, function(html) {
            $('#modal-prosedur-content').html(html);
            $('#modal-prosedur').modal('show');
        });
    };
});
</script>
