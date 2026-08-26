<div class="modal-header" style="background-color: #5a5ce2; color: white; border-top-left-radius: 14px; border-top-right-radius: 14px;">
    <h5 class="modal-title font-weight-bold"><i class="fas fa-plus-circle mr-2"></i>Tambah Menu</h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body p-4">
    <form id="form-add-menu" onsubmit="event.preventDefault(); submitAddMenu();">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Nama Menu (ID) <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="menu" id="menu_id" required placeholder="Masukkan nama menu (Indonesia)">
            </div>
            <div class="col-md-6 form-group">
                <label>Nama Menu (EN)</label>
                <input type="text" class="form-control" name="menu_en" placeholder="Enter menu name (English)">
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Sebagai <span class="text-danger">*</span></label>
                <select name="sbg" id="sbg" class="form-control" required onchange="toggleParent()">
                    <option value="">-- Pilih --</option>
                    <option value="parent">Parent Menu (Menu Utama)</option>
                    <option value="child">Child Menu (Sub Menu)</option>
                </select>
            </div>
            <div class="col-md-6 form-group" id="parent-container" style="display: none;">
                <label>Parent Menu <span class="text-danger">*</span></label>
                <select name="parent" id="parent" class="form-control">
                    <option value="">-- Pilih Parent --</option>
                    @foreach($list_parent as $lp)
                        <option value="{{ $lp->id }}">{{ $lp->judul }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 form-group">
                <label>Urutan <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="urutan" required min="1" value="1">
            </div>
            <div class="col-md-8 form-group">
                <label>Link <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="link" id="link" required readonly placeholder="Link akan di-generate otomatis">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary" onclick="generateLink()">Generate</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mt-4">
            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary" style="background-color: #5a5ce2; border-color: #5a5ce2;">
                <i class="fas fa-save mr-1"></i> Simpan
            </button>
        </div>
    </form>
</div>

<script>
function toggleParent() {
    var sbg = $('#sbg').val();
    if (sbg === 'child') {
        $('#parent-container').show();
        $('#parent').prop('required', true);
    } else {
        $('#parent-container').hide();
        $('#parent').prop('required', false);
        $('#parent').val('');
    }
}

function generateLink() {
    var sbg = $('#sbg').val();
    var menu = $('#menu_id').val();
    var parent = $('#parent').val();
    
    if (!menu) {
        toastr.warning('Silakan isi Nama Menu terlebih dahulu.');
        return;
    }
    if (sbg === 'child' && !parent) {
        toastr.warning('Silakan pilih Parent Menu.');
        return;
    }

    $.post('{{ url("super-admin/generate_link") }}', { 
        id: sbg, 
        menu: menu, 
        parent: parent 
    }, function(res) {
        $('#link').val(res);
    });
}

function submitAddMenu() {
    var link = $('#link').val();
    if (!link) {
        toastr.warning('Silakan klik tombol Generate Link terlebih dahulu.');
        return;
    }
    
    var data = $('#form-add-menu').serialize();
    $.post('{{ url("super-admin/add_menu") }}', data, function(res) {
        if(res.status) {
            toastr.success('Menu berhasil ditambahkan!');
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
