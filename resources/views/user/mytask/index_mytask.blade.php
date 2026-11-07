@php
    $id_pemohon = Auth::guard('pemohon')->id();
    
    // Fallback data jika di-render di luar controller
    $metric_total   = $metric_total   ?? \Illuminate\Support\Facades\DB::table('informasi_permohonan')->where('id_pemohon', $id_pemohon)->count();
    $metric_belum   = $metric_belum   ?? \Illuminate\Support\Facades\DB::table('informasi_permohonan')->where('id_pemohon', $id_pemohon)->where(function($q) { $q->whereIn('status', ['OPEN', 'BELUM DITANGGAPI', 'PENDING'])->orWhereNull('status'); })->count();
    $metric_proses  = $metric_proses  ?? \Illuminate\Support\Facades\DB::table('informasi_permohonan')->where('id_pemohon', $id_pemohon)->whereIn('status', ['PROCESS', 'PROSES', 'SEDANG DIPROSES', 'APPROVE_HALF'])->count();
    $metric_selesai = $metric_selesai ?? \Illuminate\Support\Facades\DB::table('informasi_permohonan')->where('id_pemohon', $id_pemohon)->whereIn('status', ['APPROVE', 'SUDAH DITANGGAPI', 'SELESAI', 'REJECT', 'DITOLAK'])->count();
    
    $permohonan_terbaru = $permohonan_terbaru ?? \Illuminate\Support\Facades\DB::table('informasi_permohonan')
        ->where('id_pemohon', $id_pemohon)
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->limit(5)
        ->get();
@endphp

