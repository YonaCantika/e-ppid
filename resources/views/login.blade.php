<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
  <title>PT Garam (Persero)</title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="{{ url('/') }}/assets/css/material-kit.min.css?v=2.0.6" rel="stylesheet" />
  <link href="{{ url('/') }}/assets/demo/demo-kit.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
  <nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ url('/') }}/">Keterbukaan Informasi Publik</a>
      </div>
    </div>
  </nav>
  <div class="page-header header-filter" style="background: rgba(0,0,0,.0); background-size: cover; background-position: top center;">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ml-auto mr-auto mb-auto">
          <div class="card card-login">
            {{ form_open('secure/login', array('id' => 'FormLogin','class'=>'form form-horizontal','style'=>'min-height: 300px;')) }}
            <div class="card-header card-header-warning text-center">
              <h3 class="card-title">FORM LOGIN</h3>
            </div>
            <div class="card-body">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">person</i>
                  </span>
                </div>
                <input type="text" class="form-control" placeholder="Username . . ." id="UserName">
              </div>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock_outline</i>
                  </span>
                </div>
                <input type="password" class="form-control" placeholder="Password . . ." id="UserPassword">
              </div>
            </div>
            <div class="footer text-center">
              <button type="submit" class="btn btn-success" value="LOGIN"> LOGIN</button>
            </div>
            {{ form_close() }}
          </div>
          <div id="ResponseInput"></div>
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <div class="copyright float-right">
          &copy;
          <script>
            document.write(new Date().getFullYear())
          </script>, made with <i class="material-icons">favorite</i> by Divisi IT PT Garam (persero).
        </div>
      </div>
    </footer>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ url('/') }}/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="{{ url('/') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="{{ url('/') }}/assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="{{ url('/') }}/assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ url('/') }}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGat1sgDZ-3y6fFe6HD7QUziVC6jlJNog"></script>
  <!-- Place this tag in your head or just before your close body tag. -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!--  Plugin for Sharrre btn -->
  <script src="{{ url('/') }}/assets/js/plugins/jquery.sharrre.js" type="text/javascript"></script>
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="{{ url('/') }}/assets/js/material-kit.min.js?v=2.0.6" type="text/javascript"></script>
  <script>

    $('#FormLogin').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ url('secure/login') }}'+'/'+$('#UserName').val()+'/'+$('#UserPassword').val(),
        type: "POST",
        data: {"UserName":$('#UserName').val(),"UserPassword":$('#UserPassword').val()},
          // data: $(this).serialize(),
          dataType:'json',
          success: function(json){
            //response dari json_encode di controller

            if(json.status == 1){ window.location.href = json.url_home; }else
            if(json.status == 0){ 
              $('#ResponseInput').html(json.pesan); 

            }else
            if(json.status == 2){
              $('#ResponseInput').html(json.pesan); 
              $('#UserPassword').val('');
            }
          },
          error: function (jqXHR, textStatus, errorThrown ){
            alert("Tunggu Sebentar!");
          }
        });
    });

    $(document).ready(function() {
      $('#UserName,#UserPassword').focus(function(e){
        $('#ResponseInput').html('');
      });
    });
  </script>
  <noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
  </noscript>
</body>

</html>





