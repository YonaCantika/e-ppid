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

							@if ($errors->has('email-register') || $errors->has('nomor-identitas-register') || $errors->has('nama-lengkap-register') || $errors->has('pekerjaan-register') || $errors->has('alamat-register') || $errors->has('telp-register') || $errors->has('password-register'))
								<div class="alert alert-danger" style="border-radius: 5px; margin-bottom: 15px;">
									<strong><i class="fa fa-exclamation-triangle"></i> Pendaftaran Gagal!</strong> Silakan periksa kembali isian formulir Anda.
									@if ($errors->has('email-register'))
										<br><i class="fa fa-info-circle"></i> <strong>Email:</strong> {{ $errors->first('email-register') }}
									@endif
								</div>
							@endif

							<div class="row clearfix">

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Jenis Permohonan <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8">

										<select class="form-control" id="jenis-permohonan-register" name="jenis-permohonan-register" style="height: 38px; padding-top: 0px; padding-bottom: 0px;" required>

											<option value="1" {{ old('jenis-permohonan-register') == '1' ? 'selected' : '' }}>Perorangan</option>

											<option value="2" {{ old('jenis-permohonan-register') == '2' ? 'selected' : '' }}>Kelompok Orang</option>

											<option value="3" {{ old('jenis-permohonan-register') == '3' ? 'selected' : '' }}>Badan Hukum</option>

										</select>

										@error('jenis-permohonan-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Jenis Identitas <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8">

										<select class="form-control" id="jenis-identitas-register" name="jenis-identitas-register" style="height: 38px; padding-top: 0px; padding-bottom: 0px;" required>

											<option value="1" {{ old('jenis-identitas-register') == '1' ? 'selected' : '' }}>KTP</option>

											<option value="2" {{ old('jenis-identitas-register') == '2' ? 'selected' : '' }}>Pengesahan Badan Usaha</option>

											<option value="3" {{ old('jenis-identitas-register') == '3' ? 'selected' : '' }}>Surat Kuasa</option>

											<option value="4" {{ old('jenis-identitas-register') == '4' ? 'selected' : '' }}>Badan Publik</option>

										</select>

										@error('jenis-identitas-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Nomor Identitas <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="nomor-identitas-register" name="nomor-identitas-register" value="{{ old('nomor-identitas-register') }}" placeholder="Nomor Identitas" style="height: 38px" required>

										@error('nomor-identitas-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Nama Lengkap <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="nama-lengkap-register" name="nama-lengkap-register" value="{{ old('nama-lengkap-register') }}" placeholder="Nama Lengkap" style="height: 38px" required>

										@error('nama-lengkap-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >NPWP</label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="npwp-register" name="npwp-register" value="{{ old('npwp-register') }}" placeholder="NPWP (Opsional)" style="height: 38px">

										@error('npwp-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Email <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="email" class="form-control" id="email-register" name="email-register" value="{{ old('email-register') }}" placeholder="Email" style="height: 38px" required>

										@error('email-register') <i style="color: red; font-weight: bold;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Pekerjaan <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="pekerjaan-register" name="pekerjaan-register" value="{{ old('pekerjaan-register') }}" placeholder="Pekerjaan" style="height: 38px" required>

										@error('pekerjaan-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Alamat <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<textarea class="form-control" id="alamat-register" name="alamat-register" placeholder="Tulis Alamat!" style="height: 100px;" required>{{ old('alamat-register') }}</textarea>

										@error('alamat-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >No HP/No WA <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="telp-register" name="telp-register" value="{{ old('telp-register') }}" placeholder="Contoh : 0813xxxxxxxx" style="height: 38px" required>

										@error('telp-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >No Fax </label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="text" class="form-control" id="fax-register" name="fax-register" value="{{ old('fax-register') }}" placeholder="No Fax (Opsional)" style="height: 38px">

										@error('fax-register') <i style="color: red;">{{ $message }}</i> @enderror

									</div>

								</div>

								<div class="form-group" style="margin-top: -5px;">

									<div class="col-sm-4" align="right">

										<label class="control-label" >Password <span style="color: red;">*</span></label>

									</div>

									<div class="col-sm-8" style="text-align: left;">

										<input type="password" class="form-control" id="password-register" name="password-register" style="height: 38px" required>

										@error('password-register') <i style="color: red;">{{ $message }}</i> @enderror

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