<style>
    /* Styling Dasar Wrapper Dashboard */
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        position: relative;
    }
    
    /* Hero Background Khas PT Garam */
    .hero-bg-list {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 220px;
        background: linear-gradient(135deg, #0f3964 0%, #004b93 50%, #1d4ed8 100%);
        border-bottom-left-radius: 30px;
        border-bottom-right-radius: 30px;
        z-index: 0;
        box-shadow: 0 4px 20px rgba(0, 75, 147, 0.2);
    }

    .content-header, .content {
        position: relative;
        z-index: 2;
    }
    
    .content-header {
        padding-top: 25px;
        padding-bottom: 15px;
    }
    
    .content-header h1 {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.65rem;
        margin: 0;
        line-height: 1.2;
    }
    
    .content-header .hero-subtitle {
        color: #e0f2fe;
        font-size: 0.95rem;
        margin-top: 6px;
        margin-bottom: 0;
    }

    .content-header .breadcrumb-item a {
        color: #e0f2fe !important;
    }
    
    .content-header .breadcrumb-item.active {
        color: #ffffff !important;
        font-weight: 600;
    }

    .dashboard-container {
        margin-top: 10px;
        padding-bottom: 40px;
    }

    /* ==============================================================
       1. KARTU METRIK MODERN (4 GRID DINAMIS)
       ============================================================== */
    .metric-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 175px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px -5px rgba(0, 40, 100, 0.12);
    }

    /* Top Accent Line */
    .metric-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .card-accent-blue::before   { background: linear-gradient(90deg, #2563eb, #3b82f6); }
    .card-accent-amber::before  { background: linear-gradient(90deg, #d97706, #f59e0b); }
    .card-accent-indigo::before { background: linear-gradient(90deg, #4f46e5, #6366f1); }
    .card-accent-green::before  { background: linear-gradient(90deg, #16a34a, #22c55e); }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .stat-title-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .stat-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .icon-box-blue   { background-color: #eff6ff; color: #2563eb; }
    .icon-box-amber  { background-color: #fffbeb; color: #d97706; }
    .icon-box-indigo { background-color: #eef2ff; color: #4f46e5; }
    .icon-box-green  { background-color: #f0fdf4; color: #16a34a; }

    .stat-title {
        color: #475569;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .stat-tag {
        font-size: 0.72rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    .tag-blue   { background-color: #e0f2fe; color: #0284c7; }
    .tag-amber  { background-color: #fef3c7; color: #d97706; }
    .tag-indigo { background-color: #e0e7ff; color: #4338ca; }
    .tag-green  { background-color: #dcfce7; color: #15803d; }
    
    .stat-value {
        font-size: 2.3rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin: 10px 0 14px 0;
    }

    .progress-line {
        height: 6px;
        border-radius: 4px;
        background-color: #f1f5f9;
        position: relative;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 4px;
        transition: width 0.6s ease;
    }
    .fill-blue   { background-color: #2563eb; }
    .fill-amber  { background-color: #f59e0b; }
    .fill-indigo { background-color: #6366f1; }
    .fill-green  { background-color: #22c55e; }

    .card-link {
        font-size: 0.85rem;
        color: #004b93;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
        margin-top: auto;
    }
    .card-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
        transform: translateX(3px);
    }

    /* ==============================================================
       2. TABEL PERMOHONAN TERBARU & CARD WADAH
       ============================================================== */
    .dashboard-table-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        margin-top: 10px;
        overflow: hidden;
    }
    .dashboard-table-header {
        background-color: #ffffff;
        padding: 22px 28px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }
    .table-header-left h3 {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-header-left p {
        font-size: 0.88rem;
        color: #64748b;
        margin: 4px 0 0 0;
    }
    .table-header-right {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    /* Tombol Cepat Tambah & Lihat Semua */
    .btn-quick-add {
        background: linear-gradient(135deg, #004b93 0%, #1d4ed8 100%);
        color: #ffffff !important;
        border: none;
        padding: 9px 18px;
        border-radius: 9px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(0, 75, 147, 0.25);
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none !important;
    }
    .btn-quick-add:hover {
        background: linear-gradient(135deg, #003870 0%, #1e40af 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 75, 147, 0.35);
        color: #ffffff !important;
    }
    .btn-view-all {
        background: #f8fafc;
        color: #475569 !important;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 9px;
        font-size: 0.88rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .btn-view-all:hover {
        background: #e2e8f0;
        color: #1e293b !important;
    }

    /* Styling Tabel Data */
    .dashboard-table-body {
        padding: 0;
    }
    .table-modern {
        width: 100%;
        margin-bottom: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-modern thead th {
        background-color: #f8fafc;
        color: #475569;
        font-size: 0.82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        padding: 15px 20px;
        border-top: none;
        border-bottom: 1px solid #e2e8f0;
    }
    .table-modern tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-top: none;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.92rem;
        color: #334155;
    }
    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }
    .table-modern tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badges Status Modern */
    .badge-status {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.78rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        letter-spacing: 0.3px;
    }
    .badge-status-belum {
        background-color: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .badge-status-proses {
        background-color: #e0e7ff;
        color: #4338ca;
        border: 1px solid #c7d2fe;
    }
    .badge-status-sudah {
        background-color: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }
    .badge-status-ditolak {
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* Tipe Permohonan Pill */
    .tipe-permohonan-text {
        font-weight: 700;
        color: #1e293b;
        display: block;
        margin-bottom: 3px;
    }
    .isi-preview-text {
        font-size: 0.82rem;
        color: #64748b;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 320px;
    }

    /* Tombol Aksi Detail */
    .btn-detail-modern {
        background-color: #eff6ff;
        color: #004b93;
        border: 1px solid #bfdbfe;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .btn-detail-modern:hover {
        background-color: #004b93;
        color: #ffffff;
        border-color: #004b93;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(0, 75, 147, 0.2);
    }

    /* ==============================================================
       3. EMPTY STATE CONTAINER (JIKA BELUM ADA DATA)
       ============================================================== */
    .empty-state-box {
        text-align: center;
        padding: 55px 25px;
    }
    .empty-icon-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: #94a3b8;
        font-size: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 18px;
    }
    .empty-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 8px;
    }
    .empty-desc {
        font-size: 0.92rem;
        color: #64748b;
        max-width: 480px;
        margin: 0 auto 24px auto;
        line-height: 1.5;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .dashboard-table-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .table-header-right {
            width: 100%;
            justify-content: flex-start;
        }
        .btn-quick-add {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- The Blue Hero Background -->
    <div class="hero-bg-list"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-md-7 col-sm-12">
                    <h1>My Task &bull; Dashboard Pemohon</h1>
                    <p class="hero-subtitle">
                        Selamat datang kembali, <strong>{{ Auth::guard('pemohon')->user()->nama ?? 'Pemohon' }}</strong>! Pantau progres permohonan informasi Anda di sini.
                    </p>
                </div>
                <div class="col-md-5 col-sm-12 text-md-right mt-3 mt-md-0">
                    <button type="button" class="btn-quick-add" onclick="actionAddPermohonan()">
                        <i class="fas fa-plus-circle"></i> + Ajukan Permohonan Baru
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content dashboard-container">
        <div class="container-fluid">
            
            <!-- ==============================================================
                 1. 4 KARTU METRIK DINAMIS DARI DATABASE
                 ============================================================== -->
            <div class="row">
                
                <!-- KARTU 1: TOTAL PERMOHONAN -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-blue">
                        <div>
                            <div class="stat-header">
                                <div class="stat-title-wrap">
                                    <div class="stat-icon-box icon-box-blue">
                                        <i class="fas fa-folder-open"></i>
                                    </div>
                                    <div class="stat-title">Total Permohonan</div>
                                </div>
                                <span class="stat-tag tag-blue">TOTAL</span>
                            </div>
                            
                            <div class="stat-value">{{ $metric_total }}</div>
                        </div>

                        <div>
                            <div class="progress-line">
                                <div class="progress-fill fill-blue" style="width: 100%;"></div>
                            </div>
                            <a href="{{ route('user.view_permohonan') }}" class="card-link">
                                Semua riwayat pengajuan &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KARTU 2: BELUM DITANGGAPI (PENDING) -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-amber">
                        <div>
                            <div class="stat-header">
                                <div class="stat-title-wrap">
                                    <div class="stat-icon-box icon-box-amber">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-title">Belum Ditanggapi</div>
                                </div>
                                <span class="stat-tag tag-amber">PENDING</span>
                            </div>
                            
                            <div class="stat-value">{{ $metric_belum }}</div>
                        </div>

                        @php
                            $persen_belum = $metric_total > 0 ? min(100, round(($metric_belum / $metric_total) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="progress-line">
                                <div class="progress-fill fill-amber" style="width: {{ $persen_belum }}%;"></div>
                            </div>
                            <a href="{{ route('user.view_permohonan') }}" class="card-link">
                                Menunggu respon admin &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KARTU 3: SEDANG DIPROSES -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-indigo">
                        <div>
                            <div class="stat-header">
                                <div class="stat-title-wrap">
                                    <div class="stat-icon-box icon-box-indigo">
                                        <i class="fas fa-sync-alt"></i>
                                    </div>
                                    <div class="stat-title">Sedang Diproses</div>
                                </div>
                                <span class="stat-tag tag-indigo">PROSES</span>
                            </div>
                            
                            <div class="stat-value">{{ $metric_proses }}</div>
                        </div>

                        @php
                            $persen_proses = $metric_total > 0 ? min(100, round(($metric_proses / $metric_total) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="progress-line">
                                <div class="progress-fill fill-indigo" style="width: {{ $persen_proses }}%;"></div>
                            </div>
                            <a href="{{ route('user.view_permohonan') }}" class="card-link">
                                Tahap verifikasi berkas &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- KARTU 4: SELESAI -->
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-green">
                        <div>
                            <div class="stat-header">
                                <div class="stat-title-wrap">
                                    <div class="stat-icon-box icon-box-green">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="stat-title">Selesai</div>
                                </div>
                                <span class="stat-tag tag-green">SELESAI</span>
                            </div>
                            
                            <div class="stat-value">{{ $metric_selesai }}</div>
                        </div>

                        @php
                            $persen_selesai = $metric_total > 0 ? min(100, round(($metric_selesai / $metric_total) * 100)) : 0;
                        @endphp
                        <div>
                            <div class="progress-line">
                                <div class="progress-fill fill-green" style="width: {{ $persen_selesai }}%;"></div>
                            </div>
                            <a href="{{ route('user.view_permohonan') }}" class="card-link">
                                Tanggapan telah diterbitkan &rarr;
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->

            <!-- ==============================================================
                 2. TABEL PERMOHONAN TERBARU SAYA
                 ============================================================== -->
            <div class="dashboard-table-card">
                
                <!-- Card Header -->
                <div class="dashboard-table-header">
                    <div class="table-header-left">
                        <h3>
                            <i class="fas fa-history text-primary"></i> Permohonan Terbaru Saya
                        </h3>
                        <p>Daftar 5 permohonan informasi publik terakhir yang Anda ajukan</p>
                    </div>
                    
                    <div class="table-header-right">
                        <button type="button" class="btn-quick-add" onclick="actionAddPermohonan()">
                            <i class="fas fa-plus"></i> + Ajukan Permohonan Baru
                        </button>
                        <a href="{{ route('user.view_permohonan') }}" class="btn-view-all">
                            Lihat Semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Card Body / Table -->
                <div class="dashboard-table-body">
                    @if($permohonan_terbaru->isNotEmpty())
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th style="width: 50px; text-align: center;">No</th>
                                        <th>Tipe Pengajuan</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="width: 110px; text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permohonan_terbaru as $index => $item)
                                        @php
                                            // Format Tipe Permohonan
                                            if ($item->tipe_permohonan == 'Lain-Lain') {
                                                $tipe = 'Lain-Lain : ' . ($item->tipe_lainnya ?: '-');
                                            } else {
                                                $tipe = $item->tipe_permohonan ?: 'Permohonan Informasi';
                                            }

                                            // Format Tanggal
                                            $tgl = $item->created_at ? date('d M Y, H:i', strtotime($item->created_at)) : '-';

                                            // Format Status Badge
                                            $rawStatus = strtoupper($item->status ?? 'OPEN');
                                        @endphp
                                        <tr>
                                            <!-- 1. No -->
                                            <td style="text-align: center; font-weight: 700; color: #64748b;">
                                                {{ $index + 1 }}
                                            </td>

                                            <!-- 2. Tipe Pengajuan -->
                                            <td>
                                                <span class="tipe-permohonan-text">{{ $tipe }}</span>
                                                <span class="isi-preview-text" title="{{ $item->isi_permohonan }}">
                                                    {{ $item->isi_permohonan ?: 'Tidak ada deskripsi tambahan.' }}
                                                </span>
                                            </td>

                                            <!-- 3. Tanggal Pengajuan -->
                                            <td style="white-space: nowrap; color: #475569;">
                                                <i class="far fa-calendar-alt mr-1 text-primary"></i> {{ $tgl }} WIB
                                            </td>

                                            <!-- 4. Status -->
                                            <td style="text-align: center; white-space: nowrap;">
                                                @if($rawStatus === 'OPEN' || $rawStatus === 'BELUM DITANGGAPI' || $rawStatus === 'PENDING')
                                                    <span class="badge-status badge-status-belum">
                                                        <i class="fas fa-clock"></i> Belum Ditanggapi
                                                    </span>
                                                @elseif($rawStatus === 'PROCESS' || $rawStatus === 'PROSES' || $rawStatus === 'APPROVE_HALF')
                                                    <span class="badge-status badge-status-proses">
                                                        <i class="fas fa-sync-alt"></i> Sedang Diproses
                                                    </span>
                                                @elseif($rawStatus === 'APPROVE' || $rawStatus === 'SUDAH DITANGGAPI' || $rawStatus === 'SELESAI')
                                                    <span class="badge-status badge-status-sudah">
                                                        <i class="fas fa-check-circle"></i> Selesai
                                                    </span>
                                                @elseif($rawStatus === 'REJECT' || $rawStatus === 'DITOLAK')
                                                    <span class="badge-status badge-status-ditolak">
                                                        <i class="fas fa-times-circle"></i> Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge-status badge-status-belum">
                                                        {{ $item->status ?: 'OPEN' }}
                                                    </span>
                                                @endif
                                            </td>

                                            <!-- 5. Aksi Detail -->
                                            <td style="text-align: center; white-space: nowrap;">
                                                <button type="button" class="btn-detail-modern" onclick="actionDetailPermohonan({{ $item->id }})" title="Lihat Detail Permohonan">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- EMPTY STATE (JIKA BELUM ADA DATA) -->
                        <div class="empty-state-box">
                            <div class="empty-icon-circle">
                                <i class="fas fa-file-invoice"></i>
                            </div>
                            <h4 class="empty-title">Belum ada permohonan yang diajukan.</h4>
                            <p class="empty-desc">
                                Anda belum memiliki riwayat pengajuan permohonan informasi publik. Ajukan permohonan pertama Anda sekarang secara online dan terpantau secara transparan.
                            </p>
                            <button type="button" class="btn-quick-add" onclick="actionAddPermohonan()">
                                <i class="fas fa-plus"></i> + Ajukan Permohonan
                            </button>
                        </div>
                    @endif
                </div>

            </div>
            <!-- /.dashboard-table-card -->

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- ==============================================================
     MODAL UNTUK FORM DETAIL & FORM TAMBAH
     ============================================================== -->
<div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <div id="balikan"></div>
        </div>
    </div>
</div>

<script>
    // AJAX Setup Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    // Buka Modal Detail Permohonan
    function actionDetailPermohonan(id) {
        $('#modal-lg').modal('show');
        $('#balikan').html('<div class="p-5 text-center"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-2 text-muted">Memuat data permohonan...</p></div>');
        
        $.ajax({
            type: "POST",
            url: "{{ url('/') }}/user/form_editView_permohonan",
            data: {
                id: id,
                status: 'view',
                header: 'Detail Permohonan Informasi'
            },
            success: function(balikan) {
                $("#balikan").html(balikan);
            },
            error: function() {
                $("#balikan").html('<div class="p-4 text-center text-danger"><i class="fas fa-exclamation-triangle fa-2x mb-2"></i><p>Gagal memuat detail permohonan. Silakan coba kembali.</p></div>');
            }
        });
    }

    // Buka Modal Tambah Permohonan Baru
    function actionAddPermohonan() {
        $('#modal-lg').modal('show');
        $('#balikan').html('<div class="p-5 text-center"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i><p class="mt-2 text-muted">Membuka formulir permohonan...</p></div>');
        
        $.ajax({
            type: "POST",
            url: "{{ url('/') }}/user/getModalAddPermohonan",
            data: {},
            success: function(balikan) {
                $("#balikan").html(balikan);
            },
            error: function() {
                // Fallback jika terjadi kendala AJAX, arahkan langsung ke halaman permohonan
                window.location.href = "{{ route('user.view_permohonan') }}";
            }
        });
    }

    // Tangani auto reload setelah berhasil submit dari modal
    $(document).ajaxSuccess(function(event, xhr, settings) {
        if (settings.url && settings.url.indexOf('add_permohonan') !== -1) {
            setTimeout(function() {
                window.location.reload();
            }, 1200);
        }
    });
</script>
