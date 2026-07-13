
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PT GARAM</title>
    <!-- Stylesheets -->
    <link href="{{ asset('web/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('web/plugins/revolution/css/settings.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
    <link href="{{ asset('web/plugins/revolution/css/layers.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
    <link href="{{ asset('web/plugins/revolution/css/navigation.css') }}" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
    <link href="{{ asset('web/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('web/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous"> 
    <link rel="shortcut icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="{{ asset('web/js/jquery.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).ajaxStop(function() {
            setTimeout(function(){
                $( ".se-pre-con" ).hide();
            },500);
        });
        $(document).ajaxStart(function() {
            $(".se-pre-con").show();
        });
        $(document).ajaxError(function() {
            $( ".se-pre-con" ).hide();
        });
        $(function () {
            $(".select2").select2();
        });




        function eroorAjax(jqXHR,exception) {
            if (jqXHR.status === 0) {
                swal('Kesalahan','Tidak ada koneksi internet','error');
                return;
            } else if (jqXHR.status == 404) {
                swal('Kesalahan','Requested page not found.','error');
                return;
            } else if (jqXHR.status == 500) {
                swal('Kesalahan','Internal Server Error.','error');
                return;
            } else if (exception === 'parsererror') {
                swal('Kesalahan','Requested JSON parse failed.','error');
                return;
            } else if (exception === 'timeout') {
                swal('Kesalahan','Request Timout','error');
                return;
            } else if (exception === 'abort') {
                swal('Kesalahan','Ajax request aborted.','error');
                return;
            } else {
                swal('Kesalahan','Terjadi Kesalahan','error');
                return;
            }
        }
    </script>

    <style type="text/css">

        .page-title{
            position:relative;
            text-align:center;
            background-color:#f6f8fb;
            padding:70px 0px 70px 0px;
            background-image: url("{{ asset('upload/slide/'.$title) }}");
            background-repeat: no-repeat;
            background-position: 50% 50%;
            padding:130px 0;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .se-pre-con {

            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            opacity: 0.8;
            background-color: white;
        }

        .img-responsive1 {
            width: 200px;
            height: 200px;
            position:absolute;
            left:45%;
            top:40%;
            margin-top:-25px; /* This needs to be half of the height */
            margin-left:-25px;
        }

        .modal-body {
            max-height: calc(100vh - 180px);
            overflow-y: auto;
        }

    </style>

</head>
<body>
    <div class="se-pre-con">
        <img src='{{ asset("assets/preloaderwebsite.gif") }}' class="img-responsive1" />
    </div>
    <div class="page-wrapper">
        <header class="main-header">
            <div class="header-top">
                <div class="auto-container">
                    <div class="clearfix">
                        <div class="top-left">
                            <ul class="top-links clearfix">
                                <li><span class="fa fa fa-phone"></span>{{ $kontak->telp }}</li>
                                <li><a href="mailto:{{ $kontak->email }}"><i class="far fa-envelope"></i> {{ $kontak->email }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @include('web.header')
            <!--Page Title-->
            @if (request()->segment(1) != 'beranda' && request()->segment(1) != '')
            <section class="page-title" style="padding: 70px 0px;">
                <div class="auto-container">
                    <h1>Pusat Layanan Informasi dan Dokumentasi</h1>
                </div>
            </section>
            @endif
            @include($content)
        </header>
        <footer class="main-footer" style="padding: 0px 0px 0px;">
            <div class="footer-bottom" style="margin-top: 5px;">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="copyright">&copy; 2019 <a href="{{ url('secure') }}">PT Garam</a> All Rights Reserved. </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-arrow-up"></span></div>
</body>
<script type="text/javascript">
    $(window).on('load', function () {
        $(".se-pre-con").fadeOut('slow');
    });
    $(document).ready(function() {
        // Fallback jika event load terhalang error JS lain
        setTimeout(function() {
            $(".se-pre-con").fadeOut('slow');
        }, 1500);
    });
</script>
<link rel="stylesheet" type="text/css" href="{{ asset('galery/css/style.css') }}">
<script src="{{ asset('galery/js/isotope.js') }}"></script>
<script src="{{ asset('galery/js/custom.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('web/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script src="{{ asset('web/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script src="{{ asset('web/js/main-slider-script.js') }}"></script>
<script src="{{ asset('web/js/jquery.fancybox.pack.js') }}"></script>
<script src="{{ asset('web/js/jquery.fancybox-media.js') }}"></script>
<script src="{{ asset('web/js/owl.js') }}"></script>
<script src="{{ asset('web/js/appear.js') }}"></script>
<script src="{{ asset('web/js/wow.js') }}"></script>
<script src="{{ asset('web/js/jquery-ui.js') }}"></script>
<script src="{{ asset('web/js/main-slider-script.js') }}"></script>
<script src="{{ asset('web/js/script.js') }}"></script>
</html>





