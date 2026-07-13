<div class="content-wrapper">
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
                     <!-- <h3 class="card-title">Application Buttons</h3> -->
                     <a class="btn btn-app" id="buttonAdd">
                        <i class="fas fa-plus-square" ></i> Tambah
                     </a>
                     <a class="btn btn-app disabled" id="buttonEdit">
                        <i class="fas fa-edit"></i> Edit
                     </a>
                     <a class="btn btn-app disabled" id="buttonDelete">
                        <i class="fas fa-trash" ></i> Hapus
                     </a>
                     <a class="btn btn-app disabled" id="buttonDetail">
                        <i class="fas fa-info-circle swalDefaultSuccess"></i> Detail/Tanggapan
                     </a>
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
   }); 

// $("#filter").click(function(){
//    render_table();
// });


   $('#example1 tbody').on( 'click', 'tr', function () {
      if ( $(this).hasClass('selected') ) {
         $(this).removeClass('selected');
         $("#buttonEdit").addClass("disabled");
         $("#buttonDelete").addClass("disabled");
         $("#buttonDetail").addClass("disabled");           
      }else{
         $('#example1').DataTable().$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         $("#buttonEdit").removeClass("disabled");
         $("#buttonDelete").removeClass("disabled");
         $("#buttonDetail").removeClass("disabled");
      }
   });

   function render_table(){
      $('#example1').DataTable({
         "searching": true,
         "serverSide": false,  
         "ordering": true,
         "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],   
         "ajax": "{{ url('/') }}/user/listdatapemohon",         
         "paging": true,
         "displayLength": 10
      });
   }

   $('.swalDefaultSuccess').click(function() {

   });


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


   $('#buttonDelete').click( function () {
      var rows = $('#example1').DataTable().rows('.selected').data().length;
      if(rows > 0){
         var status =  $('#example1').DataTable().row('.selected').data()[4];
         if(status == 'BELUM DITANGGAPI'){
            Swal.fire({
               title: "Hapus Data "+$('#example1').DataTable().row('.selected').data()[2]+"?",   
               text: "Aksi ini akan menghapus oleh sistem!",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
               if (result.value) {
                  var id = $('#example1').DataTable().row('.selected').data()[5];
                  $.ajax({
                     type:"POST",
                     url:"{{ url('/') }}/user/delete_permohonan",
                     data:{id:id},
                     success:function(out){
                        var obj = jQuery.parseJSON(out);
                        if(obj.status == 0){
                           Swal.fire('Deleted!','Your file has been deleted.','success')
                        }else{                              
                           Swal.fire({
                              text: 'Data Berhasil dihapus',
                              target: '#custom-target',
                              customClass: {
                                 container: 'position-absolute'
                              },
                              toast: true,
                              position: 'top-right'
                           })
                           $('#example1').DataTable().ajax.reload();
                        }
                     }
                  });
               }
            })

         }else{
               Swal.fire('Gagal Hapus!','Data sudah di tanggapi.','warning')
         }
      }

   });


   $('#buttonEdit').click( function () {
      var rows = $('#example1').DataTable().rows('.selected').data().length;
      if(rows > 0){
         var status =  $('#example1').DataTable().row('.selected').data()[4];
         if(status =='BELUM DITANGGAPI')
         {
            var edit = $('#example1').DataTable().row('.selected').data()[5];
            $('#modal-lg').modal('show');
            get_data_to_update(edit);
         }else{
            Swal.fire("Info!", "Data yang anda pilih tidak bisa di edit", "warning");
         }
      }
   });

   function get_data_to_update(id){
      $.ajax({
         type:"POST",
         url:"{{ url('/') }}/user/form_editView_permohonan",
         data:{id:id, status :'edit', header : 'Form Update'},
         success:function(balikan){
            $("#balikan").html(balikan);
         }
      })
   }


   $('#buttonDetail').click( function () {
      var rows = $('#example1').DataTable().rows('.selected').data().length;
      if(rows > 0){
         var edit = $('#example1').DataTable().row('.selected').data()[5];
         $('#modal-lg').modal('show');
         $.ajax({
            type:"POST",
            url:"{{ url('/') }}/user/form_editView_permohonan",
            data:{id:edit, status : 'view', header : 'Form Edit'},
            success:function(balikan){
               $("#balikan").html(balikan);
            }
         })
      }
   });





</script>




