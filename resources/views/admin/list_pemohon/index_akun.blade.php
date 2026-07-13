<?php
$today = date("Y");
?>
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
                        <table id="example1" class="table table-bordered table-hover">
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
         "displayLength": 10
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




