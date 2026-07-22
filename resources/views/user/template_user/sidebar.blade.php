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
        font-size: 1rem;
        letter-spacing: 0.3px;
        line-height: 1.2;
    }
    .custom-sidebar .brand-link .brand-text span {
        display: block;
        font-size: 0.75rem;
        font-weight: 400;
        color: #64748b;
        margin-top: 4px;
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
        <i class="nav-icon fas fa-user-circle"></i>
        <div class="brand-text font-weight-light">
            {{ Auth::guard('pemohon')->user()->nama }}
            <span>{{ Auth::guard('pemohon')->user()->email }}</span>
        </div>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ url('/') }}/user" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>My Task</p>
                    </a>
                </li>
                
                <li class="nav-item has-treeview {{ Request::is('user/view_permohonan') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Request::is('user/view_permohonan') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                        Pemohon
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/') }}/user/view_permohonan" class="nav-link {{ Request::is('user/view_permohonan') ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon" style="font-size: 0.5rem; margin-top: 5px;"></i>
                            <p>Create Permohonan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-header">AKUN</li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-danger">
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
