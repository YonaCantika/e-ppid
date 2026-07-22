<?php
$today = date("Y");
?>
<style>
    /* Match Dashboard Aesthetics */
    .content-wrapper {
        background-color: #f4f6f9 !important;
        font-family: 'Inter', 'Source Sans Pro', sans-serif;
        position: relative;
    }
    
    /* The Blue Hero Background (Small version for list page) */
    .hero-bg-list {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 160px;
        background: #5a5ce2;
        border-bottom-left-radius: 30px;
        z-index: 0;
    }

    /* Container holding the card */
    .content {
        position: relative;
        z-index: 2;
        padding-top: 25px;
    }

    /* Main Card Styling */
    .card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        border: none;
        margin-top: 55px;
    }
    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #f1f5f9;
        border-radius: 16px 16px 0 0 !important;
        padding: 20px 25px;
    }
    
    /* Filter Inputs */
    .form-control, .select2-container .select2-selection--single {
        border-radius: 8px !important;
        border: 1px solid #e2e8f0;
        box-shadow: none;
    }
    .input-group-btn .btn-default {
        border-radius: 8px !important;
        background: #eef2ff;
        color: #5a5ce2;
        border: 1px solid #c7d2fe;
        transition: all 0.2s;
    }
    .input-group-btn .btn-default:hover {
        background: #5a5ce2;
        color: #fff;
    }

    /* Application Buttons */
    .btn-app {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background-color: #fff;
        color: #64748b;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        transition: all 0.2s;
        margin-bottom: 0;
    }
    .btn-app:hover:not(.disabled) {
        background-color: #f8fafc;
        border-color: #cbd5e1;
        color: #334155;
    }
    .btn-app.disabled {
        opacity: 0.5;
        background-color: #f8fafc;
    }
    .btn-app > i {
        color: #5a5ce2; /* theme blue */
    }

    /* Table Styling */
    .table {
        margin-top: 10px;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #1E293B !important;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
        padding: 16px 20px;
    }
    .table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #475569;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }
    .table-bordered {
        border: none;
    }
    .table-bordered td, .table-bordered th {
        border-left: none;
        border-right: none;
    }
    
    .table.table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    .table.table-hover tbody tr:hover {
        background-color: #f0f9ff !important;
    }

    /* Modern Toolbar */
    .filter-toolbar {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 12px;
        border: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }
    .filter-btn-modern {
        background: #5a5ce2;
        color: white;
        border-radius: 8px;
        padding: 6px 16px;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
    }
    .filter-btn-modern:hover {
        background: #4338ca;
        color: white;
    }

    /* Action Buttons */
    .btn-action-purple {
        background-color: #f3e8ff;
        color: #9333ea;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-purple:hover:not(.disabled) {
        background-color: #9333ea;
        color: white;
    }
    .btn-action-blue {
        background-color: #dbeafe;
        color: #2563eb;
        border: none;
        border-radius: 8px;
        padding: 6px 10px;
        transition: all 0.2s;
    }
    .btn-action-blue:hover {
        background-color: #2563eb;
        color: white;
    }
    .btn-action-purple.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Pagination */
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #5a5ce2 !important;
        color: #fff !important;
        border: none;
        border-radius: 6px;
    }
    
    /* Enhanced Table UI */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 5px 10px;
        outline: none;
        transition: border-color 0.2s;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #5a5ce2;
        box-shadow: 0 0 0 2px rgba(90,92,226,0.2);
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        padding: 4px;
        outline: none;
    }
    .table.table-hover tbody tr {
        transition: background-color 0.2s ease;
        cursor: pointer;
    }
</style>

