@extends('layouts.admin')
@section('content')

<style>
    a {
    color: rgb(255,255,255)
  }
  </style>
  <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$kecamatan->count()}} </h3>

                  <p><a href="/admin/kecamatan">Daftar Kecamatan</a></p>
                </div>
                <div class="icon">

                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  {{-- <h3>{{$jenis->count()}}</h3> --}}
                  <h3>{{$vaksin->count()}}</h3>
                  <p><a href="/admin/jenis">Daftar Tempat Vaksin</a></p>
                </div>
                <div class="icon">

                </div>

              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$jadwal->count()}}</h3>
                  <p><a href="/admin/jadwalvaksin">Daftar Jadwal Vaksin</a></p>
                </div>
                <div class="icon">
                  
                </div>
                
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$user->count()}}</h3>
                  <p><a href="/admin/user">Daftar Users</a></p>
                </div>
                <div class="icon">

                </div>

              </div>
            </div>
            <section class="col connectedSortable">
               <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
              <!-- Custom tabs (Charts with tabs)-->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-building mr-1"></i>
                    SIG Persebaran Vaksinasi Kab.Sukoharjo
                  </h3>
                  <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">

                    </ul>
                  </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content p-0">

                    <div class="chart tab-pane active" id="map"
                      style="position: relative; height: 400px; width:100%;">

                    </div>
                  </div>
                </div><!-- /.card-body -->
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

    var map = L.map('map', {
        center: [-7.667458996836592, 110.86606738627907],
        zoom: 13,
        layers: [peta1, Kecamatan]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satelit": peta2,
        "Streets": peta3,
        "Dark": peta4
    };

    var overlayer = {
      "Kecamatan" : Kecamatan,
    }

    @foreach($kecamatan as $data)
      L.geoJSON(<?= $data->geojson?>,{
        style :{
          fillColor: '{{$data->warna}}',
          weight: 2,
          opacity: 1,
          color: 'white',
          fillOpacity: 0.7
        }
      }).addTo(Kecamatan);
    @endforeach

    L.control.layers(baseMaps, overlayer).addTo(map);

    //Menampilkan Tempat Vaksin Pada Peta
    @foreach($vaksin as $data)
      var markervaksin = L.icon({
        iconUrl : '{{asset('marker')}}/marker.png',
        iconSize : [25, 45],
      });

      //Mengecek jika foto tidak ada maka membawakan foto default NoImage
      var foto = '{{$data->foto}}';
      if(foto != ''){
        foto = '{{$data->foto}}';
      }else{
        foto = 'notfound.png';
      }

      //Menambahkan marker dan pop up informasi pada marker
      var informasi = "<center><h4><b>{{$data->nama_tempatVaksin}}</b></h4><br><img style = 'width: 150px' src='{{asset('foto')}}/"+foto+"'<br><br>{{$data->alamat}}<br></center>"
      L.marker([<?= $data->posisi?>],{icon: markervaksin}).
        addTo(map).
        bindPopup(informasi);
    @endforeach
</script>
@endsection
