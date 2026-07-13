<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/') }}/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="{{ url('/') }}/assets/img/favicon.png">
  <link rel="shortcut icon" href="{{ url('/') }}/assets/favicon.ico" type="image/x-icon">
  <link rel="icon" href="{{ url('/') }}/assets/favicon.ico" type="image/x-icon">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    PT Garam (Persero)
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="{{ url('/') }}/assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <link href="{{ url('/') }}/assets/css/material-dashboard.min.css?v=2.1.0" rel="stylesheet" />
  <link href="{{ url('/') }}/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="white">
      <div class="logo">
        <a href="http://ptgaram.com" class="simple-text logo-normal">PT Garam (Persero)</a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item {{ ($namamenu == 'Beranda' ? 'active':'') }}">
            <a class="nav-link" href="{{ asset('admin') }}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item {{ ($namamenu == 'Regulasi' ? 'active':'') }}">
            <a class="nav-link" href="{{ url('/') }}/admin/regulasi">
              <i class="material-icons">gavel</i>
              <p>Regulasi</p>
            </a>
          </li>
          <li class="nav-item {{ ($namamenu == 'Maklumat' ? 'active':'') }}">
            <a class="nav-link" href="{{ url('/') }}/admin/maklumat">
              <i class="material-icons">priority_high</i>
              <p>Maklumat</p>
            </a>
          </li>
          <li class="nav-item {{ ($namamenu == 'Informasi' ? 'active':'') }}">
            <a class="nav-link" href="{{ url('/') }}/admin/informasi">
              <i class="material-icons">contactless</i>
              <p>Informasi</p>
            </a>
          </li>
          <li class="nav-item {{ ($namamenu == 'Prosedur' ? 'active':'') }}">
            <a class="nav-link" href="{{ url('/') }}/admin/prosedur">
              <i class="material-icons">event_note</i>
              <p>Prosedur</p>
            </a>
          </li>
          <li class="nav-item {{ ($namamenu == 'Pengunjung' ? 'active':'') }}">
            <a class="nav-link" href="{{ url('/') }}/admin/pengunjung">
              <i class="material-icons">people_alt</i>
              <p>Pengunjung</p>
            </a>
          </li>
          <hr/>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/') }}/secure/logout">
              <i class="material-icons">exit_to_app</i>
              <p>Keluar</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Keterbukaan Informasi Publik</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
        </div>
      </nav>
      <script src="{{ url('/') }}/assets/js/core/jquery.min.js"></script>
      <script src="{{ url('/') }}/assets/js/core/popper.min.js"></script>
      <script src="{{ url('/') }}/assets/js/core/bootstrap-material-design.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/moment.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/sweetalert2.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/jquery.validate.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/jquery.bootstrap-wizard.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/bootstrap-selectpicker.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/jquery.dataTables.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/bootstrap-tagsinput.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/jasny-bootstrap.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/fullcalendar.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/jquery-jvectormap.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/nouislider.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/arrive.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/chartist.min.js"></script>
      <script src="{{ url('/') }}/assets/js/plugins/bootstrap-notify.js"></script>
      <script src="{{ url('/') }}/assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
      <script src="{{ url('/') }}/assets/demo/demo.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
      <!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
      <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.dataTables.min.js"></script>
      <script src="https://demos.creative-tim.com/material-dashboard-pro/assets/js/plugins/jquery.validate.min.js"></script>
      <?php @include($content) ?>
      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())
            </script>, Made with <i class="material-icons">favorite</i> by Divisi IT PT Garam (persero).
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
</body>

</html>





