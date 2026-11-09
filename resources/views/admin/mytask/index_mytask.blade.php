<style>
    /* Reference Design Overrides */
    body, .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
        position: relative;
    }
    
    /* The Blue Hero Background (Navy Curved Hero) */
    .hero-bg-list {
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
        padding-bottom: 15px;
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
        margin-bottom: 8px;
    }
    .content-header .breadcrumb-item a {
        color: #e0f2fe !important;
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

    /* Cards Layout matching reference */
    .dashboard-container {
        position: relative;
        z-index: 2;
        margin-top: 10px;
        padding-bottom: 40px;
    }
    
    .metric-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 175px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 30px -5px rgba(0, 40, 100, 0.12);
    }
    .metric-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
    }
    .card-accent-blue::before  { background: linear-gradient(90deg, #004b93, #3b82f6); }
    .card-accent-amber::before { background: linear-gradient(90deg, #d97706, #f59e0b); }

    /* Stat Cards */
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .stat-header-left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .stat-icon-box {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }
    .icon-box-blue  { background-color: #eff6ff; color: #004b93; }
    .icon-box-amber { background-color: #fffbeb; color: #d97706; }

    .stat-title {
        color: #475569;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.2;
    }
    .stat-tag {
        font-size: 0.72rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    .tag-blue  { background-color: #e0f2fe; color: #0284c7; }
    .tag-amber { background-color: #fef3c7; color: #d97706; }
    
    .stat-value {
        font-size: 2.3rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin: 10px 0 14px 0;
    }

    /* Progress bars */
    .progress-line {
        height: 6px;
        border-radius: 4px;
        background-color: #f1f5f9;
        position: relative;
        overflow: hidden;
        margin-bottom: 12px;
    }
    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 4px;
        transition: width 0.6s ease;
    }
    .fill-blue  { background-color: #004b93; }
    .fill-amber { background-color: #f59e0b; }

    .card-link {
        font-size: 0.85rem;
        color: #004b93;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
        margin-top: auto;
    }
    .card-link:hover {
        color: #1d4ed8;
        text-decoration: underline;
        transform: translateX(3px);
    }

    /* Chart Cards */
    .chart-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 4px 10px -2px rgba(0, 0, 0, 0.02);
        border: 1px solid #e2e8f0;
        margin-bottom: 24px;
    }
    .chart-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 12px;
    }
    .chart-title {
        color: #1e293b;
        font-size: 1.05rem;
        font-weight: 700;
    }
    
    .chart-body {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 5px 0;
        gap: 20px;
    }
    
    .chart-container {
        position: relative;
        width: 130px;
        height: 130px;
        flex-shrink: 0;
    }
    
    .chart-legend {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 8px;
    }
    
    .legend-item {
        display: flex;
        align-items: center;
        font-size: 0.85rem;
        color: #475569;
        font-weight: 500;
        letter-spacing: 0.2px;
    }
    
    .legend-color {
        width: 12px;
        height: 12px;
        border-radius: 4px;
        margin-right: 8px;
        flex-shrink: 0;
    }
    
    .chart-container canvas {
        position: relative;
        z-index: 10;
    }

    /* Dummy charts removed */
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="position: relative;">
   <!-- The Blue Hero Background -->
   <div class="hero-bg-list"></div>

   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row align-items-center mb-2">
            <div class="col-md-7 col-sm-12">
               <h1 class="m-0 font-weight-bold">My Task &bull; Dashboard Admin</h1>
               <p class="hero-subtitle">Ringkasan permohonan informasi publik yang membutuhkan tindak lanjut dan disposisi resmi.</p>
            </div>
            <div class="col-md-5 col-sm-12 text-md-right mt-3 mt-md-0">
               <ol class="breadcrumb float-md-right mb-2">
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                  <li class="breadcrumb-item active">My Task</li>
               </ol>
               <div class="clearfix"></div>
               <a href="{{ route('admin.view_permohonan') }}" class="btn btn-hero-action">
                   <i class="fas fa-list"></i> + Lihat Semua Permohonan
               </a>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </div>

   <!-- Main content -->
   <section class="content dashboard-container">
      <div class="container-fluid">
        <!-- TOP STATS ROW -->
        <div class="row justify-content-start">
            <!-- Total Permohonan -->
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="metric-card card-accent-blue">
                    <div>
                        <div class="stat-header">
                            <div class="stat-header-left">
                                <div class="stat-icon-box icon-box-blue">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                                <div class="stat-title">Total Permohonan</div>
                            </div>
                            <span class="stat-tag tag-blue">TOTAL</span>
                        </div>
                        <?php
                        $tot = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) total FROM informasi_permohonan"))->first();
                        ?>
                        <div class="stat-value">{{ $tot->total }}</div>
                        
                        <div class="progress-line">
                            <div class="progress-fill fill-blue" style="width: 100%;"></div>
                        </div>
                    </div>
                    <a href="{{ route('admin.view_permohonan') }}" class="card-link">
                        <span>Kelola permohonan masuk</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Permohonan Belum Ditanggapi -->
            <div class="col-lg-5 col-md-6 col-sm-12">
                <div class="metric-card card-accent-amber">
                    <div>
                        <div class="stat-header">
                            <div class="stat-header-left">
                                <div class="stat-icon-box icon-box-amber">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="stat-title">Permohonan Belum Ditanggapi</div>
                            </div>
                            <span class="stat-tag tag-amber">PENDING</span>
                        </div>
                        <?php
                        $tot_blm_ditanggapi = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) blm FROM informasi_permohonan WHERE status = 'OPEN'"))->first();
                        $pct_blm = ($tot->total > 0) ? round(($tot_blm_ditanggapi->blm / $tot->total) * 100) : 0;
                        ?>
                        <div class="stat-value">{{ $tot_blm_ditanggapi->blm }}</div>
                        
                        <div class="progress-line">
                            <div class="progress-fill fill-amber" style="width: {{ $pct_blm }}%;"></div>
                        </div>
                    </div>
                    <a href="{{ route('admin.view_permohonan') }}" class="card-link" style="color: #d97706;">
                        <span>Proses disposisi sekarang</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- CHARTS ROW -->
        <div class="row justify-content-start">
            <!-- DONUT CHART -->
            <div class="col-lg-5 col-md-6">
               <div class="chart-card">
                  <div class="chart-header">
                     <div class="chart-title">Jumlah Status Pengajuan</div>
                  </div>
                  <div class="chart-body">
                     <div class="chart-container" style="position: relative;">
                        <canvas id="donutChart" style="min-height: 120px; height: 120px; max-height: 120px; max-width: 100%;"></canvas>
                        <div id="donutCenterText" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; pointer-events: none; line-height: 1.1;"></div>
                     </div>
                     <div class="chart-legend" id="donutLegend">
                        <!-- Legend dynamically populated -->
                     </div>
                  </div>
               </div>
            </div>
            
            <!-- PIE CHART -->
            <div class="col-lg-5 col-md-6">
               <div class="chart-card">
                  <div class="chart-header">
                     <div class="chart-title">Jumlah Tipe Pengajuan</div>
                  </div>
                  <div class="chart-body">
                     <div class="chart-container">
                        <canvas id="pieChart" style="min-height: 120px; height: 120px; max-height: 120px; max-width: 100%;"></canvas>
                     </div>
                     <div class="chart-legend" id="pieLegend">
                        <!-- Legend dynamically populated -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- /.row -->
      </div><!-- /.container-fluid -->
   </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
   $(function () {
      //- DONUT CHART (Status Pengajuan) -
      $.getJSON("{{ url('/') }}/admin/chart_donat_status", function(json) {
         var labels = [];
         var data = [];
         var bgColors = ['#60a5fa', '#a855f7', '#ec4899', '#f59e0b', '#10b981', '#64748b'];
         var colorsToUse = [];
         
         var total = 0;
         $(json).each(function(i){ total += json[i].y; });
         
         // Inject Center HTML for Doughnut
         $('#donutCenterText').html('<div style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: -4px;">' + total + '</div><div style="font-size: 0.75rem; color: #94a3b8; font-weight: 600;">Total</div>');

         var legendHtml = '';
         $(json).each(function(i){
            // Data nama dari server memiliki format "LABEL : JUMLAH"
            var parts = json[i].name.split(" : ");
            var labelName = parts[0] ? parts[0].trim() : json[i].name;
            var val = json[i].y;
            var pct = total > 0 ? Math.round((val / total) * 100) : 0;
            
            var color = bgColors[i % bgColors.length];
            colorsToUse.push(color);
            labels.push(labelName); 
            data.push(val);
            
            legendHtml += '<div class="legend-item"><div class="legend-color" style="background-color: '+color+';"></div><span style="font-weight: 700; color: #1e293b; margin-right: 6px;">' + pct + '%</span> ' + labelName + '</div>';
         });
         
         $('#donutLegend').html(legendHtml);

         new Chart($('#donutChart').get(0).getContext('2d'), {
            type: 'doughnut',
            data: {
               labels: labels,
               datasets: [{
                  data: data,
                  backgroundColor: colorsToUse
               }]
            },
            options: {
               maintainAspectRatio: false,
               responsive: true,
               legend: { display: false }
            }
         });
      });

      //- PIE CHART (Tipe Pengajuan) -
      $.getJSON("{{ url('/') }}/admin/chart_pie_tipe", function(json) {
         var labels = [];
         var data = [];
         var bgColors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#64748b'];
         var colorsToUse = [];
         
         var total = 0;
         $(json).each(function(i){ total += json[i].y; });

         var legendHtml = '';
         $(json).each(function(i){
            // Data nama dari server memiliki format "LABEL : JUMLAH"
            var parts = json[i].name.split(" : ");
            var labelName = parts[0] ? parts[0].trim() : json[i].name;
            var val = json[i].y;
            var pct = total > 0 ? Math.round((val / total) * 100) : 0;
            
            var color = bgColors[i % bgColors.length];
            colorsToUse.push(color);
            labels.push(labelName); 
            data.push(val);
            
            legendHtml += '<div class="legend-item"><div class="legend-color" style="background-color: '+color+';"></div><span style="font-weight: 700; color: #1e293b; margin-right: 6px;">' + pct + '%</span> ' + labelName + '</div>';
         });

         $('#pieLegend').html(legendHtml);

         new Chart($('#pieChart').get(0).getContext('2d'), {
            type: 'pie',
            data: {
               labels: labels,
               datasets: [{
                  data: data,
                  backgroundColor: colorsToUse
               }]
            },
            options: {
               maintainAspectRatio: false,
               responsive: true,
               legend: { display: false }
            }
         });
      });
   });
</script>
