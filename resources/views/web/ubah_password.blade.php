<section class="contact-section" style="padding: 30px 0px 30px;">

	<div class="auto-container">

		<div class="row clearfix" style="padding:5px;">

			<div class="contact-info col-sm-8">

				<div class="inner" style="padding: 15px 10px 10px 15px;">

					<h4 align="left">Ubah Password</h4><hr/>

					<p style="font-style: italic; text-align: justify;" align="left">Silahkan cek no WA yang Anda daftarkan {{ $wa }} untuk mendapatkan kode unik.</p>


					<div class="contact-form">

						<form method="post" class="form form-horizontal" id="form-register" action="javascript:void(0)">

							<div class="row clearfix">

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Masukkan kode unik</label>

									</div>

									<div class="col-sm-8">
										<input type="hidden" class="form-control" id="email" name="email" value="{{ $email }}" style="height: 38px">
										<input type="hidden" class="form-control" id="wa" name="wa" value="{{ $wa }}" style="height: 38px">
										<input type="text" class="form-control" id="kde" name="kde" placeholder="Kode Unik" style="height: 38px">

									</div>

								</div>

								<div class="form-group">

									<div class="col-sm-4" align="right">

										<label class="control-label">Password Baru</label>

									</div>

									<div class="col-sm-8">

										<input type="password" class="form-control" id="password-baru" name="password-baru" style="height: 38px" required>

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

	$( "#form-register" ).submit(function( event ) {

		$.ajax({

			url : "{{ url('welcome/change_password') }}",

			data: $(this).serialize(),

			type: "POST",

			dataType: "JSON",

			success: function(data) {

				if (data.status) {

					alert('Ubah Password Sukses, Silahkan Login menggunakan Email dan Password Baru Anda !');
					location.href = "https://e-ppid.ptgaram.com/daftar";

				}else{

					alert('Kode unik tidak cocok!');

				}

			},

			error: function (jqXHR, textStatus, errorThrown ){

				alert('Error get data from ajax');

			}

		});

		

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




