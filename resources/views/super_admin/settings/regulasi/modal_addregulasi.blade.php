<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-plus-circle mr-2 text-primary"></i>Tambah Regulasi</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-add-regulasi" onsubmit="event.preventDefault(); submitAddRegulasi();" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Nama Aturan / Regulasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="aturan" required placeholder="Contoh: UU KIP No. 14 Tahun 2008" style="border-radius: 8px;">
        </div>

        <div class="form-group mt-3">
            <label class="font-weight-bold">File Regulasi <span class="text-danger">*</span></label>
            <input type="file" class="form-control-file" name="files" required accept=".pdf">
            <small class="text-muted">Hanya menerima file berformat PDF. Maksimal 10MB.</small>
        </div>

        <div class="text-right mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #5a5ce2; border-color: #5a5ce2; border-radius: 8px;">
                <i class="fas fa-save mr-1"></i> Simpan Regulasi
            </button>
        </div>
    </form>
</div>

<script>
function submitAddRegulasi() {
    var formData = new FormData($('#form-add-regulasi')[0]);
    $.ajax({
        url: '{{ url("super-admin/add_regulasi") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status) {
                toastr.success('Regulasi berhasil ditambahkan!');
                $('#modal-regulasi').modal('hide');
                if(window.tableRegulasi) {
                    window.tableRegulasi.ajax.reload(null, false);
                }
            } else {
                toastr.error(res.msg || 'Gagal menyimpan regulasi.');
            }
        },
        error: function() {
            toastr.error('Terjadi kesalahan server saat upload file.');
        }
    });
}
</script>
