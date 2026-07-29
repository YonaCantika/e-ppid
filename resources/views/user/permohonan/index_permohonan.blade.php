<style>
   /* Modern Data Table Styling */
   .content-wrapper {
       background-color: #f4f6f9 !important;
       font-family: 'Inter', 'Source Sans Pro', sans-serif;
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
    
    .card-body {
        padding: 20px 25px;
        position: relative;
    }
    
    /* Move add button to static flex layout */
    .btn-add-modern {
        background-color: #3b82f6;
        color: white;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
    }
    .btn-add-modern:hover {
        background-color: #2563eb;
        color: white;
        transform: translateY(-2px);
    }

    /* Filter Inputs */
    .form-control {
        border-radius: 8px !important;
        border: 1px solid #e2e8f0;
        box-shadow: none;
    }
    
    .filter-btn-modern {
        background: #5a5ce2;
        color: white;
        border-radius: 8px;
        padding: 6px 16px;
        font-weight: 600;
        transition: all 0.2s;
        border: none;
        height: calc(1.5em + .5rem + 2px); /* Match input-sm height */
    }
    .filter-btn-modern:hover {
        background: #4338ca;
        color: white;
    }

   /* Datatables alignment overrides */
   .dataTables_wrapper .dataTables_filter {
       /* Removed right margin since button moved to header */
   }
   
   /* Table Header */
   .table {
       margin-top: 15px !important;
   }
   .table thead th {
       font-weight: 700;
       color: #1E293B;
       background-color: #f8fafc;
       border-bottom: 2px solid #e2e8f0 !important;
       border-top: none !important;
       padding: 15px;
       font-size: 0.9rem;
   }

   /* Table Body & Hover */
   .table tbody td {
       padding: 15px;
       vertical-align: middle;
       color: #334155;
       border-bottom: 1px solid #f1f5f9;
   }
   .table-bordered, .table-bordered td, .table-bordered th {
       border: none !important;
   }
   .table.table-hover tbody tr {
       transition: background-color 0.2s ease;
   }
   .table.table-hover tbody tr:hover {
       background-color: #eef2ff !important;
   }

   /* Responsive scroll removal */
   .table-responsive {
       overflow-x: auto;
   }
   .table-responsive::-webkit-scrollbar {
       height: 0px; /* hide scrollbar for modern look */
       background: transparent;
   }
   
   /* Status Badges */
   .badge-status {
       padding: 6px 12px;
       border-radius: 20px;
       font-weight: 600;
       font-size: 0.75rem;
       display: inline-block;
   }
   .badge-sudah { background-color: #dcfce7; color: #16a34a; }
   .badge-belum { background-color: #fee2e2; color: #dc2626; }
   
   /* Action Buttons */
   .btn-aksi {
       padding: 6px 10px;
       border-radius: 8px;
       font-size: 0.85rem;
       margin: 0 3px;
       border: none;
       transition: all 0.2s;
       cursor: pointer;
   }
   .btn-edit { background-color: #fef3c7; color: #d97706; }
   .btn-edit:hover { background-color: #fde68a; color: #b45309; }
   .btn-hapus { background-color: #fee2e2; color: #dc2626; }
   .btn-hapus:hover { background-color: #fecaca; color: #b91c1c; }
   .btn-detail { background-color: #e0e7ff; color: #4f46e5; }
   .btn-detail:hover { background-color: #c7d2fe; color: #4338ca; }
   
   /* Hide native border in datatables */
   table.dataTable.no-footer {
       border-bottom: none !important;
   }
</style>

<div class="content-wrapper" style="position: relative;">
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
                  <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                     <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                        <!-- Filters -->
                        <div class="input-group input-group-sm mr-2" style="width: 200px;">
                           <select name="status" id="status" class="form-control">
                              <option value="ALL">ALL STATUS</option>
                              <option value="BELUM DITANGGAPI">BELUM DITANGGAPI</option>
                              <option value="SUDAH DITANGGAPI">SUDAH DITANGGAPI</option>
                           </select>
                        </div>
                        <div class="input-group input-group-sm mr-2" style="width: 150px;">
                           <select name="tahun" id="tahun" class="form-control">
                              <option value="ALL">ALL TAHUN</option>
                              <option value="2026">2026</option>
                              <option value="2025">2025</option>
                           </select>
                        </div>
                        <button class="filter-btn-modern" id="filterBtn">
                           <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                     </div>
                     <button class="btn-add-modern" id="buttonAdd">
                         <i class="fas fa-plus"></i> Tambah Permohonan
                     </button>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-hover">
                           <thead>
                              <tr>
                                 <th>No</th>
                                 <th>Tipe Pengajuan</th>
                                 <th>Isi Pengajuan</th>
                                 <th>Tanggal Pengajuan</th>
                                 <th>Status Pengajuan</th>
                                 <th style="width: 150px; text-align: center;">AKSI</th>
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
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      });
      
      render_table();
      
      $('#filterBtn').click(function() {
         $('#example1').DataTable().ajax.reload();
      });
   }); 

   function render_table(){
      $('#example1').DataTable({
         "searching": true,
         "serverSide": false,  
         "ordering": true,
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],   
         "ajax": {
             "url": "{{ url('/') }}/user/listdatapemohon",
             "type": "GET",
             "data": function (d) {
                 d.status = $('#status').val();
                 d.tahun = $('#tahun').val();
             }
         },         
         "paging": true,
         "displayLength": 10,
         "columnDefs": [
            {
               "targets": 4, // Status column
               "render": function ( data, type, row, meta ) {
                  if(type === 'display') {
                      if (data === 'SUDAH DITANGGAPI') {
                          return '<span class="badge-status badge-sudah">' + data + '</span>';
                      } else {
                          return '<span class="badge-status badge-belum">' + data + '</span>';
                      }
                  }
                  return data;
               }
            },
            {
               "targets": 5, // Aksi column
               "orderable": false,
               "render": function ( data, type, row, meta ) {
                   var id = row[5]; 
                   var status = row[4];
                   var judul = (row[2] || '').replace(/'/g, "\\'"); // escape quotes
                   
                   var actionHtml = '<div style="display: flex; justify-content: center; gap: 4px;">';
                   
                   actionHtml += '<button class="btn-aksi btn-detail" onclick="actionDetail('+id+')" title="Detail"><i class="fas fa-info-circle"></i></button>';
                   
                   if(status == 'BELUM DITANGGAPI') {
                       actionHtml += '<button class="btn-aksi btn-edit" onclick="actionEdit('+id+')" title="Edit"><i class="fas fa-edit"></i></button>';
                       actionHtml += '<button class="btn-aksi btn-hapus" onclick="actionDelete('+id+', \''+judul+'\')" title="Hapus"><i class="fas fa-trash"></i></button>';
                   } else {
                       actionHtml += '<button class="btn-aksi btn-edit" style="opacity: 0.4; cursor: not-allowed;" disabled title="Tidak dapat diedit"><i class="fas fa-edit"></i></button>';
                       actionHtml += '<button class="btn-aksi btn-hapus" style="opacity: 0.4; cursor: not-allowed;" disabled title="Tidak dapat dihapus"><i class="fas fa-trash"></i></button>';
                   }
                   
                   actionHtml += '</div>';
                   return actionHtml;
               }
            }
         ]
      });
   }

   $('#buttonAdd').click( function () {   
      $('#modal-lg').modal('show');
      $.ajax({
         type:"POST",
         url:"{{ url('/') }}/user/getModalAddPermohonan",
         data:{},
         success:function(balikan){
            $("#balikan").html(balikan);
         }
      })
   });


   function actionDelete(id, name) {
       Swal.fire({
          title: "Hapus Data?",   
          text: "Aksi ini akan menghapus data permohonan dari sistem!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#dc2626',
          cancelButtonColor: '#64748b',
          confirmButtonText: 'Ya, hapus!'
       }).then((result) => {
          if (result.value) {
             $.ajax({
                type:"POST",
                url:"{{ url('/') }}/user/delete_permohonan",
                data:{id:id},
                success:function(out){
                   var obj = typeof out === 'string' ? jQuery.parseJSON(out) : out;
                   if(obj.status === false || obj.status == 0){
                      Swal.fire('Gagal!','Data gagal dihapus.','error');
                   }else{                              
                      Swal.fire({
                         text: 'Data Berhasil dihapus',
                         toast: true,
                         position: 'top-right'
                      });
                      $('#example1').DataTable().ajax.reload();
                   }
                }
             });
          }
       });
   }


   function actionEdit(id) {
       $('#modal-lg').modal('show');
       $.ajax({
          type:"POST",
          url:"{{ url('/') }}/user/form_editView_permohonan",
          data:{id:id, status :'edit', header : 'Form Update'},
          success:function(balikan){
             $("#balikan").html(balikan);
          }
       });
   }


   function actionDetail(id) {
       $('#modal-lg').modal('show');
       $.ajax({
          type:"POST",
          url:"{{ url('/') }}/user/form_editView_permohonan",
          data:{id:id, status : 'view', header : 'Form Detail'},
          success:function(balikan){
             $("#balikan").html(balikan);
          }
       });
   }

</script>




