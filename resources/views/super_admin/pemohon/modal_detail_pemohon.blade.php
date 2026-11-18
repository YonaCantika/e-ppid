@php
    // Mapping Jenis Pemohon
    $jenisPemohonMap = [
        1 => 'Perorangan',
        2 => 'Kelompok Orang',
        3 => 'Badan Hukum'
    ];
    $jenisPemohon = $jenisPemohonMap[$pemohon->id_jenis] ?? ($pemohon->id_jenis ? 'Lainnya' : '-');

    // Mapping Jenis Identitas
    $jenisIdentitasMap = [
        1 => 'KTP',
        2 => 'Pengesahan Badan Usaha',
        3 => 'Surat Kuasa',
        4 => 'Badan Publik'
    ];
    $jenisIdentitas = $jenisIdentitasMap[$pemohon->id_identitas] ?? ($pemohon->id_identitas ? 'Lainnya' : '-');
@endphp

<div class="modal-header" style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0; border-radius: 14px 14px 0 0;">
    <h5 class="modal-title font-weight-bold" style="color: #1e293b;">
        <i class="fas fa-id-card-alt mr-2 text-primary"></i> Detail Akun Pemohon
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body p-4" style="background-color: #f8fafc; max-height: 80vh; overflow-y: auto;">

    <!-- 1. Header Profile Banner -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; overflow: hidden; background: #ffffff;">
        <div class="card-body p-4">
            <div class="d-flex flex-column flex-md-row align-items-center">
                <div class="mr-md-4 mb-3 mb-md-0">
                    <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, #0f3964 0%, #004b93 100%);
                                color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; box-shadow: 0 4px 12px rgba(0, 75, 147, 0.25);">
                        {{ strtoupper(substr($pemohon->nama ?? 'P', 0, 1)) }}
                    </div>
                </div>
                <div class="flex-grow-1 text-center text-md-left">
                    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start">
                        <h4 class="font-weight-bold mb-1 mr-3" style="color: #0f172a;">{{ $pemohon->nama ?? '-' }}</h4>
                        @if($pemohon->status == 1)
                            <span class="badge badge-success px-2 py-1" style="font-size: 0.8rem; border-radius: 6px;"><i class="fas fa-check-circle mr-1"></i> Aktif</span>
                        @else
                            <span class="badge badge-danger px-2 py-1" style="font-size: 0.8rem; border-radius: 6px;"><i class="fas fa-times-circle mr-1"></i> Nonaktif</span>
                        @endif
                    </div>
                    <div class="text-muted mt-1" style="font-size: 0.9rem;">
                        <span class="mr-3"><i class="fas fa-envelope mr-1 text-secondary"></i> {{ $pemohon->email }}</span>
                        <span><i class="fas fa-phone mr-1 text-secondary"></i> {{ $pemohon->notelp ?? '-' }}</span>
                    </div>
                    <div class="mt-2 text-muted" style="font-size: 0.82rem;">
                        <span class="mr-3"><i class="far fa-calendar-alt mr-1"></i> Terdaftar: {{ $pemohon->created_at ? date('d M Y, H:i', strtotime($pemohon->created_at)) : '-' }}</span>
                        <span><i class="fas fa-history mr-1"></i> Terakhir Login: {{ $pemohon->lastLogin ? date('d M Y, H:i', strtotime($pemohon->lastLogin)) : 'Belum pernah' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Biodata & Identitas -->
    <div class="card mb-4 border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
        <div class="card-header bg-white border-bottom py-3" style="border-radius: 12px 12px 0 0;">
            <h6 class="m-0 font-weight-bold" style="color: #1e293b;">
                <i class="fas fa-user-tag text-primary mr-2"></i> Biodata & Identitas Pemohon
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0" style="font-size: 0.92rem;">
                    <tbody>
                        <tr>
                            <th width="35%" class="text-secondary pl-4">Jenis Pemohon</th>
                            <td class="font-weight-600 pr-4">{{ $jenisPemohon }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">Jenis Identitas</th>
                            <td class="font-weight-600 pr-4">{{ $jenisIdentitas }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">Nomor Identitas (NIK)</th>
                            <td class="font-weight-600 pr-4">{{ $pemohon->nomor_identitas ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">NPWP</th>
                            <td class="font-weight-600 pr-4">{{ $pemohon->npwp ? $pemohon->npwp : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">Pekerjaan</th>
                            <td class="font-weight-600 pr-4">{{ $pemohon->pekerjaan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">No. Fax</th>
                            <td class="font-weight-600 pr-4">{{ $pemohon->nofax ? $pemohon->nofax : '-' }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary pl-4">Alamat Lengkap</th>
                            <td class="pr-4" style="line-height: 1.5;">{{ $pemohon->alamat ?? '-' }}</td>
                        </tr>
                        @if($pemohon->ktp)
                        <tr>
                            <th class="text-secondary pl-4">Berkas KTP</th>
                            <td class="pr-4">
                                <a href="{{ url('upload/' . $pemohon->ktp) }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka File KTP
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($pemohon->akta)
                        <tr>
                            <th class="text-secondary pl-4">Berkas Akta / SK</th>
                            <td class="pr-4">
                                <a href="{{ url('upload/' . $pemohon->akta) }}" target="_blank" class="btn btn-xs btn-outline-primary">
                                    <i class="fas fa-external-link-alt mr-1"></i> Buka File Akta
                                </a>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 3. Riwayat Permohonan Informasi -->
    <div class="card border-0 shadow-sm" style="border-radius: 12px; background: #ffffff;">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center" style="border-radius: 12px 12px 0 0;">
            <h6 class="m-0 font-weight-bold" style="color: #1e293b;">
                <i class="fas fa-file-invoice text-primary mr-2"></i> Riwayat Permohonan Informasi
            </h6>
            <span class="badge badge-primary px-2 py-1" style="border-radius: 6px;">Total: {{ count($permohonan) }}</span>
        </div>
        <div class="card-body p-0">
            @if(count($permohonan) > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0" style="font-size: 0.88rem;">
                        <thead style="background-color: #f8fafc;">
                            <tr>
                                <th width="40" class="pl-4">#</th>
                                <th>Tipe Permohonan</th>
                                <th>Isi Permohonan</th>
                                <th>Status</th>
                                <th width="140" class="pr-4">Tanggal Diajukan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($permohonan as $index => $item)
                                @php
                                    $statusBadge = '<span class="badge badge-secondary">'.$item->status.'</span>';
                                    if ($item->status == 'OPEN') {
                                        $statusBadge = '<span class="badge" style="background:#fee2e2; color:#ef4444; border-radius:4px; padding:4px 8px;">BELUM DITANGGAPI</span>';
                                    } elseif ($item->status == 'APPROVE') {
                                        $statusBadge = '<span class="badge" style="background:#dcfce7; color:#16a34a; border-radius:4px; padding:4px 8px;">SUDAH DITANGGAPI</span>';
                                    } elseif ($item->status == 'APPROVE_HALF') {
                                        $statusBadge = '<span class="badge" style="background:#fef3c7; color:#d97706; border-radius:4px; padding:4px 8px;">DITANGGAPI SEBAGIAN</span>';
                                    } elseif ($item->status == 'REJECT') {
                                        $statusBadge = '<span class="badge" style="background:#fee2e2; color:#b91c1c; border-radius:4px; padding:4px 8px;">DITOLAK</span>';
                                    }
                                @endphp
                                <tr>
                                    <td class="pl-4 font-weight-bold text-secondary">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="font-weight-600 text-dark">{{ $item->tipe_permohonan ?? '-' }}</div>
                                        @if($item->tipe_lainnya)
                                            <small class="text-muted">Ket: {{ $item->tipe_lainnya }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <div style="max-width: 320px; white-space: normal; line-height: 1.4;">
                                            {{ \Illuminate\Support\Str::limit($item->isi_permohonan, 90, '...') }}
                                        </div>
                                    </td>
                                    <td>{!! $statusBadge !!}</td>
                                    <td class="pr-4 text-muted">{{ $item->created_at ? date('d/m/Y H:i', strtotime($item->created_at)) : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center p-4 text-muted">
                    <i class="far fa-folder-open mb-2" style="font-size: 2rem; color: #cbd5e1; display: block;"></i>
                    Pemohon ini belum pernah mengajukan permohonan informasi publik.
                </div>
            @endif
        </div>
    </div>

</div>

<div class="modal-footer bg-white" style="border-top: 1px solid #e2e8f0; border-radius: 0 0 14px 14px;">
    <button type="button" class="btn btn-secondary px-4" data-dismiss="modal" style="border-radius: 8px;">
        <i class="fas fa-times mr-1"></i> Tutup
    </button>
</div>

