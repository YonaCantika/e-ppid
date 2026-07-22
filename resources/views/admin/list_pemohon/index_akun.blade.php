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

    /* Table Styling */
    .table {
        margin-top: 10px;
    }
    .table thead th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        border-top: none;
        padding: 15px;
    }
    .table tbody td {
        padding: 15px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-bordered {
        border: none;
    }
    .table-bordered td, .table-bordered th {
        border-left: none;
        border-right: none;
    }
    /* Highlight selected row */
    table.dataTable tbody tr.selected {
        background-color: #eef2ff !important;
        box-shadow: inset 0 0 0 9999px rgba(90, 92, 226, 0.05);
    }
    table.dataTable tbody tr:hover:not(.selected) {
        background-color: #f8fafc;
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
                     <form method="post" class="form-horizontal">
                        <div class="input-group input-group-sm">
                           <label for="status" class="col-sm-1 control-label">Tahun</label>
                           <div class="col-sm-2">
                             <?php $tahun = \DB::select("SELECT YEAR(created_at) thn FROM pemohon group by YEAR(created_at)" )?>
                             <select class="form-control js-example-basic-single" name="date" id="date">
                                 <option value='' selected>Semua</option>
                                 <?php foreach ($tahun as $a) {
                                    echo "<option value='".$a->thn."'>$a->thn</option>";
                                 }?>
                                 <!-- <option value='{{ $today }}' selected>{{ $today }}</option> -->
                              </select>
                           </div>
                           <div class="col-sm-offset-3 col-sm-2">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="filter" >
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                           </div>
                        </div>
                      </form><br>
<!--                      <a class="btn btn-app disabled" id="buttonDetail">
                        <i class="fas fa-info-circle swalDefaultSuccess"></i> Detail
                     </a> -->
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example1" class="table table-hover">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Nama</th>
                                 <th>Email</th>
                                 <th>Telp</th>
                                 <th>Pekerjaan</th>
                                 <th>Alamat</th>                                
                                 <th>No Fax</th>
                                 <th>Total Pengajuan</th>
                                 <th>Belum Ditanggapi</th>
                                 <th>Sudah Ditanggapi</th>
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


   $('#example1 tbody').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
         $("#buttonDetail").addClass("disabled");           
      }else{
         $('#example1').DataTable().$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         $("#buttonDetail").removeClass("disabled");
      }
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
         "ajax": "{{ url('/') }}/admin/listakunpemohon?&periode="+$("#date").val(),         
         "paging": true,
         "displayLength": 10,
         "columnDefs": [
            {
               "targets": 7,
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                      return '<span class="badge" style="background-color: #f1f5f9; color: #475569; padding: 6px 12px; border-radius: 20px; font-weight: 600;">' + data + '</span>';
                  }
                  return data;
               }
            },
            {
               "targets": 8,
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                      if (data > 0) return '<span class="badge" style="background-color: #fff7ed; color: #ea580c; padding: 6px 12px; border-radius: 20px; font-weight: 600;">' + data + '</span>';
                      return '<span style="color: #94a3b8;">' + data + '</span>';
                  }
                  return data;
               }
            },
            {
               "targets": 9,
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                      if (data > 0) return '<span class="badge" style="background-color: #f0fdf4; color: #16a34a; padding: 6px 12px; border-radius: 20px; font-weight: 600;">' + data + '</span>';
                      return '<span style="color: #94a3b8;">' + data + '</span>';
                  }
                  return data;
               }
            }
         ]
      });
   }

   $('.swalDefaultSuccess').click(function() {

   });


   $('#buttonDetail').click( function () {
      var rows = $('#example1').DataTable().rows('.selected').data().length;
      if(rows > 0){
         var edit = $('#example1').DataTable().row('.selected').data()[10];
         $('#modal-lg').modal('show');
         $.ajax({
            type:"POST",
            url:"{{ url('/') }}/admin/form_editView_akun",
            data:{id:edit, status : 'view', header : 'Form Detail'},
            success:function(balikan){
               $("#balikan").html(balikan);
            }
         })
      }
   });





</script>




