<style type="text/css">
.transparent{
  background:rgba(0, 0, 0, 0.5);
  width: 60%;
  height:350px;
  padding:10px;
  margin:0px auto;
  color:#fff;
  text-align:center;
}
.transparent h1{margin:0}
</style>

<?php  
if ($status == 'view') {
   $disabel = 'disabled';
   $tanggapan = $data_permohonan->text_file;
}else{
   $disabel ='';
   $tanggapan ='';
}

switch ($data_permohonan->status) {
   case 'OPEN':
      $st = 'BELUM DITANGGAPI';
      break;
   case 'APPROVE':
      $st = 'SUDAH DITANGGAPI';
      break;
   case 'APPROVE_HALF':
      $st = 'DITANGGAPI SEBAGIAN';
      break;
   case 'REJECT':
      $st = 'DITOLAK';
      break;
   default:
      $st = '-';
      break;
}
?>
<div class="modal-header">
   <h4 class="modal-title">{{ $header }}</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
   </button>
</div>
<div class="modal-body">
   <!-- <div class="row"> -->
      <div class="card card-primary">
         <!-- /.card-header -->
         <!-- form start -->
         <form role="form" id="ajaxform">
            <input type="hidden" value="{{ $data_permohonan->id }}" id="id_informasi_permohonan" name="id_informasi_permohonan">
            <div class="card-body">
               <div class="form-group">
                  <label for="exampleInputEmail1">Tipe</label>
                  <select class="custom-select" name="tipe_permohonan" id="tipe_permohonan" disabled >
                    <option value="{{ $data_permohonan->tipe_permohonan }}" selected> {{ $data_permohonan->tipe_permohonan }}</option>
                    <option value="Tugas Sekolah">Tugas Sekolah</option>
                    <option value="Tugas Kuliah"> Tugas Kuliah</option>
                    <option value="Tugas Akhir Kuliah"> Tugas Akhir Kuliah</option>
                    <option value="Skripsi">Skripsi</option>
                    <option value="Tesis"> Tesis</option>
                    <option value="LSM">LSM</option>
                    <option value="Penelitian">Penelitian</option>
                    <option value="Wartawan">Wartawan</option>
                    <option value="Lain-Lain">Lain-lain</option>
                  </select>
               </div>
               <div class="form-group" id="form_lain_lain">
                  <label for="exampleInputPassword1">Jika Lain-Lain Wajib isi disini</label>
                  <input type="text" class="form-control" name="lain-lain" id="lain-lain" placeholder="Enter ..." value="{{ $data_permohonan->tipe_lainnya }}" disabled >
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Isi Permohonan</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="isi_permohonan" id="isi_permohonan" disabled >{{ $data_permohonan->isi_permohonan }}</textarea>
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Tanggapan</label>
                  <textarea class="form-control" rows="5" placeholder="Enter ..." name="isi_tanggapan" id="isi_tanggapan" {{ $disabel }}><?php echo$tanggapan ?></textarea>
               </div>
               <div class="form-group">
                  <label for="exampleInputEmail1">Status</label>
                  <select class="custom-select" name="status" id="status" {{ $disabel }}>
                    <?php if($status == 'view'){?><option value="{{ $data_permohonan->status }}" selected> {{ $st;} }}</option>
                    <option value="APPROVE">SUDAH DITANGGAPI</option>
                    <option value="APPROVE_HALF">DITANGGAPI SEBAGIAN</option>
                    <option value="REJECT">DITOLAK</option>
                  </select>
               </div>
               <?php if($status == 'edit'){ ?>
               <div class="form-group">
                  <label class="col-sm-3">Lampiran</label>
                  <div class="col-sm-9">
                     <input type="file" name="files" id="files"  /><h6>*Upload dengan format pdf</h6>
                  </div>
               </div> 
               <!-- <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
               </div> -->
               <div id="targetLayer" style="display:none;"></div>
               <?php }else{ ?>
               <table class='table table-bordered table-striped table-hover' id='dataLampiran'>
                 <thead>
                   <tr>
                     <th style="text-align:center">Lampiran</th>    
                     <th style="text-align:center">#</th>              
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                     <?php
                       if($data_permohonan->upload_file){
                        echo '
                               <tr>
                               <td>'.$data_permohonan->upload_file.'</td>
                               <td><a href="'.base_url().'./file/'.$data_permohonan->upload_file.'" style="color:black"><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>
                               </tr>
                               ';
                       }else{
                        echo '
                               <tr>
                               <td style="text-align:center">Tidak Ada Lampiran</td>
                               </tr>
                               ';
                       }                        
                     ?>  
                   </tr>
               </table>  
              <?php } ?>
            </div>
         </form>
         <div id="loader-icon" style="display:none; text-align: center" ><img width="70%" src="{{ url('/') }}/file/loader.gif" ></div>

      </div>
    <!-- </div> -->
 </div>
 <div class="modal-footer justify-content-between">
   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
   <?php  
   if ($status == 'edit') {
      echo '<button type="button" class="btn btn-primary" id="edit">Kirim Tanggapan</button>';
   }
   ?>
 </div>
 

 <script>
   $(document).ready(function() {
      let x = $("#tipe_permohonan").val(); 
      // alert(x);
      if (x != 'Lain-Lain'){
         $( "#form_lain_lain" ).hide();
       }else{
          $( "#form_lain_lain" ).show();
       }
   }); 
   
   
   $('#tipe_permohonan').change(function() {
      if ($(this).val() == 'Lain-Lain') {
          $( "#form_lain_lain" ).show();
      }else{
         $( "#form_lain_lain" ).hide();
      }
   });

   $('#edit').click(function() {
      if($('#files').val()){
         $('#loader-icon').show();
         $('#targetLayer').hide();
         $('#edit').hide();
         var formData = new FormData(document.forms['ajaxform']);  // with the file input
         $.ajax({
            type: "POST",
            url: "{{ asset('admin/tanggapan') }}",
            data: formData,
            processData: false,
            contentType: false,
            enctype: 'multipart/form-data',
            target: '#targetLayer',
            // beforeSubmit:function(){
            //   $('.progress-bar').width('50%');
            // },
            // uploadProgress: function(event, position, total, percentageComplete){
            //   $('.progress-bar').animate({
            //    width: percentageComplete + '%'
            //   }, {
            //    duration: 1000
            //   });
            //  },
            success: function(balikan) {
               $('#loader-icon').hide();
               $('#targetLayer').show();
               var obj = jQuery.parseJSON(balikan);
               if(obj.status == 0)
               {
                  Swal.fire('Gagal!',obj.msg,'error');
               }else{
                  $('#modal-lg').modal('hide');
                     Swal.fire({
                        text: 'Data Berhasil Ditambahkan',
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
   });





 </script>




