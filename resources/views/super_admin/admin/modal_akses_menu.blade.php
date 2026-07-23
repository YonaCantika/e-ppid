{{-- Modal Pengaturan Akses Menu --}}
{{-- Dipakai untuk admin maupun pemohon (dibedakan oleh $user_type) --}}

@php
    $userName  = $user_type === 'admin' ? ($user->name ?? '-') : ($user->nama ?? '-');
    $userId    = $user_type === 'admin' ? $user->id : $user->id_pemohon;
    $saveRoute = $user_type === 'admin'
        ? route('super_admin.save_akses_admin')
        : route('super_admin.save_akses_pemohon');
    $themeColor    = $user_type === 'admin' ? '#312e81' : '#065f46';
    $themeGradient = $user_type === 'admin'
        ? 'linear-gradient(135deg, #312e81, #4338ca)'
        : 'linear-gradient(135deg, #065f46, #059669)';
@endphp

<div class="modal-header" style="background: {{ $themeGradient }}; border:none;">
    <h5 class="modal-title text-white font-weight-bold">
        <i class="fas fa-key mr-2"></i>
        Atur Akses Menu —
        <span class="badge" style="background: rgba(255,255,255,0.25); font-size:0.85rem;">
            {{ $userName }}
        </span>
    </h5>
    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body p-4">
    <div class="alert" style="background: #fef3c7; border:none; border-left:4px solid #f59e0b;
                               border-radius:8px; padding:10px 14px; font-size:0.85rem;" role="alert">
        <i class="fas fa-info-circle mr-1" style="color:#d97706;"></i>
        <strong>Keterangan:</strong> Menu yang <strong>dicentang ✓</strong> akan <strong>ditampilkan</strong>.
        Menu yang tidak dicentang akan <strong>disembunyikan</strong> dari tampilan user tersebut.
    </div>

    <form id="form-akses-menu">
        <input type="hidden" name="user_id" value="{{ $userId }}">

        <div class="row">
            @foreach($all_menus as $key => $menu)
            @php
                $isAllowed = !in_array($key, $blocked_list); // true = boleh akses
            @endphp
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center p-3"
                     style="background: {{ $isAllowed ? '#ecfdf5' : '#fef2f2' }};
                            border-radius: 10px;
                            border: 1.5px solid {{ $isAllowed ? '#6ee7b7' : '#fca5a5' }};
                            transition: all 0.2s;"
                     id="menu-row-{{ $key }}">
                    <!-- Checkbox -->
                    <div class="custom-control custom-switch mr-3">
                        <input type="checkbox"
                               class="custom-control-input menu-toggle"
                               id="menu_{{ $key }}"
                               name="allowed_menus[]"
                               value="{{ $key }}"
                               {{ $isAllowed ? 'checked' : '' }}
                               onchange="updateRowStyle('{{ $key }}', this.checked)">
                        <label class="custom-control-label" for="menu_{{ $key }}"></label>
                    </div>

                    <!-- Icon -->
                    <div style="width:40px; height:40px; border-radius:10px;
                                background: {{ $isAllowed ? '#d1fae5' : '#fee2e2' }};
                                display:flex; align-items:center; justify-content:center;
                                margin-right:12px; flex-shrink:0;"
                         id="icon-bg-{{ $key }}">
                        <i class="{{ $menu['icon'] }}"
                           style="color: {{ $isAllowed ? '#059669' : '#dc2626' }}; font-size:1rem;"
                           id="icon-{{ $key }}"></i>
                    </div>

                    <!-- Label -->
                    <div>
                        <p class="m-0 font-weight-bold" style="color:#1e293b; font-size:0.95rem;">
                            {{ $menu['label'] }}
                        </p>
                        <small id="status-text-{{ $key }}"
                               style="color: {{ $isAllowed ? '#059669' : '#dc2626' }}; font-weight:600;">
                            {{ $isAllowed ? '✓ Ditampilkan' : '✗ Disembunyikan' }}
                        </small>
                    </div>

                    <!-- Spacer -->
                    <div class="ml-auto">
                        <span class="badge" id="badge-{{ $key }}"
                              style="background: {{ $isAllowed ? '#059669' : '#dc2626' }}; color:#fff;
                                     padding: 5px 10px; border-radius:6px; font-size:0.8rem;">
                            {{ $isAllowed ? 'AKTIF' : 'NONAKTIF' }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </form>
</div>

<div class="modal-footer" style="border-top: 1px solid #e0e7ff;">
    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:8px;">
        <i class="fas fa-times mr-1"></i>Batal
    </button>
    <button type="button" id="btn-save-akses"
            class="btn btn-super-add"
            style="background: {{ $themeGradient }}; color:#fff; border:none; border-radius:8px;
                   padding:8px 18px; font-weight:700;"
            onclick="saveAksesMenu('{{ $saveRoute }}')">
        <i class="fas fa-save mr-1"></i>Simpan Pengaturan
    </button>
</div>

<script>
// Update tampilan row saat toggle checkbox
function updateRowStyle(key, isChecked) {
    var row  = document.getElementById('menu-row-' + key);
    var icon = document.getElementById('icon-' + key);
    var iconBg = document.getElementById('icon-bg-' + key);
    var statusText = document.getElementById('status-text-' + key);
    var badge = document.getElementById('badge-' + key);

    if (isChecked) {
        row.style.background      = '#ecfdf5';
        row.style.borderColor     = '#6ee7b7';
        iconBg.style.background   = '#d1fae5';
        icon.style.color          = '#059669';
        statusText.style.color    = '#059669';
        statusText.textContent    = '✓ Ditampilkan';
        badge.style.background    = '#059669';
        badge.textContent         = 'AKTIF';
    } else {
        row.style.background      = '#fef2f2';
        row.style.borderColor     = '#fca5a5';
        iconBg.style.background   = '#fee2e2';
        icon.style.color          = '#dc2626';
        statusText.style.color    = '#dc2626';
        statusText.textContent    = '✗ Disembunyikan';
        badge.style.background    = '#dc2626';
        badge.textContent         = 'NONAKTIF';
    }
}

function saveAksesMenu(saveUrl) {
    var formData = $('#form-akses-menu').serialize();

    $('#btn-save-akses').prop('disabled', true)
                        .html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...');

    $.post(saveUrl, formData, function(res) {
        if (res.status) {
            $('#modal-akses-menu').modal('hide');
            toastr.success(res.msg);
            // Reload tabel jika ada
            if (typeof window.tableAdmin !== 'undefined') window.tableAdmin.ajax.reload(null, false);
            if (typeof window.tablePemohon !== 'undefined') window.tablePemohon.ajax.reload(null, false);
        } else {
            toastr.error(res.msg || 'Gagal menyimpan.');
        }
    }).fail(function() {
        toastr.error('Terjadi kesalahan server.');
    }).always(function() {
        $('#btn-save-akses').prop('disabled', false)
                           .html('<i class="fas fa-save mr-1"></i>Simpan Pengaturan');
    });
}
</script>