<div class="content-wrapper">
  <!-- The Blue Hero Background -->
  <div class="hero-bg-list"></div>
  <!-- Content Header (Page header) -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
         <!-- left column -->
            <div class="col-md-12">
               <!-- Application buttons -->
               <div class="card">
                  <div class="card-header">
                     <!---- Filter Data -->
                     <div class="filter-toolbar d-flex align-items-center justify-content-start flex-wrap gap-3">
                         <div class="d-flex align-items-center mr-3 mb-2 mb-md-0">
                             <label for="kategori" class="mb-0 mr-2 font-weight-bold text-secondary" style="font-size: 0.9rem;">Status:</label>
                             <select class="form-control default-select2" name="kategori" id="kategori" style="width: 220px; border-radius: 8px;">
                                 <option value="" selected>ALL STATUS</option>
                                 <option value="OPEN">BELUM DITANGGAPI</option>
                                 <option value="APPROVE">SUDAH DITANGGAPI</option>
                                 <option value="APPROVE_HALF">DITANGGAPI SEBAGIAN</option>
                                 <option value="REJECT">DITOLAK</option>
                             </select>
                         </div>
                         <div class="d-flex align-items-center mr-3 mb-2 mb-md-0">
                             <label for="date" class="mb-0 mr-2 font-weight-bold text-secondary" style="font-size: 0.9rem;">Tahun:</label>
                             <?php $tahun = \DB::select("SELECT YEAR(created_at) thn FROM informasi_permohonan group by YEAR(created_at)" )?>
                             <select class="form-control js-example-basic-single" name="date" id="date" style="width: 120px; border-radius: 8px;">
                                 <?php foreach ($tahun as $a) {
                                    echo "<option value='".$a->thn."'>$a->thn</option>";
                                 }?>
                                 <option value='{{ $today }}' selected>{{ $today }}</option>
                             </select>
                         </div>
                         <div class="d-flex align-items-center mb-2 mb-md-0">
                             <button class="btn filter-btn-modern" type="button" id="filter" >
                                 <i class="fa fa-filter mr-1"></i> Filter
                             </button>
                         </div>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example1" class="table table-hover">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Tipe Pengajuan</th>
                                 <th>Isi Pengajuan</th>
                                 <th>Pemohon</th>
                                 <th>Email Pemohon</th>
                                 <th>Tanggal Pengajuan</th>
                                 <th>Status Pengajuan</th>
                                 <th class="text-center">Aksi</th>
                              </tr>
                           </thead>
                           <tbody>

                           </tbody>
                         </table>
                     </div>
                 </div>
              </div>
              <!-- /.card-body -->
            </div>
         </div>
         <!--/.col (right) -->
      </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="modal-lg">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div id="balikan"></div>
      </div>
    <!-- /.modal-content -->
   </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

   $(document).ready(function() {
      render_table();
       $('#date').select2();
   }); 

$("#filter").click(function(){
   render_table();
});




   function render_table(){
      if ( $.fn.DataTable.isDataTable('#example1') ) {
            $('#example1').DataTable().destroy();
      }

      $('#example1 tbody').empty();
      $('#example1').DataTable({
         "searching": true,
         "serverSide": false,  
         "ordering": true,
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],   
         "ajax": "{{ url('/') }}/admin/listdatapemohon?&status="+$("#kategori").val()+"&periode="+$("#date").val(),         
         "paging": true,
         "displayLength": 10,
         "columnDefs": [
            {
               "targets": 6,
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                     if (data === 'BELUM DITANGGAPI') {
                        return '<span class="badge" style="background-color: #fff7ed; color: #ea580c; padding: 6px 12px; border-radius: 20px; font-weight: 600; border: 1px solid #ffedd5;">BELUM DITANGGAPI</span>';
                     } else if (data === 'SUDAH DITANGGAPI') {
                        return '<span class="badge" style="background-color: #f0fdf4; color: #16a34a; padding: 6px 12px; border-radius: 20px; font-weight: 600; border: 1px solid #dcfce7;">SUDAH DITANGGAPI</span>';
                     } else if (data === 'DITANGGAPI SEBAGIAN') {
                        return '<span class="badge" style="background-color: #eff6ff; color: #2563eb; padding: 6px 12px; border-radius: 20px; font-weight: 600; border: 1px solid #dbeafe;">DITANGGAPI SEBAGIAN</span>';
                     } else if (data === 'DITOLAK') {
                        return '<span class="badge" style="background-color: #fef2f2; color: #dc2626; padding: 6px 12px; border-radius: 20px; font-weight: 600; border: 1px solid #fee2e2;">DITOLAK</span>';
                     }
                  }
                  return data;
               }
            },
            {
               "targets": 7,
               "className": "text-center",
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                     var id = row[7];
                     var status = row[6];
                     var btnTanggapi = '';
                     if(status === 'BELUM DITANGGAPI') {
                        btnTanggapi = '<button class="btn btn-sm btn-action-purple mr-2" onclick="openEdit('+id+')" title="Tanggapi"><i class="fas fa-edit"></i></button>';
                     } else {
                        btnTanggapi = '<button class="btn btn-sm btn-action-purple mr-2 disabled" title="Tanggapi"><i class="fas fa-edit"></i></button>';
                     }
                     var btnDetail = '<button class="btn btn-sm btn-action-blue" onclick="openDetail('+id+')" title="Detail"><i class="fas fa-info-circle"></i></button>';
                     return '<div style="white-space: nowrap;">' + btnTanggapi + btnDetail + '</div>';
                  }
                  return data;
               }
            }
         ]
      });
   }

   $('.swalDefaultSuccess').click(function() {

   });


   function openEdit(id) {
      $('#modal-lg').modal('show');
      get_data_to_update(id);
   }

   function get_data_to_update(id){
      $.ajax({
         type:"POST",
         url:"{{ url('/') }}/admin/form_editView_permohonan",
         data:{id:id, status :'edit', header : 'Form Tanggapan'},
         success:function(balikan){
            $("#balikan").html(balikan);
         }
      })
   }

   function openDetail(id) {
      $('#modal-lg').modal('show');
      $.ajax({
         type:"POST",
         url:"{{ url('/') }}/admin/form_editView_permohonan",
         data:{id:id, status : 'view', header : 'Form Detail'},
         success:function(balikan){
            $("#balikan").html(balikan);
         }
      })
   }





</script>




