
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <!--Leaflet js-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<title>SIGVS | {{$title}}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminLTE')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE')}}/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <style>
    .legend {
  padding: 6px 8px;
  font: 14px Arial, Helvetica, sans-serif;
  background: white;
  background: rgba(255, 255, 255, 0.8);
  /*box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);*/
  /*border-radius: 5px;*/
  line-height: 24px;
  color: #555;
}
.legend h4 {
  text-align: center;
  font-size: 16px;
  margin: 1px 12px 8px;
  color: rgb(0, 0, 0);
}

.legend span {
  position: relative;
  bottom: 3px;
}

.legend i {
  width: 18px;
  height: 18px;
  float: left;
  margin: 0 8px 0 0;
  opacity: 0.7;
}

.legend i.icon {
  background-size: 18px;
  background-color: rgba(255, 255, 255, 1);
}
.bh-sl-loc-list {
    height: 503px;
    overflow-x: auto;
    font-size: 18px;
}
/* .bh-sl-loc-list .p-2 {
    padding-bottom: 200px;
} */
.bh-sl-loc-list .p-2 .list-label {
    float: left;
    margin: 10px 0 0 6px;
    padding: 6px;
    width: 27px;
    text-align: center;
    background: #d9232d;
    color: #fff;
    font-weight: 700;
    font-size: 10px;
    border-radius: 15px;
}
.bh-sl-loc-list .p-2 .list-details {
    /* float: left; */
    margin-left: 40px;
    width: 80%;
    font-size: 15px;
}
.bh-sl-loc-list .p-2 .list-details .list-content {
    padding: 5px;
}
.list-content .loc-name {
    font-size: 15px;
    font-weight: 700;
}
.list-unstyled {
    padding-left: 0;
    list-style: none;
    list-style-position: initial;
    list-style-image: initial;
    list-style-type: none;
}
.btn-r {
    background: #d9232d;
    border: 0;
    padding: 10px 24px;
    color: #fff;
    transition: 0.4s;
    border-radius: 4px;
}
.btn-s input[type=submit] {
    background: #d9232d;
    border: 0;
    padding: 10px 24px;
    color: #fff;
    transition: 0.4s;
    border-radius: 4px;
}
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-dark bg-danger">
    <div class="container">
      <a href="/" class="navbar-brand">
        <img src="{{ asset('foto')}}/logo3.png" alt="AdminLTE Logo" class="brand-image "
             style="opacity: .8">
        <span class="brand-text font-weight-light"><b>SIGV SUKOHARJO</b></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">

        </ul>

        <ul class="order-1 order-md-3 navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/tempatvaksin" class="nav-link">Tempat Vaksinasi</a>
            </li>
            <li class="nav-item">
                <a href="/about" class="nav-link">About</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}" >Login</a>
            </li>
        </ul>

      </div>

      <!-- Right navbar links -->
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-12 mt-4">
            <center><h1 class="m-0 text-dark"> {{$title}} </h1></center>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
            <div class="row">
                @yield('content')
            </div>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer navbar-dark">
    <!-- To the right -->
    <!-- Default to the left -->
    <center><p style="color: white">Copyright &copy; SIG Vaksinasi Kab.Sukoharjo</p></center>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('adminLTE')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE')}}/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('adminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminLTE')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('adminLTE')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('adminLTE')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('adminLTE')}}/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
  window.setTimeout(function(){
    $(".text-danger").fadeTo(450,0).slideUp(450,function(){
      $(this).remove();
    });
  },3000)
</script>
</body>
</html>
