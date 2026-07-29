<div class="modal-header">
   <h4 class="modal-title">Form Tambah</h4>
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
            <div class="card-body">
               <div class="form-group">
                  <label for="exampleInputEmail1">Tipe</label>
                  <select class="custom-select" name="tipe_permohonan" id="tipe_permohonan">
                    <option> Silakan Pilih Tipe Permohonan</option>
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
                  <input type="text" class="form-control" name="lain-lain" id="lain-lain" placeholder="Enter ...">
               </div>
               <div class="form-group">
                 <label for="exampleInputPassword1">Isi Permohonan</label>
                  <textarea class="form-control" rows="3" placeholder="Enter ..." name="isi_permohonan" id="isi_permohonan"></textarea>
               </div>
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
    <button type="button" class="btn btn-primary" id="simpan">Save changes</button>
 </div>

 <script>
   $( "#form_lain_lain" ).hide();
   
   $('#tipe_permohonan').change(function() {
      if ($(this).val() == 'Lain-Lain') {
          $( "#form_lain_lain" ).show();
      }else{
         $( "#form_lain_lain" ).hide();
      }
   });

   $('#simpan').click(function() {
      $.ajax({
         type: "POST",
         url: "{{ asset('user/add_permohonan') }}",
         data: $("#ajaxform").serialize(),
         success: function(balikan) {
            var obj = typeof balikan === 'string' ? jQuery.parseJSON(balikan) : balikan;
            if(obj.status === false || obj.status == 0)
            {
               Swal.fire('Gagal!',obj.msg || 'Terjadi kesalahan','error');
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




