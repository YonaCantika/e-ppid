<!-- ── Main Sidebar ─────────────────────────────────────────────── -->
<aside class="main-sidebar sa-sidebar elevation-0">
    <!-- Brand Logo -->
    <a href="{{ route('super_admin.dashboard') }}" class="brand-link">
        <i class="fas fa-shield-alt mr-2" style="color: #f59e0b; font-size:1.3rem;"></i>
        <span class="brand-text font-weight-bold" style="color:#fff;">
            E-PPID
            <span class="brand-badge">SUPER ADMIN</span>
        </span>
    </a>

    <!-- Sidebar content -->
    <div class="sidebar">
        <!-- User panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid rgba(255,255,255,0.1);">
            <div class="image">
                <div style="width:34px; height:34px; border-radius:50%; background:rgba(245,158,11,0.25);
                            display:flex; align-items:center; justify-content:center;">
                    <i class="fas fa-crown" style="color:#f59e0b; font-size:1rem;"></i>
                </div>
            </div>
            <div class="info">
                <a href="#" class="d-block" style="color: #e0e7ff; font-weight:600; font-size:0.9rem;">
                    {{ Auth::guard('web')->user()->name ?? 'Super Admin' }}
                </a>
                <small style="color: rgba(255,255,255,0.45); font-size:0.75rem;">Full Access</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('super_admin.dashboard') }}"
                       class="nav-link {{ Request::is('super-admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MANAJEMEN</li>

                <!-- Manajemen Admin -->
                <li class="nav-item">
                    <a href="{{ route('super_admin.view_admin') }}"
                       class="nav-link {{ Request::is('super-admin/view_admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>User Admin</p>
                    </a>
                </li>

                <!-- Manajemen Pemohon -->
                <li class="nav-item">
                    <a href="{{ route('super_admin.view_pemohon') }}"
                       class="nav-link {{ Request::is('super-admin/view_pemohon') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Akun Pemohon</p>
                    </a>
                </li>

                <li class="nav-header">AKSES ADMIN</li>

                <!-- Link ke panel Admin biasa -->
                <li class="nav-item">
                    <a href="{{ url('/admin') }}" class="nav-link">
                        <i class="nav-icon fas fa-external-link-alt"></i>
                        <p>Panel Admin</p>
                    </a>
                </li>

                <li class="nav-header">AKUN</li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="{{ url('secure/logout') }}" class="nav-link" style="color: #fca5a5 !important;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
