<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-edit mr-2 text-primary"></i>{{ $header }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-edit-maklumat" onsubmit="event.preventDefault(); submitEditMaklumat();">
        <input type="hidden" name="id" value="{{ $data_maklumat->id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Judul Maklumat <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" required value="{{ $data_maklumat->judul }}" style="border-radius: 8px;">
        </div>

        <div class="form-group mt-3">
            <label class="font-weight-bold">Isi Konten Maklumat <span class="text-danger">*</span></label>
            <textarea id="summernote-maklumat" name="summernote">{{ $data_maklumat->deskripsi }}</textarea>
        </div>

        <div class="text-right mt-4 pt-3" style="border-top: 1px solid #e2e8f0;">
            <button type="button" class="btn btn-light" data-dismiss="modal" style="border-radius: 8px;">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6; border-radius: 8px;">
                <i class="fas fa-save mr-1"></i> Simpan Konten
            </button>
        </div>
    </form>
</div>

<!-- Load Summernote if not already loaded in the main layout -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
$(document).ready(function() {
    $('#summernote-maklumat').summernote({
        height: 300,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});

function submitEditMaklumat() {
    var data = $('#form-edit-maklumat').serialize();
    $.post('{{ url("super-admin/edit_maklumat") }}', data, function(res) {
        if(res.status) {
            toastr.success('Konten Maklumat berhasil diperbarui!');
            $('#modal-maklumat').modal('hide');
            if(window.tableMaklumat) {
                window.tableMaklumat.ajax.reload(null, false);
            }
        } else {
            toastr.error(res.msg || 'Gagal menyimpan perubahan.');
        }
    });
}
</script>
