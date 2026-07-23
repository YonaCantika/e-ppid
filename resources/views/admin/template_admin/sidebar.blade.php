<style>
    /* Modern Sidebar Customization */
    .main-sidebar.custom-sidebar {
        background-color: #ffffff;
        box-shadow: 4px 0 24px rgba(0,0,0,0.04) !important;
        border-right: 1px solid #f1f5f9;
    }
    .custom-sidebar .brand-link {
        border-bottom: 1px solid #f1f5f9 !important;
        color: #1e293b !important;
        padding: 22px 1rem;
        display: flex;
        align-items: center;
    }
    .custom-sidebar .brand-link .nav-icon {
        color: #5a5ce2;
        font-size: 1.5rem;
        margin-right: 12px;
    }
    .custom-sidebar .brand-link .brand-text {
        font-weight: 700;
        font-size: 1.1rem;
        letter-spacing: 0.3px;
    }
    
    .custom-sidebar .sidebar {
        padding-top: 15px;
    }
    
    .custom-sidebar .nav-sidebar .nav-item .nav-link {
        border-radius: 10px;
        color: #64748b;
        margin: 6px 12px;
        padding: 12px 15px;
        transition: all 0.2s ease;
    }
    .custom-sidebar .nav-sidebar .nav-item .nav-link p {
        font-weight: 600;
        font-size: 0.95rem;
    }
    .custom-sidebar .nav-sidebar .nav-item .nav-link:hover {
        background-color: #f8fafc;
        color: #5a5ce2;
    }
    .custom-sidebar .nav-sidebar .nav-item .nav-link.active, 
    .custom-sidebar .nav-sidebar .nav-item .nav-link.active:hover {
        background-color: #eef2ff !important;
        color: #5a5ce2 !important;
        box-shadow: none !important;
    }
    .custom-sidebar .nav-sidebar .nav-icon {
        color: inherit;
        font-size: 1.2rem;
        margin-right: 12px;
        transition: color 0.2s ease;
    }
    
    .custom-sidebar .nav-treeview .nav-link {
        padding-left: 45px !important;
        margin: 2px 12px !important;
    }
    
    .custom-sidebar .nav-header {
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 10px 20px 5px;
        text-transform: uppercase;
    }
</style>

<!-- Main Sidebar Container -->
<aside class="main-sidebar custom-sidebar elevation-0">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <i class="nav-icon fas fa-layer-group"></i>
        <span class="brand-text font-weight-light">E-PPID Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @php
                    use App\Helpers\MenuHelper;
                    use Illuminate\Support\Facades\Auth;
                    $currentUserId   = Auth::guard('web')->id();
                    $currentUserRole = Auth::guard('web')->user()->role ?? 'admin';
                    // Super Admin selalu bisa lihat semua menu
                    $blockedMenus = $currentUserRole === 'super_admin'
                        ? []
                        : MenuHelper::getBlockedAdminMenus($currentUserId);
                @endphp

                {{-- My Task --}}
                @if(!in_array('mytask', $blockedMenus))
                <li class="nav-item">
                    <a href="{{ url('/') }}/admin" class="nav-link {{ Request::is('admin') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>My Task</p>
                    </a>
                </li>
                @endif

                {{-- Daftar Permohonan --}}
                @if(!in_array('permohonan', $blockedMenus))
                <li class="nav-item has-treeview {{ Request::is('admin/view_permohonan') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('admin/view_permohonan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>
                        Daftar Permohonan
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/') }}/admin/view_permohonan" class="nav-link {{ Request::is('admin/view_permohonan') ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon" style="font-size: 0.5rem; margin-top: 5px;"></i>
                            <p>Jawab Permohonan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                {{-- Daftar Pemohon --}}
                @if(!in_array('pemohon_list', $blockedMenus))
                <li class="nav-item">
                    <a href="{{ url('/') }}/admin/view_pemohon" class="nav-link {{ Request::is('admin/view_pemohon') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Pemohon</p>
                    </a>
                </li>
                @endif

                {{-- Manajemen Menu Website --}}
                @if(!in_array('view_menu', $blockedMenus))
                <li class="nav-item">
                    <a href="{{ url('/') }}/admin/view_menu" class="nav-link {{ Request::is('admin/view_menu') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Manajemen Menu</p>
                    </a>
                </li>
                @endif

                <li class="nav-header">AKUN</li>

                @if(Auth::guard('web')->user() && Auth::guard('web')->user()->role === 'super_admin')
                <li class="nav-item">
                    <a href="{{ route('super_admin.dashboard') }}"
                       class="nav-link"
                       style="background: linear-gradient(135deg, rgba(245,158,11,0.18), rgba(245,158,11,0.08));
                              border: 1px solid rgba(245,158,11,0.35); color: #92400e !important;">
                        <i class="nav-icon fas fa-crown" style="color: #f59e0b;"></i>
                        <p style="font-weight: 700;">Super Admin Panel</p>
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ url('secure/logout') }}" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>
