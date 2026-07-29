<style>
    /* Reference Design Overrides */
    body, .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
    }
    .content-header {
        position: relative;
        z-index: 2;
        padding-top: 30px;
    }
    .content-header h1 {
        color: #fff;
        font-weight: 700;
        font-size: 1.8rem;
    }
    .content-header .breadcrumb-item a,
    .content-header .breadcrumb-item.active {
        color: rgba(255, 255, 255, 0.8) !important;
    }
    
    /* The Blue Hero Background */
    .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 180px;
        background: #5a5ce2;
        border-bottom-left-radius: 30px;
        z-index: 0;
    }

    /* Cards Layout matching reference */
    .dashboard-container {
        position: relative;
        z-index: 2;
        margin-top: 10px;
    }
    
    .ref-card {
        background: #fff;
        border-radius: 16px;
        padding: 15px 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        position: relative;
    }

    /* Stat Cards */
    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .stat-title {
        color: #7b8398;
        font-size: 0.9rem;
        font-weight: 600;
    }
    .stat-tag {
        font-size: 0.7rem;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 700;
    }
    .tag-blue { background-color: #e5edff; color: #5a5ce2; }
    .tag-green { background-color: #dcfce7; color: #22c55e; }
    
    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    /* Progress bars */
    .progress-line {
        height: 6px;
        border-radius: 3px;
        background-color: #f1f5f9;
        position: relative;
        overflow: hidden;
    }
    .progress-fill {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        border-radius: 3px;
    }
    .fill-blue { background-color: #3b82f6; width: 95%; }
    .fill-green { background-color: #22c55e; width: 75%; }

    /* Chart Cards */
    .chart-card {
        background: #F8FAFC;
        border-radius: 16px;
        padding: 15px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
        border: 1px solid #e2e8f0;
        border-top: 3px solid #3b82f6;
        margin-bottom: 20px;
    }
    .chart-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .chart-title {
        color: #7b8398;
        font-size: 0.9rem;
        font-weight: 600;
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
        width: 120px;
        height: 120px;
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
   <div class="hero-bg"></div>

   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>My Task</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Admin</a></li>
                  <li class="breadcrumb-item active">My Task</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content dashboard-container">
      <div class="container-fluid">
        <!-- TOP STATS ROW -->
        <div class="row justify-content-start">
            <!-- Total Permohonan -->
            <div class="col-lg-5 col-md-6">
                <div class="ref-card">
                    <div class="stat-header">
                        <div class="stat-title">Total Permohonan</div>
                        <div class="stat-tag tag-blue">TOTAL</div>
                    </div>
                    <?php
                    $tot = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) total FROM informasi_permohonan"))->first();
                    ?>
                    <div class="stat-value">{{ $tot->total }}</div>
                    
                    <div class="progress-line">
                        <div class="progress-fill fill-blue"></div>
                    </div>
                </div>
            </div>

            <!-- Permohonan Belum Ditanggapi -->
            <div class="col-lg-5 col-md-6">
                <div class="ref-card">
                    <div class="stat-header">
                        <div class="stat-title">Permohonan Belum Ditanggapi</div>
                        <div class="stat-tag tag-green">PENDING</div>
                    </div>
                    <?php
                    $tot_blm_ditanggapi = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) blm FROM informasi_permohonan WHERE status = 'OPEN'"))->first();
                    ?>
                    <div class="stat-value">{{ $tot_blm_ditanggapi->blm }}</div>
                    
                    <div class="progress-line">
                        <div class="progress-fill fill-green"></div>
                    </div>
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
