<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
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
                  <li class="breadcrumb-item active">General Form</li>
               </ol>
            </div>
         </div>
      </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-3">
               <div class="col-lg-12">
                  <!-- small box -->
                  <div class="small-box bg-info">
                     <div class="inner">
                        <?php
                        $tot = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) total FROM informasi_permohonan"))->first();
                        ?>
                        <h3>{{ $tot->total }}</h3>

                        <p>Total Permohonan</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-bag"></i>
                     </div>
                     <a href="{{ url('/') }}/admin/view_permohonan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-12">
                  <!-- small box -->
                  <div class="small-box bg-success">
                     <div class="inner">
                        <?php
                        $tot_blm_ditanggapi = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) blm FROM informasi_permohonan WHERE status = 'OPEN'"))->first();
                        ?>
                        <h3>{{ $tot_blm_ditanggapi->blm }}</h3>

                        <p>Permohonan Belum Ditanggapi</p>
                     </div>
                     <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                     </div>
                     <a href="{{ url('/') }}/admin/view_permohonan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
            </div>

          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
           <!--  <div class="small-box bg-warning">
              <div class="inner">
                <?php
                $tot_sdh_ditanggapi = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) sdh FROM informasi_permohonan WHERE status IN ('APPROVE','APPROVE_HALF')"))->first();
                ?>
                <h3>{{ $tot_sdh_ditanggapi->sdh }}</h3>

                <p>Permohonan Sudah Ditanggapi</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('/') }}/admin/view_permohonan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
          <!-- <div class="col-lg-3 col-6"> -->
            <!-- small box -->
           <!--  <div class="small-box bg-danger">
              <div class="inner">
                <?php
                $tot_reject = collect(\Illuminate\Support\Facades\DB::select("SELECT COALESCE(COUNT(id),0) tolak FROM informasi_permohonan WHERE status IN ('REJECT')"))->first();
                ?>
                <h3>{{ $tot_reject->tolak }}</h3>

                <p>Permohonan Ditolak</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ url('/') }}/admin/view_permohonan" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- DONUT CHART -->
               <div class="card card-danger">
                  <div class="card-header">
                     <h3 class="card-title">Jumlah Status Pengajuan</h3>
                  </div>
                  <div class="card-body">
                     <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <div class="col-lg-3 col-6">
               <!-- DONUT CHART -->
               <div class="card card-success">
                  <div class="card-header">
                     <h3 class="card-title">Jumlah Tipe Pengajuan</h3>
                  </div>
                  <div class="card-body">
                     <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
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
       //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
      $.getJSON("{{ url('/') }}/Admin/chart_donat_status?", function(json) {
         var isi_labels = [];
         var isi_data=[];
         
         $(json).each(function(i){         
            isi_labels.push(json[i].name); 
            isi_data.push(json[i].y);
            // console.log(json[0]["name"]);
         });

          var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
          var donutData        = {
            labels: isi_labels,
            datasets: [
              {
                data: isi_data,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }
            ]
          }
          var donutOptions     = {
            maintainAspectRatio : false,
            responsive : true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          var donutChart = new Chart(donutChartCanvas, {
            type: 'doughnut',
            data: donutData,
            options: donutOptions      
          })
      })
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      $.getJSON("{{ url('/') }}/Admin/chart_pie_tipe?", function(json) {
         var isi_labels = [];
         var isi_data=[];
         
         $(json).each(function(i){         
            isi_labels.push(json[i].name); 
            isi_data.push(json[i].y);
            // console.log(json[0]["name"]);
         });

         var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
         var donutData        = {
            labels: isi_labels,
            datasets: [
              {
                data: isi_data,
                backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }
            ]
         }
         var pieData        = donutData;
         var pieOptions     = {
            maintainAspectRatio : false,
            responsive : true,
         }
         //Create pie or douhnut chart
         // You can switch between pie and douhnut using the method below.
         var pieChart = new Chart(pieChartCanvas, {
            type: 'pie',
            data: pieData,
            options: pieOptions      
         })
      })





   })
</script>




