<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-edit mr-2 text-primary"></i>{{ $header }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-edit-regulasi" onsubmit="event.preventDefault(); submitEditRegulasi();" enctype="multipart/form-data">
        <input type="hidden" name="id_reg" value="{{ $data_regulasi->regulasi_id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Nama Aturan / Regulasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="aturan" required value="{{ $data_regulasi->aturan }}" style="border-radius: 8px;">
        </div>

        <div class="form-group mt-3">
            <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
            <select name="status" class="form-control" required style="border-radius: 8px;">
                <option value="0" {{ $data_regulasi->status == 0 ? 'selected' : '' }}>Aktif</option>
                <option value="1" {{ $data_regulasi->status == 1 ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
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
            <input type="file" class="form-control-file" name="files" accept=".pdf">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah file saat ini. Hanya PDF, maksimal 10MB.</small>
        </div>

        <div class="text-right mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6; border-radius: 8px;">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function delete_file_reg(button) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Anda akan menghapus file regulasi ini dari tampilan. Anda harus mengupload yang baru jika dihapus.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            $(button).closest('tr').remove();
        }
    });
}

function submitEditRegulasi() {
    var formData = new FormData($('#form-edit-regulasi')[0]);
    $.ajax({
        url: '{{ url("super-admin/edit_regulasi") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status) {
                toastr.success('Regulasi berhasil diperbarui!');
                $('#modal-regulasi').modal('hide');
                if(window.tableRegulasi) {
                    window.tableRegulasi.ajax.reload(null, false);
                }
            } else {
                toastr.error(res.msg || 'Gagal menyimpan regulasi.');
            }
        },
        error: function() {
            toastr.error('Terjadi kesalahan server.');
        }
    });
}
</script>
