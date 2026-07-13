<section class="contact-section" style="padding: 30px 0px 30px;">

	<div class="auto-container">

		<div class="row clearfix" style="padding:5px;">

			<div class="contact-info col-sm-8">

				<div class="inner" style="padding: 15px 10px 10px 15px;">

					<h4 align="left">Verifikasi Akun</h4><hr/>

					<p style="font-style: italic; text-align: justify;" align="left">Silahkan masukkan email dan nomor WA yang Anda daftarkan.</p>

					<div class="contact-form">

						<form method="post" class="form form-horizontal" id="form-lupa" action="javascript:void(0)">

							<div class="row clearfix">

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Email</label>

									</div>

									<div class="col-sm-8">
										
										<input type="text" class="form-control" id="email" name="email" placeholder="Email" style="height: 38px">
										<i style="color: red;" id="email-alert" hidden="">Tidak Boleh Kosong.</i>

									</div>

								</div>

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Nomor WA</label>

									</div>

									<div class="col-sm-8">
										
										<input type="text" class="form-control" id="wa" name="wa" placeholder="Nomor WA" style="height: 38px">
										<i style="color: red;" id="wa-alert" hidden="">Tidak Boleh Kosong.</i>

										<div class="form-group" style="text-align: left;">
											<p id="ResponseLupa"></p>
										</div>

									</div>

								</div>								

							</div>

							<hr/>

							<button type="submit" class="theme-btn btn-style-one" style="padding-top: 5px; padding-bottom: 5px; border-radius: 5px;"><i class="fa fa-check"></i> &nbsp; Submit </button>

						</form>

					</div>

				</div>

			</div>

			<div class="contact-info col-sm-4 col-xs-12">

				<div class="inner" style="padding: 15px 10px 10px 15px;">

					<h4 align="left">Login Pemohon Informasi</h4><hr/>

					<div class="contact-form">

						<form method="post" id="form-login" action="javascript:void(0)">

							<div class="row clearfix">



								<div class="form-group" style="text-align: left;">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-user"></i></span>

										<input type="text" name="usern" id="usern" class="form-control" placeholder="Email" style="height: 35px">

									</div>

									<i style="color: red;" id="usern-alert" hidden="">Tidak Boleh Kosong.</i>

								</div>



								<div class="form-group" style="text-align: left;">

									<div class="input-group">

										<span class="input-group-addon"><i class="fa fa-key"></i></span>

										<input type="password" name="passw" id="passw" class="form-control" placeholder="Password" style="height: 35px">

									</div>

									<i style="color: red;" id="passw-alert" hidden="">Tidak Boleh Kosong.</i>

								</div>

								<div class="form-group" style="text-align: left;">

									<p id="ResponseInput"></p>

								</div>

								<div class="form-group col-sm-12 text-left">

									<button type="submit" class="theme-btn btn-style-one" style="padding-top: 2px; padding-bottom: 2px; border-radius: 5px;"><i class="fa fa-share"></i> &nbsp; Login</button>

								</div>
								<div class="form-group col-sm-12 text-left"><p ><a href="{{ url('/') }}/welcome/lupa_password ">Lupa Password?</a></p></div>
							</div>

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript">

	$( "#form-lupa" ).submit(function( event ) {
		//event.preventDefault();

		$('#email-alert').hide();

		$('#wa-alert').hide();

		

		if ( !$( "#email" ).val()) {

			$('#email-alert').show();

		} else if ( !$( "#wa" ).val()) {

			$('#wa-alert').show();

		} else {

			$.ajax({

				url : "{{ url('welcome/cek_email') }}",
				data: $(this).serialize(),
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					if (data == 0) {
						$('#ResponseLupa').text('Email/Nomor WA tidak tersedia di database!');
					}else{
						$.ajax({
							url : "{{ url('welcome/lupa_password2') }}",
							data: $('#form-lupa').serialize(),
							type: "POST",
							dataType: "JSON",
							success: function(json) {
								//var obj = jQuery.parseJSON(balikan);
								//alert('MASUIK');
								//alert(obj);
								if (json.status == 1) {
									location.replace('{{ url('/') }}/welcome/ubah_password/?email='+json.email+'&wa='+json.wa); 
								}else{

									alert('Lupa password gagal! Tidak mendapatkan kode unik');

								}

							},

							error: function (jqXHR, textStatus, errorThrown ){

								alert('Error get data from ajax');

							}

						});

					}

				},

				error: function (jqXHR, textStatus, errorThrown ){

					alert('Error get data from ajax');

				}

			});

		}

		event.preventDefault();

	});



	$( "#form-login" ).submit(function( event ) {

		$('#usern-alert').hide();

		$('#passw-alert').hide();

		

		if ( !$( "#usern" ).val()) {

			$('#usern-alert').show();

		} else if ( !$( "#passw" ).val()) {

			$('#passw-alert').show();

		} else {

			$.ajax({

				url: "{{ url('secure/visitor') }}",

				type: "POST",

				cache: false,

				data: $(this).serialize(),

				dataType:'json',

				success: function(json){

					if(json.status == 1){ window.location.href = json.url_home; }else

					if(json.status == 0){ 

						$('#ResponseInput').html(json.pesan); 



					}else

					if(json.status == 2){

						$('#ResponseInput').html(json.pesan);

						$('#passw').val('');

					}

				}

			});



		}

		event.preventDefault();

	});



</script>




