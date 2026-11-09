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

    .content-header .breadcrumb {
        background: transparent !important;
        padding: 0;
        margin-bottom: 8px;
    }

    .content-header .breadcrumb-item a {
        color: #e0f2fe !important;
    }
    
    .content-header .breadcrumb-item.active {
        color: #ffffff !important;
        font-weight: 600;
    }

    .btn-hero-action {
        background: #ffffff !important;
        color: #004b93 !important;
        border: none !important;
        padding: 9px 20px;
        border-radius: 10px;
        font-size: 0.9rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
        cursor: pointer;
        text-decoration: none !important;
    }
    .btn-hero-action:hover {
        background: #f8fafc !important;
        color: #003366 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
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
    .card-accent-blue::before   { background: linear-gradient(90deg, #004b93, #3b82f6); }
    .card-accent-green::before  { background: linear-gradient(90deg, #16a34a, #22c55e); }
    .card-accent-red::before    { background: linear-gradient(90deg, #dc2626, #ef4444); }
    .card-accent-amber::before  { background: linear-gradient(90deg, #d97706, #f59e0b); }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .stat-header-left {
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
    .icon-box-blue   { background-color: #eff6ff; color: #004b93; }
    .icon-box-green  { background-color: #f0fdf4; color: #16a34a; }
    .icon-box-red    { background-color: #fef2f2; color: #dc2626; }
    .icon-box-amber  { background-color: #fffbeb; color: #d97706; }

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
    .tag-green  { background-color: #dcfce7; color: #15803d; }
    .tag-red    { background-color: #fee2e2; color: #b91c1c; }
    .tag-amber  { background-color: #fef3c7; color: #d97706; }
    
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
    .fill-blue   { background-color: #004b93; }
    .fill-green  { background-color: #22c55e; }
    .fill-red    { background-color: #ef4444; }
    .fill-amber  { background-color: #f59e0b; }

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
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- The Blue Hero Background -->
    <div class="hero-bg-list"></div>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row align-items-center mb-2">
                <div class="col-md-7 col-sm-12">
                    <h1 class="m-0 font-weight-bold">Dashboard &bull; Super Admin</h1>
                    <p class="hero-subtitle">Selamat Datang, <strong>{{ Auth::guard('web')->user()->name ?? 'Super Admin' }}</strong>! Pusat kontrol utama dan statistik sistem keterbukaan informasi publik PT Garam.</p>
                </div>
                <div class="col-md-5 col-sm-12 text-md-right mt-3 mt-md-0">
                    <ol class="breadcrumb float-md-right mb-2">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Super Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="clearfix"></div>
                    <a href="{{ route('super_admin.view_admin') }}" class="btn btn-hero-action">
                        <i class="fas fa-user-plus"></i> + Tambah Admin Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content dashboard-container">
        <div class="container-fluid">
            
            <!-- 4 Metric Cards -->
            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-blue">
                        <div>
                            <div class="stat-header">
                                <div class="stat-header-left">
                                    <div class="stat-icon-box icon-box-blue">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <div class="stat-title">Total User Admin</div>
                                </div>
                                <span class="stat-tag tag-blue">TOTAL</span>
                            </div>
                            <div class="stat-value">{{ $total_admin }}</div>
                            <div class="progress-line">
                                <div class="progress-fill fill-blue" style="width: 100%;"></div>
                            </div>
                        </div>
                        <a href="{{ route('super_admin.view_admin') }}" class="card-link">
                            <span>Kelola data admin</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Admin Aktif -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-green">
                        <div>
                            <div class="stat-header">
                                <div class="stat-header-left">
                                    <div class="stat-icon-box icon-box-green">
                                        <i class="fas fa-user-check"></i>
                                    </div>
                                    <div class="stat-title">Admin Aktif</div>
                                </div>
                                <span class="stat-tag tag-green">AKTIF</span>
                            </div>
                            <div class="stat-value">{{ $admin_aktif }}</div>
                            <div class="progress-line">
                                @php
                                    $pct_aktif = ($total_admin > 0) ? round(($admin_aktif / $total_admin) * 100) : 0;
                                @endphp
                                <div class="progress-fill fill-green" style="width: {{ $pct_aktif }}%;"></div>
                            </div>
                        </div>
                        <a href="{{ route('super_admin.view_admin') }}" class="card-link" style="color: #16a34a;">
                            <span>Lihat akun aktif</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Admin Nonaktif -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-red">
                        <div>
                            <div class="stat-header">
                                <div class="stat-header-left">
                                    <div class="stat-icon-box icon-box-red">
                                        <i class="fas fa-user-slash"></i>
                                    </div>
                                    <div class="stat-title">Admin Nonaktif</div>
                                </div>
                                <span class="stat-tag tag-red">NONAKTIF</span>
                            </div>
                            <div class="stat-value">{{ $admin_nonaktif }}</div>
                            <div class="progress-line">
                                @php
                                    $pct_nonaktif = ($total_admin > 0) ? round(($admin_nonaktif / $total_admin) * 100) : 0;
                                @endphp
                                <div class="progress-fill fill-red" style="width: {{ $pct_nonaktif }}%;"></div>
                            </div>
                        </div>
                        <a href="{{ route('super_admin.view_admin') }}" class="card-link" style="color: #dc2626;">
                            <span>Tinjau nonaktif</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Total Pemohon -->
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="metric-card card-accent-amber">
                        <div>
                            <div class="stat-header">
                                <div class="stat-header-left">
                                    <div class="stat-icon-box icon-box-amber">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <div class="stat-title">Total Pemohon</div>
                                </div>
                                <span class="stat-tag tag-amber">PEMOHON</span>
                            </div>
                            <div class="stat-value">{{ $total_pemohon }}</div>
                            <div class="progress-line">
                                <div class="progress-fill fill-amber" style="width: 100%;"></div>
                            </div>
                        </div>
                        <a href="{{ route('super_admin.view_pemohon') }}" class="card-link" style="color: #d97706;">
                            <span>Kelola pemohon</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row Stat Cards -->

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
