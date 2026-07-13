<section class="contact-section" style="padding: 30px 0px 30px;">

	<div class="auto-container">

		<div class="row clearfix" style="padding:5px;">

			<div class="contact-info col-sm-8">

				<div class="inner" style="padding: 15px 10px 10px 15px;">

					<h4 align="left">Register Pemohon Informasi</h4><hr/>

					<p style="font-style: italic; text-align: justify;" align="left">Formulir ini digunakan untuk registrasi pemohon. Dengan mendaftar di Sistem KIP, pemohon mendapatkan kemudahan dalam mengajukan permohonan informasi maupun pengajuan keberatan secara online. Pemohon dinyatakan berhasil mendaftar apabila telah memenuhi semua kelengkapan yang dibutuhkan dan mendapatkan email komfirmasi dari pengelola Sistem KIP.</p>



					<div class="contact-form">

						<form method="post" class="form form-horizontal" id="form-register" action="{{ route('daftar.submit') }}">
							@csrf

							<div class="row clearfix">

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Jenis Permohonan</label>

									</div>

									<div class="col-sm-8">

										<select class="form-control" id="jenis-permohonan-register" name="jenis-permohonan-register" style="height: 38px; padding-top: 0px; padding-bottom: 0px;">

											<option value="1" selected>Perorangan</option>

											<option value="2">Kelompok Orang</option>

											<option value="3">Badan Hukum</option>

										</select>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Jenis Identitas</label>

									</div>

									<div class="col-sm-8">

										<select class="form-control" id="jenis-identitas-register" name="jenis-identitas-register" style="height: 38px; padding-top: 0px; padding-bottom: 0px;">

											<option value="1" selected>KTP</option>

											<option value="2">Pengesahan Badan Usaha</option>

											<option value="3">Surat Kuasa</option>

											<option value="4">Badan Publik</option>

										</select>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Nomor Identitas <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="nomor-identitas-register" name="nomor-identitas-register" placeholder="Nomor Identitas" style="height: 38px">

										<i style="color: red;" id="nomor-identitas-alert" hidden="">Tidak Boleh Kosong.</i>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Nama Lengkap <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="nama-lengkap-register" name="nama-lengkap-register" placeholder="Nama Lengkap" style="height: 38px">

										<i style="color: red;" id="nama-lengkap-alert" hidden="">Tidak Boleh Kosong.</i>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >NPWP</label>

									</div>

									<div class="col-sm-8">

										<input type="text" class="form-control" id="npwp-register" name="npwp-register" placeholder="NPWP" style="height: 38px">

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Email <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="email-register" name="email-register" placeholder="Email" style="height: 38px">

										<i style="color: red;" id="email-alert" hidden="">Tidak Boleh Kosong.</i>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Pekerjaan </label>

									</div>

									<div class="col-sm-8">

										<input type="text" class="form-control" id="pekerjaan-register" name="pekerjaan-register" placeholder="Pekerjaan" style="height: 38px">

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Alamat</label>

									</div>

									<div class="col-sm-8">

										<textarea class="form-control" id="alamat-register" name="alamat-register" placeholder="Tulis Alamat!" style="height: 100px;"></textarea>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >No HP/No WA </label>

									</div>

									<div class="col-sm-8">

										<input type="text" class="form-control" id="telp-register" name="telp-register" placeholder="Contoh : 0813xxxxxxxx" style="height: 38px">

										<i style="color: red;" id="hp-alert" hidden="">Tidak Boleh Kosong.</i>

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >No Fax </label>

									</div>

									<div class="col-sm-8">

										<input type="text" class="form-control" id="fax-register" name="fax-register" placeholder="No Fax" style="height: 38px">

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Password </label>

									</div>

									<div class="col-sm-8">

										<input type="password" class="form-control" id="password-register" name="password-register" style="height: 38px">

									</div>

								</div>

							</div>

							<hr/>

							<button type="submit" class="theme-btn btn-style-one" style="padding-top: 5px; padding-bottom: 5px; border-radius: 5px;"><i class="fa fa-check"></i> &nbsp; Submit Register</button>

						</form>

					</div>

				</div>

			</div>

			<div class="contact-info col-sm-4 col-xs-12">

				<div class="inner" style="padding: 15px 10px 10px 15px;">

					<h4 align="left">Login Pemohon Informasi</h4><hr/>

					<div class="contact-form">

						<form method="post" id="form-login" action="{{ route('login.submit') }}">
							@csrf

							<div class="row clearfix">



								<div class="form-group" style="text-align: left;">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-user"></i></span>

										<input type="text" name="email" id="usern" class="form-control" placeholder="Email" style="height: 35px">

									</div>

									@error('email') <i style="color: red;">{{ $message }}</i> @enderror

								</div>



								<div class="form-group" style="text-align: left;">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-key"></i></span>

										<input type="password" name="password" id="passw" class="form-control" placeholder="Password" style="height: 35px">

									</div>

									@error('password') <i style="color: red;">{{ $message }}</i> @enderror

								</div>

								<div class="form-group" style="text-align: left;">

									<p id="ResponseInput"></p>

								</div>

								<div class="form-group col-sm-12 text-left">

									<button type="submit" class="theme-btn btn-style-one" style="padding-top: 2px; padding-bottom: 2px; border-radius: 5px;"><i class="fa fa-share"></i> &nbsp; Login</button>

								</div>
                        <div class="form-group col-sm-6 text-left"><p ><a href="{{ url('/') }}/welcome/lupa_password ">Lupa Password?</a></p></div>
								<!-- <div class="form-group col-sm-6 text-right"><p ><a href="{{ url('/') }}/secure ">Login Admin</a></p></div> -->
							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript">

</script>



</script>




