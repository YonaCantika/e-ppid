<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="color: #312e81; font-weight: 700;">
                        <i class="fas fa-tachometer-alt mr-2" style="color: #f59e0b;"></i>Dashboard
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Super Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Welcome Banner -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card" style="background: linear-gradient(135deg, #312e81 0%, #4338ca 60%, #6366f1 100%);
                                             border: none; border-radius: 16px; overflow: hidden;">
                        <div class="card-body py-4 px-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h2 class="text-white font-weight-bold mb-1">
                                        Selamat Datang, {{ Auth::guard('web')->user()->name ?? 'Super Admin' }}!
                                    </h2>
                                    <p class="text-white mb-0" style="opacity: 0.8;">
                                        Anda login sebagai <strong>Super Admin</strong> — memiliki akses penuh ke seluruh sistem E-PPID PT Garam (Persero).
                                    </p>
                                </div>
                                <div class="col-md-4 text-right d-none d-md-block">
                                    <i class="fas fa-crown" style="font-size: 5rem; color: rgba(245,158,11,0.4);"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stat Cards -->
            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card sa-stat-card sa-stat-primary">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <p class="mb-1" style="opacity:0.85; font-size:0.85rem; font-weight:600; letter-spacing:0.5px;">
                                    TOTAL USER ADMIN
                                </p>
                                <h2 class="m-0 font-weight-bold" style="font-size: 2.4rem;">{{ $total_admin }}</h2>
                            </div>
                            <div class="sa-card-icon">
                                <i class="fas fa-user-shield"></i>
                            </div>
                        </div>
                        <div class="card-footer" style="background: rgba(0,0,0,0.15); border:none; padding: 8px 16px;">
                            <a href="{{ route('super_admin.view_admin') }}" class="text-white" style="font-size:0.82rem;">
                                <i class="fas fa-arrow-right mr-1"></i> Kelola Admin
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Admin Aktif -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card sa-stat-card sa-stat-success">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <p class="mb-1" style="opacity:0.85; font-size:0.85rem; font-weight:600; letter-spacing:0.5px;">
                                    ADMIN AKTIF
                                </p>
                                <h2 class="m-0 font-weight-bold" style="font-size: 2.4rem;">{{ $admin_aktif }}</h2>
                            </div>
                            <div class="sa-card-icon">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="card-footer" style="background: rgba(0,0,0,0.15); border:none; padding: 8px 16px;">
                            <small class="text-white" style="font-size:0.82rem;">
                                <i class="fas fa-circle mr-1"></i> Dapat Login
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Admin Nonaktif -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card sa-stat-card sa-stat-danger">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <p class="mb-1" style="opacity:0.85; font-size:0.85rem; font-weight:600; letter-spacing:0.5px;">
                                    ADMIN NONAKTIF
                                </p>
                                <h2 class="m-0 font-weight-bold" style="font-size: 2.4rem;">{{ $admin_nonaktif }}</h2>
                            </div>
                            <div class="sa-card-icon">
                                <i class="fas fa-user-times"></i>
                            </div>
                        </div>
                        <div class="card-footer" style="background: rgba(0,0,0,0.15); border:none; padding: 8px 16px;">
                            <small class="text-white" style="font-size:0.82rem;">
                                <i class="fas fa-ban mr-1"></i> Login Diblokir
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Total Pemohon -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card sa-stat-card sa-stat-warning">
                        <div class="card-body d-flex justify-content-between align-items-center p-4">
                            <div>
                                <p class="mb-1" style="opacity:0.85; font-size:0.85rem; font-weight:600; letter-spacing:0.5px;">
                                    TOTAL PEMOHON
                                </p>
                                <h2 class="m-0 font-weight-bold" style="font-size: 2.4rem;">{{ $total_pemohon }}</h2>
                            </div>
                            <div class="sa-card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="card-footer" style="background: rgba(0,0,0,0.15); border:none; padding: 8px 16px;">
                            <a href="{{ route('super_admin.view_pemohon') }}" class="text-white" style="font-size:0.82rem;">
                                <i class="fas fa-arrow-right mr-1"></i> Kelola Pemohon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row Stat Cards -->

            <!-- Quick Access Cards -->
            <div class="row mt-2">
                <div class="col-12">
                    <h5 class="font-weight-bold mb-3" style="color: #312e81;">
                        <i class="fas fa-bolt mr-2" style="color: #f59e0b;"></i>Akses Cepat
                    </h5>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('super_admin.view_admin') }}" class="text-decoration-none">
                        <div class="card h-100" style="border-left: 4px solid #4338ca; border-radius: 10px;
                                                       transition: transform 0.2s, box-shadow 0.2s;"
                             onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';"
                             onmouseout="this.style.transform=''; this.style.boxShadow='';">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div style="width:48px; height:48px; border-radius:12px;
                                                background:#eef2ff; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                        <i class="fas fa-user-plus" style="color:#4338ca; font-size:1.2rem;"></i>
                                    </div>
                                    <div>
                                        <p class="m-0 font-weight-bold" style="color:#1e293b;">Tambah Admin Baru</p>
                                        <small style="color:#94a3b8;">Buat akun user admin</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ route('super_admin.view_pemohon') }}" class="text-decoration-none">
                        <div class="card h-100" style="border-left: 4px solid #059669; border-radius: 10px;
                                                       transition: transform 0.2s, box-shadow 0.2s;"
                             onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';"
                             onmouseout="this.style.transform=''; this.style.boxShadow='';">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div style="width:48px; height:48px; border-radius:12px;
                                                background:#ecfdf5; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                        <i class="fas fa-toggle-on" style="color:#059669; font-size:1.2rem;"></i>
                                    </div>
                                    <div>
                                        <p class="m-0 font-weight-bold" style="color:#1e293b;">Kelola Pemohon</p>
                                        <small style="color:#94a3b8;">Aktifkan/nonaktifkan akun</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="{{ url('/admin') }}" class="text-decoration-none">
                        <div class="card h-100" style="border-left: 4px solid #d97706; border-radius: 10px;
                                                       transition: transform 0.2s, box-shadow 0.2s;"
                             onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)';"
                             onmouseout="this.style.transform=''; this.style.boxShadow='';">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div style="width:48px; height:48px; border-radius:12px;
                                                background:#fef3c7; display:flex; align-items:center; justify-content:center; margin-right:14px;">
                                        <i class="fas fa-tools" style="color:#d97706; font-size:1.2rem;"></i>
                                    </div>
                                    <div>
                                        <p class="m-0 font-weight-bold" style="color:#1e293b;">Panel Admin</p>
                                        <small style="color:#94a3b8;">Jawab & kelola permohonan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->
