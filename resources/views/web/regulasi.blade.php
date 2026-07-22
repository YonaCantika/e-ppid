<section class="contact-section" style="padding: 50px 0px 60px; background-color: #f8fafc;">
   <div class="auto-container">
        <div class="row clearfix" style="padding: 15px;">
            <div class="contact-info col-sm-12">
                <div class="inner" style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.05);">
                    
                    <div style="margin-bottom: 30px;">
                        <h2 style="font-weight: 700; color: #0f172a; margin-bottom: 10px; font-size: 28px;">Regulasi</h2>
                        <div style="width: 60px; height: 4px; background-color: #0056b3; border-radius: 2px;"></div>
                    </div>

                    <div class="table-responsive">
                        <table class="table" style="width: 100%; border-collapse: separate; border-spacing: 0;">
                            <thead>
                                <tr>
                                <th style="background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 16px; border-bottom: 2px solid #e2e8f0; border-top-left-radius: 8px; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;">No.</th>
                                <th style="background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 16px; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;">Aturan</th>
                                <th style="background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 16px; border-bottom: 2px solid #e2e8f0; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px;">Keterangan</th>
                                <th style="background-color: #f1f5f9; color: #475569; font-weight: 600; padding: 16px; border-bottom: 2px solid #e2e8f0; border-top-right-radius: 8px; text-transform: uppercase; font-size: 13px; letter-spacing: 0.5px; text-align: center;">Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $no = 0; if ($tableData) { foreach ($tableData as $t) { $no++; ?>
                                    <tr style="transition: all 0.2s ease;">
                                        <td style="padding: 20px 16px; border-bottom: 1px solid #e2e8f0; color: #1E293B; vertical-align: middle;">{{ $no }}</td>
                                        <td style="padding: 20px 16px; border-bottom: 1px solid #e2e8f0; color: #1E293B; vertical-align: middle; font-weight: 500;">{{ $t->aturan }}</td>
                                        <td style="padding: 20px 16px; border-bottom: 1px solid #e2e8f0; color: #64748b; vertical-align: middle;">{{ $t->keterangan }}</td>
                                        <td style="padding: 20px 16px; border-bottom: 1px solid #e2e8f0; vertical-align: middle; text-align: center;">
                                            <a href='{{ ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http") }}://e-ppid.ptgaram.com/upload/{{ $t->file }}' 
                                               style="display: inline-flex; align-items: center; justify-content: center; background-color: #0056b3; color: white; padding: 8px 20px; border-radius: 50px; font-size: 14px; font-weight: 500; text-decoration: none; transition: background-color 0.3s ease; box-shadow: 0 2px 4px rgba(0,86,179,0.2);"
                                               onmouseover="this.style.backgroundColor='#004494'" 
                                               onmouseout="this.style.backgroundColor='#0056b3'"
                                               target="_blank">
                                               <i class="fa fa-download" style="margin-right: 8px;"></i> Download 
                                            </a>
                                        </td>
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




