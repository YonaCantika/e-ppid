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
    /* ─── Super Admin Theme: Deep Indigo + Gold Accent ─────────────── */
    :root {
      --sa-primary: #3730a3;
      --sa-primary-dark: #312e81;
      --sa-accent: #f59e0b;
      --sa-accent-light: #fef3c7;
      --sa-text-light: #e0e7ff;
      --sa-bg: #f1f5f9;
    }

    body { background-color: var(--sa-bg); font-family: 'Source Sans Pro', sans-serif; }

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
        background: var(--sa-accent);
        color: #000;
        font-size: 0.6rem;
        font-weight: 700;
        padding: 2px 6px;
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
        background-color: #f8fafc;
        color: #5a5ce2;
    }
    .sa-sidebar .nav-sidebar .nav-item .nav-link.active, 
    .sa-sidebar .nav-sidebar .nav-item .nav-link.active:hover {
        background-color: #eef2ff !important;
        color: #5a5ce2 !important;
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
      background: #fff;
      box-shadow: 0 2px 12px rgba(0,0,0,0.06);
      border-bottom: 2px solid var(--sa-accent);
    }
    .sa-header .sa-role-badge {
      background: linear-gradient(135deg, var(--sa-primary), var(--sa-primary-dark));
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
    .sa-stat-primary { background: linear-gradient(135deg, #4338ca, #6366f1); color: #fff; }
    .sa-stat-success { background: linear-gradient(135deg, #059669, #34d399); color: #fff; }
    .sa-stat-danger  { background: linear-gradient(135deg, #dc2626, #f87171); color: #fff; }
    .sa-stat-warning { background: linear-gradient(135deg, #d97706, #fbbf24); color: #fff; }

    /* Content area */
    .content-wrapper { background-color: var(--sa-bg); }

    /* Table (Styles moved to individual views to match Dashboard aesthetics) */

    /* Buttons */
    .btn-super-add {
      background: linear-gradient(135deg, var(--sa-accent), #d97706);
      border: none;
      color: #1e1b4b;
      font-weight: 700;
      border-radius: 8px;
      padding: 8px 18px;
      box-shadow: 0 4px 12px rgba(245,158,11,0.3);
      transition: all 0.2s;
    }
    .btn-super-add:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(245,158,11,0.4); }
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

