<?php  

if ($status == 'view') {

   $disabel = 'disabled';

   $tanggapan = $data_permohonan->text_file;

   $isi_tanggapan = '<div class="form-group">

                        <label for="exampleInputPassword1">Tanggapan</label>

                        <textarea class="form-control" rows="5" placeholder="Enter ..." name="isi_tanggapan" id="isi_tanggapan" '.$disabel.'>'.$tanggapan.'</textarea>

                     </div>

                     <table class="table table-bordered table-striped table-hover" id="dataLampiran">

                        <thead>

                           <tr>

                              <th style="text-align:center">Lampiran</th>    

                              <th style="text-align:center">#</th>              

                           </tr>

                        </thead>

                        <tbody>';

                     if($data_permohonan->upload_file){ 

   $isi_tanggapan .=       '<tr>

                              <td>'.$data_permohonan->upload_file.'</td>

                              <td><a href="'.base_url().'./file/'.$data_permohonan->upload_file.'" style="color:black" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> Download</a></td>

                              </tr>';

                     }else{

   $isi_tanggapan .=       '<tr>

                              <td style="text-align:center">Tidak Ada Lampiran</td>

                           </tr>';

                     }                        

   $isi_tanggapan .=       '</tr>

                        </tbody>

                     </table>  ';

}else{

   $disabel ='';

   $tanggapan ='Belum Ditanggapi';

   $isi_tanggapan = '';

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

                  <select class="custom-select" name="tipe_permohonan" id="tipe_permohonan" {{ $disabel }} >

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

                  <input type="text" class="form-control" name="lain-lain" id="lain-lain" placeholder="Enter ..." value="{{ $data_permohonan->tipe_lainnya }}" {{ $disabel }} >

               </div>

               <div class="form-group">

                 <label for="exampleInputPassword1">Isi Permohonan</label>

                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="isi_permohonan" id="isi_permohonan" {{ $disabel }} >{{ $data_permohonan->isi_permohonan }}</textarea>

               </div>

               {{ $isi_tanggapan }}

               

            </div>

                <!-- /.card-body -->

       <!--      <div class="card-footer">

               <button type="submit" class="btn btn-primary">Submit</button>

            </div> -->

         </form>

      </div>

    <!-- </div> -->

 </div>

 <div class="modal-footer justify-content-between">

   <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

   <?php  

   if ($status == 'edit') {

      echo '<button type="button" class="btn btn-primary" id="edit">Edit changes</button>';

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

      $.ajax({

         type: "POST",

         url: "{{ asset('user/edit_permohonan') }}",

         data: $("#ajaxform").serialize(),

         success: function(balikan) {

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

   });











 </script>




