@extends('layouts.frontend')
@section('content')
  <section class="col connectedSortable">
     <div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card" id="scroll">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-building mr-1"></i>
          SIG Persebaran Vaksinasi Kab.Sukoharjo
        </h3>

      </div><!-- /.card-header -->
      <div class="card-body">

        <div class="tab-content p-0" >
          <div class="chart tab-pane active" id="map"
          style="position: relative; height: 400px; width:100%;">

          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <div class="col-sm-12">
      <div class="text-center"><h2><b>Daftar Tempat Vaksin Kecamatan {{$kec->nama_kecamatan}}</b></h2></div>
      <table id="example2" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="10px" class="text-center">No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1?>
            @foreach ($vaksin as $data)
                <tr>
                    <td class="text-center">{{$no++}}</td>
                    <td>{{$data->nama_tempatVaksin}}</td>
                    <td>{{$data->alamat}}</td>
                    <td class="text-center">
                        <a href="/tempatVaksin/{{$data->id_tempatVaksin}}" class="btn btn-sm btn-flat btn-info">detail</a>
                        <button class="btn btn-sm btn-flat btn-success" onclick="return lokasi({{$data->posisi}})">lokasi</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
  </section>
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
  center: [-7.560565, 110.816394],
  zoom: 13,
  layers: [peta1, Kecamatan, vaksin]
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

  var kec =  L.geoJSON(<?= $kec->geojson?>,{
    style :{
      weight : 2,
      color : 'white',
      fillColor : '{{$kec->warna}}',
      fillOpacity : 0.7,
    }
    }).addTo(Kecamatan);

    map.fitBounds(kec.getBounds())
  L.control.layers(baseMaps, overlayer).addTo(map);

  //Menampilkan Tempat Vaksin Pada Peta
  @foreach($vaksin as $data)
      var markerVaksin = L.icon({
        iconUrl : '{{asset('marker')}}/{{$data->marker}}',
        iconSize : [38, 55],
      });

      //Mengecek jika foto tidak ada maka membawakan foto default NoImage
      var foto = '{{$data->foto}}';
      if(foto != ''){
        foto = '{{$data->foto}}';
      }else{
        foto = 'notfound.png';
      }

      //Menambahkan marker dan pop up informasi pada marker
      var informasi = "<center><h4><b>{{$data->nama_tempatVaksin}}</b></h4><br><img style = 'width: 150px' src='{{asset('foto')}}/"+foto+"'<br><br>Tempat Vaksin<br>{{$data->alamat}}<br><a href='/tempatVaksin/{{$data->id_tempatVaksin}}' class='btn btn-success'>Detail</a></center>"
      var mark = L.marker([<?= $data->posisi?>],{icon: markerVaksin}).addTo(vaksin).
        bindPopup(informasi);

  @endforeach

  const lokasi = (lat, lng) => {
    map.setView([lat, lng],17);
    const component = document.getElementById('scroll');
    component.scrollIntoView({
      behavior: 'smooth'
    });
  }
</script>
@endsection
