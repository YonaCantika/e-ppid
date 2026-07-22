<style>
    /* Match Dashboard Aesthetics */
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
        position: relative;
    }
    
    /* The Blue Hero Background */
    .hero-bg-list {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 180px;
        background: #5a5ce2;
        border-bottom-left-radius: 30px;
        z-index: 0;
    }

    /* Content container */
    .content-header, .content {
        position: relative;
        z-index: 2;
    }
    
    .content-header {
        padding-top: 25px;
    }
    
    .content-header h1 {
        color: #ffffff !important;
        font-weight: 600;
        font-size: 1.5rem;
    }

    .content-header .breadcrumb-item a {
        color: #ffffff !important;
    }
    
    .content-header .breadcrumb-item.active {
        color: #e2e8f0 !important;
    }

    /* Cards Layout matching reference */
    .dashboard-container {
        position: relative;
        z-index: 2;
        margin-top: 10px;
    }
    
    .ref-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: calc(100% - 20px);
    }

    /* Stat Cards */
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    .stat-title {
        color: #7b8398;
        font-size: 0.95rem;
        font-weight: 600;
    }
    .stat-tag {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
    }
    .tag-blue { background-color: #e5edff; color: #5a5ce2; }
    .tag-green { background-color: #dcfce7; color: #22c55e; }
    
    .stat-value {
        font-size: 2.2rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 15px;
    }

    /* Progress bars */
    .progress-line {
        height: 6px;
        border-radius: 3px;
        background-color: #f1f5f9;
        position: relative;
        overflow: hidden;
        margin-bottom: 15px;
    }
    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 3px;
    }
    .fill-blue { background-color: #3b82f6; width: 70%; }
    .fill-green { background-color: #22c55e; width: 100%; }

    .card-link {
        font-size: 0.9rem;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: color 0.2s;
        margin-top: auto;
    }
    .card-link:hover {
        color: #2563eb;
    }
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- The Blue Hero Background -->
    <div class="hero-bg-list"></div>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Task</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">My Task</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content dashboard-container">
      <div class="container-fluid">
        <div class="row justify-content-start">
          
          <div class="col-lg-4 col-md-6">
            <div class="ref-card">
              <div class="stat-header">
                  <div class="stat-title">Permohonan Belum Ditanggapi</div>
                  <div class="stat-tag tag-blue">PENDING</div>
              </div>
              <?php
              $id_pemohon = Auth::guard('pemohon')->id(); 
              $tot_blm_ditanggapi = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) blm FROM informasi_permohonan WHERE id_pemohon = '$id_pemohon' AND status = 'OPEN'"))->first();
              ?>
              <div class="stat-value">{{ $tot_blm_ditanggapi->blm }}</div>
              
              <div class="progress-line">
                  <div class="progress-fill fill-blue"></div>
              </div>
              
              <a href="{{ url('/') }}/user/view_permohonan" class="card-link">Lihat detail &rarr;</a>
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6">
            <div class="ref-card">
              <div class="stat-header">
                  <div class="stat-title">Total Permohonan</div>
                  <div class="stat-tag tag-green">TOTAL</div>
              </div>
              <?php
              $tot_permohonan = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) permohonan FROM informasi_permohonan WHERE id_pemohon = '".Auth::guard('pemohon')->id()."' "))->first();
              ?>
              <div class="stat-value">{{ $tot_permohonan->permohonan }}</div>
              
              <div class="progress-line">
                  <div class="progress-fill fill-green"></div>
              </div>
              
              <a href="{{ url('/') }}/user/view_permohonan" class="card-link">Lihat detail &rarr;</a>
            </div>
          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
