<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-edit mr-2 text-primary"></i>{{ $header }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-edit-profil" onsubmit="event.preventDefault(); submitEditProfil();" enctype="multipart/form-data">
        <input type="hidden" name="id" value="{{ $data_profil->id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Judul Profil <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" required value="{{ $data_profil->judul }}" style="border-radius: 8px;">
        </div>

        <div class="form-group mt-3">
            <label class="font-weight-bold">File Lampiran saat ini:</label>
            <div class="table-responsive">
                <table class="table table-bordered">
                    {!! $list_file !!}
                </table>
            </div>
        </div>

        <div class="form-group mt-3">
            <label class="font-weight-bold">Unggah File Baru (Opsional)</label>
            <input type="file" class="form-control-file" name="files" accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file saat ini. Maksimal 10MB.</small>
        </div>

        <div class="text-right mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6; border-radius: 8px;">
                <i class="fas fa-save mr-1"></i> Simpan Profil
            </button>
        </div>
    </form>
</div>

<script>
function submitEditProfil() {
    var formData = new FormData($('#form-edit-profil')[0]);
    $.ajax({
        url: '{{ url("super-admin/edit_profil") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status) {
                toastr.success('Profil berhasil diperbarui!');
                $('#modal-profil').modal('hide');
                if(window.tableProfil) {
                    window.tableProfil.ajax.reload(null, false);
                }
            } else {
                toastr.error(res.msg || 'Gagal menyimpan profil.');
            }
        },
        error: function() {
            toastr.error('Terjadi kesalahan server.');
        }
    });
}
</script>
