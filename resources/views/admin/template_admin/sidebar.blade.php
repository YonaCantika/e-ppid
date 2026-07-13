
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <i class="nav-icon fas fa-user-alt"></i>
        <span class="brand-text font-weight-light">{{ Auth::guard('web')->user()->name ?? 'Admin' }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="{{ url('/') }}/admin" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                        My Task
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                        Daftar Permohonan
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/') }}/admin/view_permohonan" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Jawab Permohonan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="{{ url('/') }}/admin/view_pemohon" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                        Pemohon
                        <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                </li>
            </ul>

        </nav>
    <!-- /.sidebar-menu -->
    </div>
<!-- /.sidebar -->
</aside>




