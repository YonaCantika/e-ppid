<div class="modal-header" style="background-color: #f3f4f6; color: #1f2937; border-top-left-radius: 14px; border-top-right-radius: 14px;">
    <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2" style="color:#3b82f6;"></i>{{ $header }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-edit-menu" onsubmit="event.preventDefault(); submitEditMenu();">
        <input type="hidden" name="id_menu" value="{{ $data_menu->id }}">
        <input type="hidden" name="sbg" value="{{ $data_menu->sub_menu == 0 ? 'Parent' : 'Child' }}">
        
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Nama Menu (ID) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="menu" required value="{{ $data_menu->judul }}">
            </div>
            <div class="col-md-6 form-group">
                <label>Nama Menu (EN)</label>
                <input type="text" class="form-control" name="menu_en" value="{{ $data_menu->judul_en }}">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Sebagai</label>
                <input type="text" class="form-control bg-light" readonly value="{{ $data_menu->sub_menu == 0 ? 'Parent Menu (Menu Utama)' : 'Child Menu (Sub Menu)' }}">
            </div>
            @if($data_menu->sub_menu != 0)
            <div class="col-md-6 form-group">
                <label>Parent Menu <span class="text-danger">*</span></label>
                <select name="parent" class="form-control" required>
                    <option value="">-- Pilih Parent --</option>
                    @foreach($list_parent as $lp)
                        <option value="{{ $lp->id }}" {{ $data_menu->id_menu == $lp->id ? 'selected' : '' }}>{{ $lp->judul }}</option>
                    @endforeach
                </select>
            </div>
            @endif
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label>Urutan <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="urutan" required min="1" value="{{ $data_menu->urut }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Link <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="link" required value="{{ $data_menu->link }}">
            </div>
            <div class="col-md-4 form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select name="status" class="form-control" required>
                    <option value="active" {{ $data_menu->status_link == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="unactive" {{ $data_menu->status_link == 'unactive' ? 'selected' : '' }}>Unactive</option>
                </select>
            </div>
        </div>

        <div class="text-right mt-4">
            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #3b82f6; border-color: #3b82f6;">
                <i class="fas fa-save mr-1"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<script>
function submitEditMenu() {
    var data = $('#form-edit-menu').serialize();
    $.post('{{ url("super-admin/save_editmenu") }}', data, function(res) {
        if(res.status) {
            toastr.success('Menu berhasil diperbarui!');
            $('#modal-menu').modal('hide');
            if(window.tableMenu) {
                window.tableMenu.ajax.reload(null, false);
            }
        } else {
            toastr.error(res.msg || 'Gagal menyimpan menu.');
        }
    });
}
</script>
