<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;"><i class="fas fa-edit mr-2 text-primary"></i>{{ $header }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-edit-informasi" onsubmit="event.preventDefault(); submitEditInformasi();" enctype="multipart/form-data">
        <input type="hidden" name="id_informasi" value="{{ $data_informasi->informasi_id }}">
        
        <div class="form-group">
            <label class="font-weight-bold">Judul Informasi <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="judul" required value="{{ $data_informasi->judul }}" style="border-radius: 8px;">
        </div>

        <div class="row">
            <div class="col-md-4 form-group mt-3">
                <label class="font-weight-bold">Kategori <span class="text-danger">*</span></label>
                <select name="kategori" class="form-control" required style="border-radius: 8px;">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($list_kategori as $k)
                        <option value="{{ $k->kategori_id }}" {{ $data_informasi->kategori_id == $k->kategori_id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-4 form-group mt-3">
                <label class="font-weight-bold">Tipe Informasi <span class="text-danger">*</span></label>
                <select name="tipe" id="tipe-edit" class="form-control" required style="border-radius: 8px;" onchange="toggleTipeEdit()">
                    <option value="0" {{ $data_informasi->tipe == 0 ? 'selected' : '' }}>Download (File)</option>
                    <option value="1" {{ $data_informasi->tipe == 1 ? 'selected' : '' }}>View (Link URL)</option>
                </select>
            </div>

            <div class="col-md-4 form-group mt-3">
                <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control" required style="border-radius: 8px;">
                    <option value="0" {{ $data_informasi->status == 0 ? 'selected' : '' }}>Aktif</option>
                    <option value="1" {{ $data_informasi->status == 1 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="form-group mt-3" id="container-file-edit" style="{{ $data_informasi->tipe == 0 ? '' : 'display: none;' }}">
            <label class="font-weight-bold">File Lampiran saat ini:</label>
            <div class="table-responsive">
                <table class="table table-bordered">
                    {!! $list_file !!}
                </table>
            </div>
            <label class="font-weight-bold mt-2">Unggah File Baru (Opsional)</label>
            <input type="file" class="form-control-file" name="files" id="file-edit" accept=".pdf,.doc,.docx,.zip">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah. Maks 10MB.</small>
        </div>

        <div class="form-group mt-3" id="container-link-edit" style="{{ $data_informasi->tipe == 1 ? '' : 'display: none;' }}">
            <label class="font-weight-bold">Link URL <span class="text-danger">*</span></label>
            <input type="url" class="form-control" name="link" id="link-edit" value="{{ $data_informasi->tipe == 1 ? $data_informasi->link : '' }}" placeholder="https://..." style="border-radius: 8px;" {{ $data_informasi->tipe == 1 ? 'required' : '' }}>
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
function toggleTipeEdit() {
    var tipe = $('#tipe-edit').val();
    if (tipe === '0') {
        $('#container-file-edit').show();
        
        $('#container-link-edit').hide();
        $('#link-edit').prop('required', false);
    } else {
        $('#container-file-edit').hide();
        
        $('#container-link-edit').show();
        $('#link-edit').prop('required', true);
    }
}

function delete_file(button) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Anda akan menghapus file ini dari tampilan. Anda harus mengupload yang baru jika tipe-nya File.",
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

function submitEditInformasi() {
    var formData = new FormData($('#form-edit-informasi')[0]);
    $.ajax({
        url: '{{ url("super-admin/save_editinformasi") }}',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if(res.status) {
                toastr.success('Informasi berhasil diperbarui!');
                $('#modal-informasi').modal('hide');
                if(window.tableInformasi) {
                    window.tableInformasi.ajax.reload(null, false);
                }
            } else {
                toastr.error(res.msg || 'Gagal menyimpan informasi.');
            }
        },
        error: function() {
            toastr.error('Terjadi kesalahan server saat menyimpan data.');
        }
    });
}
</script>
