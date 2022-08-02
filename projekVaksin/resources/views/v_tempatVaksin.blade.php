@extends('layouts.frontend')
@section('content')
  <section class="col connectedSortable">
     <div class="row">
  <!-- Left col -->
        <section class="col-sm-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="grid text-center ">
                        <i class="fa fa-filter mr-1"></i>
                        Filter Data Tempat Vaksinasi
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-1">
                        <form method="post">
                            <button type="submit" class="btn-r" id="all" name="all">All Data</button>
                        </form>

                        <form method="post" enctype="multipart/form-data">

                            <div class="form-group mt-3">
                            <label for="p_kota" class="form-label">Pilih Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control">
                                <option value="">-- Pilih Kecamatan --</option>
                                @foreach ($kecamatan as $dataKec)
                                    <option value="{{$dataKec->id_kecamatan}}">{{$dataKec->nama_kecamatan}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="text-center btn-s mt-3"><input type="submit" name="cari" value="Search"></div>
                        </form>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </section>

  <!-- /.Left col -->
        <section class="col-md-12 connectedSortable ">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                <i class="fas fa-building mr-1"></i>
                SIGPV
                </h3>
                <div class="card-tools">

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
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
  <div class="col-sm-12">
    <div class="text-center"><h2><b>Daftar Tempat Vaksinasi</b></h2></div>
    <table id="example2" class="table table-bordered table-striped">
      <thead>
          <tr>
            <th width="10px" class="text-center">No</th>
            <th>Nama</th>
            <th>Foto</th>
            <th>Fasilitas</th>
            <th>Alamat</th>
            <th>Kecamatan</th>
            <th width="150px" class="text-center">Action</th>
          </tr>
      </thead>
      <tbody>
          <?php $no=1?>
          @foreach ($vaksin as $data)
              <tr>
                  <td class="text-center">{{$no++}}</td>
                  <td>{{$data->nama_tempatVaksin}}</td>
                  @if($data->foto != '')
                  <td><img src="{{asset('foto')}}/{{$data->foto}}" width="75px"></td>
                  @else
                      <td><img src="{{asset('foto')}}/notfound.png" width="75px"></td>
                  @endif
                  <td>{{$data->fasilitas}}</td>
                  <td>{{$data->alamat}}</td>
                  <td>{{$data->nama_kecamatan}}</td>
                  <td class="text-center">
                      <a href="/tempatVaksin/{{$data->id_tempatVaksin}}" class="btn btn-sm btn-flat btn-info">detail</a>
                      <button class="btn btn-sm btn-flat btn-success" onclick="return lokasi({{$data->posisi}})">lokasi</button>
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>
  </div>

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

    //Zoom Lokasi pada peta
    const lokasi = (lat, lng) => {
      map.setView([lat, lng],17);
      const component = document.getElementById('scroll');
      component.scrollIntoView({
        behavior: 'smooth'
      });
    }

    var legend = L.control({ position: "bottomright" });

    legend.onAdd = function(map) {
      var div = L.DomUtil.create("div", "legend");
      div.innerHTML += "<h4>Keterangan</h4>";

      div.innerHTML += '<img src="{{asset('marker')}}/marker.png" width="20px"><span> Tempat Vaksin</span><br>';

      return div;
    };

    legend.addTo(map);
  </script>
@endsection
