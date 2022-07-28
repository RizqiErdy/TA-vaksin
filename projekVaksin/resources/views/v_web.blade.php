@extends('layouts.frontend')
@section('content')
  <section class="col connectedSortable">
     <div class="row">
  <!-- Left col -->
        <section class="col-md-8 connectedSortable ">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-building mr-1"></i>
                SIGPV
                </h3>
                <div class="card-tools">

                </div>
                <div class="card-tools">
                    <form class="form-inline" action="/cari" method="GET">
                        @csrf
                        <input class="form-control mr-sm-1" name="cari" value="{{ old('cari') }}" type="search" placeholder="Cari Lokasi Vaksinasi..." aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <div class="text-danger">
                        @error('cari')
                            {{$message}}
                        @enderror
                    </div>
                    </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content p-1">
                <div class="chart tab-pane active" id="map"
                    style="position: relative; height: 500px; width:100%;">
                </div>

                </div>
            </div><!-- /.card-body -->
            </div>

        </section>
  <!-- /.Left col -->
        <section class="col-sm-4 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="grid text-center mb-1 mt-2">
                        <i class="fa fa-calendar mr-1"></i>
                        Jadwal & Lokasi Vaksin 7 Hari Kedepan
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-1">
                        <div class="bh-sl-loc-list col-md-12">
                            <div class="p-2 m-1 bg-light border">Grid item 1</div>
                            <div class="p-2 m-1 bg-light border">Grid item 2</div>
                            <div class="p-2 m-1 bg-light border">Grid item 3</div>
                            <div class="p-2 m-1 bg-light border">Grid item 1</div>
                            <div class="p-2 m-1 bg-light border">Grid item 2</div>
                            <div class="p-2 m-1 bg-light border">Grid item 3</div>
                            <div class="p-2 m-1 bg-light border">Grid item 1</div>
                            <div class="p-2 m-1 bg-light border">Grid item 2</div>
                            <div class="p-2 m-1 bg-light border">Grid item 3</div>
                            <div class="p-2 m-1 bg-light border">Grid item 1</div>
                            <div class="p-2 m-1 bg-light border">Grid item 2</div>
                            <div class="p-2 m-1 bg-light border">Grid item 3</div>
                          </div>
                    <div class="chart tab-pane active" id="map"
                        style="position: relative">
                    </div>

                    </div>
                </div><!-- /.card-body -->
                </div>
        </section>
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

    // Variabel untuk menampilkan map
    var map = L.map('map', {
    center: [-7.560565, 110.816394],
    zoom: 13,
    layers: [peta1, Kecamatan, vaksin]
    });

    // Variabel untuk Basemap peta
    var baseMaps = {
      "Grayscale": peta1,
      "Satelit": peta2,
      "Streets": peta3,
      "Dark": peta4
    };

    //Overlayer menu
    var overlayer = {
      "Kecamatan" : Kecamatan,
      "Tempat Vaksin" : vaksin,
    }

    //Menampilkan Kecamtan pada Peta
    @foreach($kecamatan as $data)
      L.geoJSON(<?= $data->geojson?>,{
      style :{
          fillColor: '{{$data->warna}}',
          weight: 2,
          opacity: 1,
          color: 'white',
          fillOpacity: 0.7
      }
      }).addTo(Kecamatan).bindPopup('{{$data->nama_kecamatan}}');;
    @endforeach

    L.control.layers(baseMaps, overlayer).addTo(map);

    //Menampilkan Tempat Vaksin Pada Peta
    @foreach($vaksin as $data)
      var markerVaksin = L.icon({
        iconUrl : '{{asset('marker')}}/marker.png',
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
      var informasi = "<center><h4><b>{{$data->nama_tempatVaksin}}</b></h4><br><img width='65%' height='100px' src='{{asset('foto')}}/"+foto+"'<br><br>Tempat Vaksin<br>{{$data->alamat}}<br><a href='/tempatVaksin/{{$data->id_tempatVaksin}}' class='btn btn-success'>Detail</a></center>"
      L.marker([<?= $data->posisi?>],{icon: markerVaksin}).
        addTo(vaksin).
        bindPopup(informasi);
    @endforeach

    var legend = L.control({ position: "bottomright" });

    legend.onAdd = function(map) {
      var div = L.DomUtil.create("div", "legend");
      div.innerHTML += "<h4>Keterangan</h4>";

      div.innerHTML += '<img src="{{asset('marker')}}/marker.png" width="25px"><span>Tempat Vaksin</span><br>';

      return div;
    };

    legend.addTo(map);
  </script>
@endsection
