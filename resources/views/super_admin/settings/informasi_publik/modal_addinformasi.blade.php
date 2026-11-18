<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Informasi Publik</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-add-informasi" onsubmit="event.preventDefault(); submitAddInformasi();" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Judul Informasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" id="judul-add" required placeholder="Contoh: Laporan Keuangan" style="border-radius: 8px;">
        </div>

        <div class="row">
            <div class="col-md-6 form-group mt-3">
                <label class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                <select name="kategori" id="kategori-add" class="form-control" required style="border-radius: 8px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->kategori_id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6 form-group mt-3">
                <label class="font-weight-bold">Tipe Informasi <span class="text-danger">*</span></label>
                <select name="tipe" id="tipe-add" class="form-control" required style="border-radius: 8px;" onchange="toggleTipeAdd()">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="0">Download (File)</option>
                    <option value="1">View (Link URL)</option>
                </select>
            </div>
        </div>

        <div class="form-group mt-3" id="container-file-add" style="display: none;">
            <label class="font-weight-bold">Unggah File (PDF/DOC/ZIP) <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" name="files" id="file-add" accept=".pdf,.doc,.docx,.zip,.xls,.xlsx">
            <small class="text-muted">Maksimal 10MB.</small>
        </div>

        <div class="form-group mt-3" id="container-link-add" style="display: none;">
            <label class="font-weight-bold">Link URL <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="link" id="link-add" placeholder="https://..." style="border-radius: 8px;">
            <small class="text-muted">Dapat berupa tautan website atau dokumen eksternal.</small>
        </div>

        <div class="text-right mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" id="btn-submit-informasi" class="btn btn-primary" style="background-color: #5a5ce2; border-color: #5a5ce2; border-radius: 8px;">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>

<script>
function toggleTipeAdd() {
    var tipe = $('#tipe-add').val();
    if (tipe === '0') {
        $('#container-file-add').show();
        $('#container-link-add').hide();
    } else if (tipe === '1') {
        $('#container-file-add').hide();
        $('#container-link-add').show();
    } else {
        $('#container-file-add').hide();
        $('#container-link-add').hide();
    }
}

function submitAddInformasi() {
    var judul = $.trim($('#judul-add').val());
    var kategori = $('#kategori-add').val();
    var tipe = $('#tipe-add').val();

    if (!judul) {
        toastr.warning('Judul informasi wajib diisi.');
        return;
    }
    if (!kategori) {
        toastr.warning('Silakan pilih kategori.');
        return;
    }
    if (tipe === '') {
        toastr.warning('Silakan pilih tipe informasi.');
        return;
    }

    if (tipe === '0') {
        var fileInput = document.getElementById('file-add');
        if (!fileInput.files || fileInput.files.length === 0) {
            toastr.warning('Silakan pilih file yang akan diunggah.');
            return;
        }
    } else if (tipe === '1') {
        var link = $.trim($('#link-add').val());
        if (!link) {
            toastr.warning('Link URL wajib diisi.');
            return;
        }
    }

    var $btn = $('#btn-submit-informasi');
    var originalHtml = $btn.html();
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...');

    var formData = new FormData($('#form-add-informasi')[0]);

    $.ajax({
        url: '{{ url("super-admin/add_informasi_publik") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status) {
                toastr.success('Informasi publik berhasil ditambahkan!');
                $('#modal-informasi').modal('hide');
                if(window.tableInformasi) {
                    window.tableInformasi.ajax.reload(null, false);
                }
            } else {
                toastr.error(res.msg || 'Gagal menyimpan informasi.');
            }
        },
        error: function(xhr) {
            var msg = 'Terjadi kesalahan server saat menyimpan data.';
            if(xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            toastr.error(msg);
        },
        complete: function() {
            $btn.prop('disabled', false).html(originalHtml);
        }
    });
}
</script>