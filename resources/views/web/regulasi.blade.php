<section class="contact-section" style="padding: 30px 0px 30px;">
   <div class="auto-container">
        <div class="row clearfix" style="padding:5px;">
            <div class="contact-info col-sm-10 col-sm-offset-1">
                <div class="inner" style="padding: 15px 10px 10px 15px;">
                    <h4 align="left">REGULASI</h4><hr/>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                <th> No. </th>
                                <th> Aturan </th>
                                <th> Keterangan </th>
                                <th> Download </th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $no = 0; if ($tableData) { foreach ($tableData as $t) { $no++; ?>
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td align="left">{{ $t->aturan }}</td>
                                        <td align="left">{{ $t->keterangan }}</td>
                                        <td><a href='{{ ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") }}://e-ppid.ptgaram.com/upload/{{ $t->file }}' class='label label-primary' target="_blank">Download </a></td>
                                    </tr>
                                <?php }} ?>
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




