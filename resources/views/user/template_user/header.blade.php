<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>E-PPID PT Garam</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/datatables-select/css/select.bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/assets_user/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  </script>
  <!-- Custom Modern Form Styles -->
  <style>
    /* Modern Form Controls */
    .form-control, .custom-select {
        background-color: #eef2f6 !important;
        border: 1px solid #eef2f6 !important;
        border-radius: 8px !important;
        color: #334155 !important;
        padding: 10px 15px !important;
        height: auto !important;
        box-shadow: none !important;
        transition: all 0.2s ease-in-out;
    }
    .form-control:focus, .custom-select:focus {
        background-color: #fff !important;
        border: 1px solid #3b82f6 !important;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
    }
    .form-control:disabled, .custom-select:disabled {
        background-color: #e2e8f0 !important;
        opacity: 0.8;
    }
    
    /* Modern Labels */
    label {
        font-weight: 600 !important;
        color: #1e293b !important;
        margin-bottom: 8px !important;
        font-size: 0.95rem;
    }
    
    /* Modern Cards */
    .card {
        border-radius: 12px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
        border: none !important;
    }
    .card-header {
        background-color: #fff !important;
        border-bottom: 1px solid #f1f5f9 !important;
        border-radius: 12px 12px 0 0 !important;
    }
    
    /* Modern Modals */
    .modal-content {
        border-radius: 16px !important;
        border: none !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
    }
    .modal-header {
        border-bottom: 1px solid #f1f5f9 !important;
        background-color: #fff !important;
        border-radius: 16px 16px 0 0 !important;
        padding: 20px 24px !important;
    }
    .modal-footer {
        border-top: 1px solid #f1f5f9 !important;
        background-color: #f8fafc !important;
        border-radius: 0 0 16px 16px !important;
        padding: 16px 24px !important;
    }
    .modal-title {
        font-weight: 700 !important;
        color: #1e293b !important;
    }
    
    /* Modern Tables inside forms */
    .table-bordered {
        border: 1px solid #f1f5f9 !important;
        border-radius: 8px !important;
        overflow: hidden;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #f1f5f9 !important;
    }
    .table thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 600 !important;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        padding: 12px 16px !important;
        border-bottom: none !important;
    }
    .table tbody td {
        padding: 12px 16px !important;
        color: #334155 !important;
        vertical-align: middle !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
<!--       <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/') }}/assets_user/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <!-- JUDUL FORN -->
    <B>{{ $judul_header }}</B>

    <!-- SEARCH FORM -->
   <!--     <form class="form-inline ml-3">
         <div class="input-group input-group-sm">
           <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
           <div class="input-group-append">
             <button class="btn btn-navbar" type="submit">
               <i class="fas fa-search"></i>
             </button>
           </div>
         </div>
       </form> -->

    <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->

    </ul> 
  </nav>
  <!-- /.navbar -->





