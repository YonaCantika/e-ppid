<section class="contact-section" style="padding: 30px 0px 30px;">

	<div class="auto-container">

		<div class="row clearfix" style="padding:5px;">

			<div class="contact-info col-sm-12">

				<h1>Mohon maaf, halaman ini sedang dalam perbaikan</h1>

			</div>

		</div>

	</div>

</section>

<script type="text/javascript">

	$( "#form-register" ).submit(function( event ) {
		//event.preventDefault();

		$('#nomor-identitas-alert').hide();

		$('#nama-lengkap-alert').hide();

		$('#email-alert').hide();

		

		if ( !$( "#nomor-identitas-register" ).val()) {

			$('#nomor-identitas-alert').show();

		} else if ( !$( "#nama-lengkap-register" ).val()) {

			$('#nama-lengkap-alert').show();

		} else if ( !$( "#email-register" ).val()) {

			$('#email-alert').text('Email tidak boleh kosong!');

			$('#email-alert').show();

		} else {

			$.ajax({

				url : "{{ url('welcome/get_visitor') }}",
				data: $(this).serialize(),
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					if (data == 0) {
						$.ajax({
							url : "{{ url('welcome/register_visitor2') }}",
							data: $('#form-register').serialize(),
							type: "POST",
							dataType: "JSON",
							success: function(balikan) {
								//var obj = jQuery.parseJSON(balikan);
								//alert('MASUIK');
								//alert(obj);
								if (balikan.status) {
									location.replace('{{ url('/') }}/welcome/validasi/?id='+balikan.id); 
									// var id = obj.id;
									// $.ajax({
									// 	url : "{{ url('welcome/validasi') }}",
									// 	data : {id:id},
									// 	type : "POST",
									// 	success: function(output){

									// 	}

									// })
									// swal({ type:"success", title: "Sukses!", text: "Data berhasil di "+type+"kan!.", timer: 3000 });
									
									// alert('Registrasi Sukses, Silahkan check email !');

									// $('#form-register')[0].reset();

								}else{

									// swal({ type:"danger", title: "Gagal!", text: "Data gagal di "+type+"kan!.", timer: 3000});

									alert('Registrasi gagal! Tidak mendapatkan kode unik');

								}

							},

							error: function (jqXHR, textStatus, errorThrown ){

								alert('Error get data from ajax');

							}

						});

					}else{

						$('#email-alert').text('Email sudah tersedia!');

						$('#email-alert').show();

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




