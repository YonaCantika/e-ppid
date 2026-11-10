<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-PPID | Super Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/dist/css/adminlte.min.css">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    /* ─── Super Admin Theme: Corporate PT Garam Navy ─────────────── */
    :root {
      --sa-primary: #004b93;
      --sa-primary-dark: #0f3964;
      --sa-accent: #1d4ed8;
      --sa-accent-light: #e0f2fe;
      --sa-text-light: #e0f2fe;
      --sa-bg: #f4f6f9;
    }

    body { background-color: var(--sa-bg); font-family: 'Inter', 'Source Sans Pro', sans-serif; }

    /* Sidebar */
    .main-sidebar.sa-sidebar {
        background-color: #ffffff;
        box-shadow: 4px 0 24px rgba(0,0,0,0.04) !important;
        border-right: 1px solid #f1f5f9;
    }
    .sa-sidebar .brand-link {
        border-bottom: 1px solid #f1f5f9 !important;
        color: #1e293b !important;
        padding: 22px 1rem;
        display: flex;
        align-items: center;
    }
    .sa-sidebar .brand-link .brand-badge {
        background: #004b93;
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        margin-left: 6px;
        vertical-align: middle;
    }
    .sa-sidebar .nav-sidebar .nav-item .nav-link {
        border-radius: 10px;
        color: #64748b;
        margin: 6px 12px;
        padding: 12px 15px;
        transition: all 0.2s ease;
    }
    .sa-sidebar .nav-sidebar .nav-item .nav-link p {
        font-weight: 600;
        font-size: 0.95rem;
    }
    .sa-sidebar .nav-sidebar .nav-item .nav-link:hover {
        background-color: #f0f7ff;
        color: #004b93;
    }
    .sa-sidebar .nav-sidebar .nav-item .nav-link.active, 
    .sa-sidebar .nav-sidebar .nav-item .nav-link.active:hover {
        background-color: #e0f2fe !important;
        color: #004b93 !important;
        box-shadow: none !important;
    }
    .sa-sidebar .nav-icon { 
        color: inherit; 
        font-size: 1.2rem;
        margin-right: 12px;
        transition: color 0.2s ease;
    }
    .sa-sidebar .nav-header {
        color: #94a3b8;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 10px 20px 5px;
        text-transform: uppercase;
    }

    /* Navbar */
    .main-header.sa-header {
      background: #ffffff;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      border-bottom: 1px solid #e2e8f0;
    }
    .sa-header .sa-role-badge {
      background: linear-gradient(135deg, var(--sa-primary-dark), var(--sa-primary));
      color: #fff;
      font-size: 0.7rem;
      font-weight: 700;
      padding: 4px 10px;
      border-radius: 20px;
      letter-spacing: 0.5px;
    }

    /* Stat Cards */
    .sa-stat-card {
      border-radius: 14px;
      border: none;
      box-shadow: 0 4px 20px rgba(0,0,0,0.07);
      overflow: hidden;
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .sa-stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 28px rgba(0,0,0,0.12);
    }
    .sa-stat-card .sa-card-icon {
      font-size: 2.5rem;
      opacity: 0.85;
    }
    .sa-stat-primary { background: linear-gradient(135deg, #004b93, #1d4ed8); color: #fff; }
    .sa-stat-success { background: linear-gradient(135deg, #059669, #34d399); color: #fff; }
    .sa-stat-danger  { background: linear-gradient(135deg, #dc2626, #f87171); color: #fff; }
    .sa-stat-warning { background: linear-gradient(135deg, #d97706, #fbbf24); color: #fff; }

    /* ─── Global Navy Hero Banner & SaaS Layout ─────────────────── */
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        position: relative;
    }
    .hero-bg-list, .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 220px;
        background: linear-gradient(135deg, #0f3964 0%, #004b93 50%, #1d4ed8 100%) !important;
        border-bottom-left-radius: 30px !important;
        border-bottom-right-radius: 30px !important;
        z-index: 0;
        box-shadow: 0 4px 20px rgba(0, 75, 147, 0.2);
    }
    .content-header {
        position: relative;
        z-index: 2;
        padding-top: 25px;
        padding-bottom: 20px;
    }
    .content-header h1 {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.65rem;
        margin: 0;
        line-height: 1.2;
    }
    .content-header .hero-subtitle {
        color: #e0f2fe !important;
        font-size: 0.95rem;
        margin-top: 6px;
        margin-bottom: 0;
    }
    .content-header .breadcrumb {
        background: transparent !important;
        padding: 0;
        margin-bottom: 10px;
    }
    .content-header .breadcrumb-item, 
    .content-header .breadcrumb-item a {
        color: #e0f2fe !important;
        font-size: 0.88rem;
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
    /* Card Overlay over the Curved Banner */
    section.content, .dashboard-container {
        position: relative;
        z-index: 2;
        margin-top: 5px;
        padding-bottom: 40px;
    }
    .card {
        border-radius: 12px !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.02) !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
    }
    .card-header {
        background-color: #fff !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-radius: 12px 12px 0 0 !important;
        padding: 18px 24px !important;
    }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
  </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- ── Navbar ───────────────────────────────────────────────── -->
  <nav class="main-header navbar navbar-expand navbar-white sa-header">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
          <i class="fas fa-bars" style="color: var(--sa-primary);"></i>
        </a>
      </li>
    </ul>

    <span class="ml-3 font-weight-bold" style="color: var(--sa-primary-dark);">
      <i class="fas fa-shield-alt mr-1" style="color: var(--sa-accent);"></i>
      {{ $judul_header ?? 'SUPER ADMIN PANEL' }}
    </span>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-flex align-items-center">
        <strong style="color: var(--sa-primary); margin-right: 15px;">{{ Auth::guard('web')->user()->name ?? 'Super Admin' }}</strong>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

