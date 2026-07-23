<style>
    /* Reference Design Overrides */
    body, .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
    }
    .content-header {
        position: relative;
        z-index: 2;
        padding-top: 30px;
    }
    .content-header h1 {
        color: #fff;
        font-weight: 700;
        font-size: 1.8rem;
    }
    .content-header .breadcrumb-item a,
    .content-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    
    /* The Blue Hero Background */
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 200px;
        background: #5a5ce2;
        border-bottom-left-radius: 30px;
        z-index: 0;
    }

    /* Cards Layout matching reference */
    .dashboard-container {
        position: relative;
        z-index: 2;
        margin-top: 10px;
    }
    
    .ref-card {
        background: #fff;
        border-radius: 16px;
        padding: 15px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        position: relative;
    }

    /* Stat Cards */
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .stat-title {
        color: #7b8398;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .stat-tag {
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 700;
    }
    .tag-blue { background-color: #e5edff; color: #5a5ce2; }
    .tag-green { background-color: #dcfce7; color: #22c55e; }
    .tag-red { background-color: #fee2e2; color: #ef4444; }
    .tag-yellow { background-color: #fef3c7; color: #f59e0b; }
    
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    /* Progress bars */
    .progress-line {
        height: 6px;
        border-radius: 3px;
        background-color: #f1f5f9;
        position: relative;
        overflow: hidden;
    }
    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 3px;
    }
    .fill-blue { background-color: #3b82f6; width: 90%; }
    .fill-green { background-color: #22c55e; width: 75%; }
    .fill-red { background-color: #ef4444; width: 30%; }
    .fill-yellow { background-color: #f59e0b; width: 60%; }

    /* Chart Cards */
    .chart-card {
        background: #dbeafe;
        border-radius: 16px;
        padding: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #bfdbfe;
        margin-bottom: 20px;
    }
    .chart-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .chart-title {
        color: #7b8398;
        font-size: 0.9rem;
        font-weight: 600;
    }
</style>

<!-- Content Wrapper -->
<div class="content-wrapper" style="position: relative;">
    <!-- The Blue Hero Background -->
    <div class="hero-bg"></div>

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                    <p style="color: rgba(255,255,255,0.8); margin-top: 5px;">Selamat Datang, <strong>{{ Auth::guard('web')->user()->name ?? 'Super Admin' }}</strong>!</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Super Admin</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content dashboard-container">
        <div class="container-fluid">
            
            <!-- Stat Cards -->
            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('super_admin.view_admin') }}" class="text-decoration-none">
                        <div class="ref-card h-100" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)';" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                            <div class="stat-header">
                                <div class="stat-title">Total User Admin</div>
                                <div class="stat-tag tag-blue">TOTAL</div>
                            </div>
                            <div class="stat-value">{{ $total_admin }}</div>
                            <div class="progress-line">
                                <div class="progress-fill fill-blue"></div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Admin Aktif -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="ref-card h-100">
                        <div class="stat-header">
                            <div class="stat-title">Admin Aktif</div>
                            <div class="stat-tag tag-green">AKTIF</div>
                        </div>
                        <div class="stat-value">{{ $admin_aktif }}</div>
                        <div class="progress-line">
                            <div class="progress-fill fill-green"></div>
                        </div>
                    </div>
                </div>

                <!-- Admin Nonaktif -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="ref-card h-100">
                        <div class="stat-header">
                            <div class="stat-title">Admin Nonaktif</div>
                            <div class="stat-tag tag-red">NONAKTIF</div>
                        </div>
                        <div class="stat-value">{{ $admin_nonaktif }}</div>
                        <div class="progress-line">
                            <div class="progress-fill fill-red"></div>
                        </div>
                    </div>
                </div>

                <!-- Total Pemohon -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('super_admin.view_pemohon') }}" class="text-decoration-none">
                        <div class="ref-card h-100" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)';" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)';">
                            <div class="stat-header">
                                <div class="stat-title">Total Pemohon</div>
                                <div class="stat-tag tag-yellow">PEMOHON</div>
                            </div>
                            <div class="stat-value">{{ $total_pemohon }}</div>
                            <div class="progress-line">
                                <div class="progress-fill fill-yellow"></div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.row Stat Cards -->

            <!-- Quick Access Cards -->
            <div class="row mt-2">
                <div class="col-lg-4 col-md-4 mb-4">
                     <a href="{{ route('super_admin.view_admin') }}" class="text-decoration-none">
                         <div class="chart-card d-flex align-items-center" style="transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                             <div style="width: 50px; height: 50px; border-radius: 50%; background: #60a5fa; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                 <i class="fas fa-user-shield text-white"></i>
                             </div>
                             <div>
                                 <div style="color: #1e293b; font-weight: 600; font-size: 1rem;">Tambah Admin Baru</div>
                                 <div style="color: #475569; font-size: 0.8rem;">Buat akun user admin</div>
                             </div>
                         </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                     <a href="{{ route('super_admin.view_pemohon') }}" class="text-decoration-none">
                         <div class="chart-card d-flex align-items-center" style="background: #eef2ff; border-color: #c7d2fe; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                             <div style="width: 50px; height: 50px; border-radius: 50%; background: #a855f7; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                 <i class="fas fa-users text-white"></i>
                             </div>
                             <div>
                                 <div style="color: #1e293b; font-weight: 600; font-size: 1rem;">Kelola Pemohon</div>
                                 <div style="color: #475569; font-size: 0.8rem;">Aktifkan/nonaktifkan akun</div>
                             </div>
                         </div>
                     </a>
                </div>
                <div class="col-lg-4 col-md-4 mb-4">
                     <a href="{{ url('/admin') }}" class="text-decoration-none">
                         <div class="chart-card d-flex align-items-center" style="background: #f0fdf4; border-color: #bbf7d0; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';" onmouseout="this.style.transform=''; this.style.boxShadow='';">
                             <div style="width: 50px; height: 50px; border-radius: 50%; background: #22c55e; display: flex; align-items: center; justify-content: center; margin-right: 15px;">
                                 <i class="fas fa-tools text-white"></i>
                             </div>
                             <div>
                                 <div style="color: #1e293b; font-weight: 600; font-size: 1rem;">Panel Admin</div>
                                 <div style="color: #475569; font-size: 0.8rem;">Jawab & kelola permohonan</div>
                             </div>
                         </div>
                     </a>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
