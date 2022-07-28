@extends('layouts.frontend')
@section('content')
  <section class="col connectedSortable">
    <div class="row">
  <!-- Left col -->
  <section class="col-lg-8 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-building mr-1"></i>
          Lokasi {{$vaksin->nama_tempatVaksin}}
        </h3>
      </div><!-- /.card-header -->
      <div class="card-body">

        <div class="tab-content p-0">
          <div class="chart tab-pane active" id="map"
          style="position: relative; height: 300px; width:100%;">

          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
  </section>
  <div class="card col-sm-4">
    <div class="card-header">
      <h3 class="card-title">Foto {{$vaksin->nama_tempatVaksin}}</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <br><center>
        @if($vaksin->foto != '')
          <img src="{{asset('foto')}}/{{$vaksin->foto}}" width="100%" height="280px">
        @else
          <img src="{{asset('foto')}}/notfound.png" width="100%" height="280px">
        @endif
      </center>
    </div>
    <!-- /.card-body -->
  </div>
  <div class="card col-lg-12 ">
    <div class="card-header">
      <h3 class="card-title">Detail Informasi Tempat Vaksin</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table">
        <thead>
        </thead>
        <tbody>
          <tr>
            <td><b>Nama</b></td>
            <td style="width: 10px">:</td>
            <td>{{$vaksin->nama_tempatVaksin}}</td>
          </tr>
          <tr>
            <td><b>Alamat</b></td>
            <td style="width: 10px">:</td>
            <td>{{$vaksin->alamat}}</td>
          </tr>
          <tr>
            <td><b>Deskripsi</b></td>
            <td style="width: 10px">:</td>
            <td>{{$vaksin->deskripsi}}</td>
          </tr>
          <tr>
            <td><b>Fasilitas</b></td>
            <td style="width: 10px">:</td>
            <td>{{$vaksin->fasilitas}}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->


        <!-- /.row -->
      </div>

<script>
  var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox/streets-v11'
  });

  var peta2 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox/satellite-v9'
  });


  var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  });

  var peta4 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  id: 'mapbox/dark-v10'
  });

  var Kecamatan = L.layerGroup();
  var vaksin = L.layerGroup();

  var map = L.map('map', {
  center: [{{$vaksin->posisi}}],
  zoom: 15,
  layers: [peta1, vaksin]
  });

  var baseMaps = {
  "Grayscale": peta1,
  "Satelit": peta2,
  "Streets": peta3,
  "Dark": peta4
  };

  var overlayer = {
    "Kecamatan" : Kecamatan,
    "Tempat Vaksin" : vaksin,
  }

  @foreach($kecamatan as $data)
      L.geoJSON(<?= $data->geojson?>,{
      style :{
      color : 'white',
      fillColor : '{{$data->warna}}',
      fillOpacity : 1.0,
      }
      }).addTo(Kecamatan).bindPopup('{{$data->nama_kecamatan}}');;
    @endforeach
  L.control.layers(baseMaps, overlayer).addTo(map);

  //Menampilkan Tempat Vaksin Pada Peta
      var markerVaksin = L.icon({
        iconUrl : '{{asset('marker')}}/marker.png',
        iconSize : [38, 55],
      });

      //Menambahkan marker
      L.marker([<?= $vaksin->posisi?>],{icon: markerVaksin}).
        addTo(map);
</script>
@endsection
