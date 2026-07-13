<?php
$today = date("Y");
?>
<section class="contact-section" style="padding: 30px 0px 30px;">
   <div class="auto-container">
        <div class="row clearfix" style="padding:5px;">
            <h4 align="left">STATISTIK TANGGAP JAWAB PERTANYAAN</h4><hr/>
                <!--Content Side-->
            <div class="alert alert-info fade in">
               <form method="post" class="form-horizontal">
                  <div class="form-group">
                     <label for="status" class="col-sm-1 control-label">Tahun</label>
                     <div class="col-sm-2">
                       <select class="form-control js-example-basic-single" name="date" id="date">
                           <?php  
                           if ($this->session->userdata('tahun')) {
                              echo "<option value=".$this->session->userdata('tahun')." selected>".$this->session->userdata('tahun')."</option>";
                             // code...
                           } else{
                              echo "<option value='$today' selected>$today</option>";
                           }
                           foreach ($q_tahun as $key) {
                                 echo "<option value='$key->tahun'>$key->tahun</option>";
                              
                              }
                           
                           ?>
                        </select>
                     </div>
                     <div class="col-sm-offset-3 col-sm-2">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="submit" name="submit" value="submit">
                              <i class="fa fa-search">Cari</i>
                          </button>
                      </span>
                     </div>
                  </div>
                  <!-- <div class="form-group">
                     
                  </div> -->
               </form>
            </div>

            <div class="col-md-12">
               <!-- <h5><b>Hasil Pencarian : {{ $total_rows }} </b></h5> -->
                <?php if (empty($tipe) && empty($tatus)) {
                  echo '<div class="alert alert-danger" role="alert">
                           Data Tidak Ditemukan
                        </div>';
               } ?>
            </div>
            <div class="contact-info col-sm-10 col-sm-offset-1">
                <div class="inner" style="padding: 15px 10px 10px 15px;">
                    <h4 align="left">PERBANDINGAN JUMLAH TIPE PERMOHONAN</h4><hr/>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                <th> TIPE PERMOHONAN</th>
                                <th> JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($tipe as $t) {  ?>
                                    <tr>
                                        <td align="left">{{ $t->tipe_permohonan }}</td>
                                        <td align="left">{{ $t->jumlah }}</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="inner" style="padding: 15px 10px 10px 15px;">
                    <h4 align="left">PERBANDINGAN TANGGAPAN PERMOHONAN</h4><hr/>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                <th> TANGGAPAN</th>
                                <th> JUMLAH</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php foreach ($status as $u) { 
                                        switch ($u->status) {
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
                                                $row[] = '-';
                                                break;
                                          }
                                     ?>
                                    <tr>
                                        <td align="left">{{ $st }}</td>
                                        <td align="left">{{ $u->jumlah }}</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="contact-info col-sm-4 col-xs-12" hidden>
                <div class="inner" style="padding: 15px 10px 10px 15px;">
                    <h4 align="left">Login Pemohon</h4><hr/>
                    <div class="contact-form">
                        <form method="post">
                            <div class="row clearfix">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" name="usern" id="usern" class="form-control" placeholder="Username" style="height: 35px">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="passw" id="passw" class="form-control" placeholder="Password" style="height: 35px">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 text-left">
                                    <button type="submit" class="theme-btn btn-style-one"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




