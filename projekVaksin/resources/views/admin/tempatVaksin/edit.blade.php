@extends('layouts.admin')
@section('content')
@php
$jsArray = "var prdID = new Array();\n";
@endphp
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Tempat Vaksin</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="/admin/tempatVaksin/update/{{$tempatVaksin->id_tempatVaksin}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Tempat Vaksin</label>
                                    <input type="text" name="tempatVaksin" value="{{$tempatVaksin->nama_tempatVaksin}}" class="form-control" placeholder="Masukkan Nama Tempat Vaksin">
                                    <div class="text-danger">
                                        @error('tempatVaksin')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan" class="form-control">
                                        <option value="{{$tempatVaksin->id_kecamatan}}">{{$tempatVaksin->nama_kecamatan}}</option>
                                        @foreach ($kecamatan as $dataKec)
                                            <option value="{{$dataKec->id_kecamatan}}">{{$dataKec->nama_kecamatan}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('kecamatan')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" value="{{$tempatVaksin->alamat}}" class="form-control" placeholder="Masukkan Alamat Tempat Vaksin">
                                    <div class="text-danger">
                                        @error('alamat')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" rows="2" class="form-control" placeholder="Deskripsi">{{$tempatVaksin->deskripsi}}</textarea>
                                    <div class="text-danger">
                                        @error('deskripsi')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fasilitas</label>
                                    <textarea name="fasilitas" rows="2" class="form-control" placeholder="Fasilitas">{{$tempatVaksin->fasilitas}}</textarea>
                                    <div class="text-danger">
                                        @error('fasilitas')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Posisi</label>
                                    <input type="text" name="posisi" id="posisi" value="{{$tempatVaksin->posisi}}" class="form-control" placeholder="Posisi Tempat Vaksin">
                                    <div class="text-danger">
                                        @error('posisi')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" class="form-control" accept="image/jpeg,image/png">
                                    <div class="text-danger">
                                        @error('foto')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label>Peta</label>
                                <div class="chart tab-pane active" id="map"style="position: relative; height: 300px; width:100%;">
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/admin/tempatVaksin" class="btn btn-warning float-right">Cancel</a>
                </div>
                </form>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.content -->
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

    var map = L.map('map', {
        center: [{{$tempatVaksin->posisi}}],
        zoom: 15,
        layers: [peta2]
    });

    var baseMaps = {
        "Grayscale": peta1,
        "Satelit": peta2,
        "Streets": peta3,
        "Dark": peta4
    };

    L.control.layers(baseMaps).addTo(map);

    //Mengambil Titik Koordinat
    var curLocation = [{{$tempatVaksin->posisi}}];
    map.attributionControl.setPrefix(false)

    //menambahkan marker dragdrop pada peta
    var marker = new L.marker(curLocation,{
        draggable : true,
    });
    map.addLayer(marker);

    //mengambil titik kordinat ketika marker di drag drop
    marker.on('dragend', function(event){
        var position = marker.getLatLng();
        marker.setLatLng(position,{
            draggable : true,
        }).bindPopup(position).update();
        $("#posisi").val(position.lat+","+position.lng).keyup();
    });

    //mengambil titik kordinat ketika map diklik
    var posisi = document.querySelector("[name=posisi]");
    map.on("click",function(event){
        var lat = event.latlng.lat;
        var lng = event.latlng.lng;
        if(!marker){
            marker = L.marker(event.latlng.lat.addTo(map));
        }else{
            marker.setLatLng(event.latlng);
        }
        posisi.value = lat + "," + lng ;
    });

    //Mengambil kordinat dari form to marker map
    var inputSearch = document.getElementById("posisi")
    inputSearch.addEventListener("keyup", function(event){
        var value = event.target.value;
        var explode = value.split(",");
        var lat = explode[0];
        var lng = explode[1];
        // console.log(lat , lng);

        map.setView([lat, lng],15);
        marker.setLatLng([lat, lng]).update();
    });

</script>
@endsection

