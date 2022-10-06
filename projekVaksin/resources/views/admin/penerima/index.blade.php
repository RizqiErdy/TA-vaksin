@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">

        <!-- Komulatif -->
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Komulatif </strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                          <b>Total Jumlah Penerima</b> <a class="float-right">{{$penerima->sum('jumlah')}}</a>
                        </li>
                        <li class="list-group-item">
                          <b>Total hari ini</b> <a class="float-right">
                            @if($penerimanow->count() == 0)
                                0
                            @else
                                {{$penerimanow->sum('jumlah')}}
                            @endif</a>
                        </li>
                        <li class="list-group-item">
                          <b>Friends</b> <a class="float-right">13,287</a>
                        </li>
                      </ul>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Per Tipe -->
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Vaksinasi Per Dosis </strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="50px" class="text-center">No</th>
                                <th>Dosis Vaksin</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($penerimabyTipe as $data)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{($data->nama_tipe)}}</td>
                                    <td>{{$data->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <!-- Per penerima -->
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jumlah Vaksinasi Per Penerima </strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="50px" class="text-center">No</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($penerimabyPenerima as $data)
                            
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{($data->nama_penerima)}}</td>
                                    <td>{{$data->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal Vaksinasi</strong></h3>
                    <div class="card-tools">
                        <button class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambahjumlah"><i class="fa fa-plus"></i>Tambah</button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-times "></i>Data gagal disimpan </h5>
                    </div>
                    @endif
                    @if(session('pesan'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{session('pesan')}}</h5>
                    </div>
                    @endif

                    <table id="example1" class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th width="50px" class="text-center">No</th>
                                <th>Penerima</th>
                                <th>Tipe Vaksin</th>
                                <th>Tanggal Vaksin</th>
                                <th>Jumlah</th>
                                <th width="100px" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($penerima as $data)
                            <?php $t = date('DD, d-m-Y',strtotime($data->tanggal));
                            ?>
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$data->nama_penerima}}</td>
                                    <td>{{$data->nama_tipe}}</td>
                                    <td>{{Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y');}}</td>
                                    <td>{{$data->jumlah}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#ubah{{$data->id_jumlahPenerima}}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{$data->id_jumlahPenerima}}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>

    </div>
    <!-- /.content -->

    <!-- /.modal tambah -->
    <div class="modal fade" id="tambahjumlah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Jumlah Vaksinasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/admin/penerimaVaksin/simpan" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Tempat Vaksinasi</label>
                                <select name="tempatVaksin" id="tempatVaksin" class="form-control">
                                    <option value="">-- Pilih Tempat Vaksin --</option>
                                    @foreach ($vaksin as $data)
                                        <option value="{{$data->id_tempatVaksin}}">{{$data->nama_tempatVaksin}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('tempatVaksin')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Date:</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" name="tanggal" class="form-control datetimepicker-input">
                                    <div></div>
                                </div>
                                <div class="text-danger">
                                    @error('tanggal')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Penerima :</label>
                                <select name="penerimaVaksin" id="penerimaVaksin" class="form-control">
                                    <option value="">-- Pilih Penerima --</option>
                                    @foreach ($jnsPenerima as $data)
                                        <option value="{{$data->id_penerima}}">{{$data->nama_penerima}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('penerimaVaksin')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Dosis vaksin</label>
                                <select name="dosisVaksin" id="dosisVaksin" class="form-control">
                                    <option value="">-- Pilih Dosis --</option>
                                    @foreach ($tipeVaksin as $data)
                                        <option value="{{$data->id_tipe}}">{{$data->nama_tipe}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">
                                    @error('dosisVaksin')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Jumlah Penerima :</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="jumlah" class="form-control datetimepicker-input">
                                    <div></div>
                                </div>
                                <div class="text-danger">
                                    @error('jumlah')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button class="btn btn-danger">Simpan</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- /.modal edit -->
    @foreach($penerima as $dataj)
        <div class="modal fade" id="ubah{{$dataj->id_jumlahPenerima}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Edit Penerima Vaksin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/admin/penerimaVaksin/update/{{$dataj->id_jumlahPenerima}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Tempat Vaksinasi</label>
                                    <select name="tempatVaksin" id="tempatVaksin" class="form-control">
                                        <option value="{{$dataj->id_tempatVaksin}}">{{$dataj->nama_tempatVaksin}}</option>
                                        @foreach ($vaksin as $data)
                                            <option value="{{$data->id_tempatVaksin}}">{{$data->nama_tempatVaksin}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('tempatVaksin')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Date:</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="date" name="tanggal" value="{{Carbon\Carbon::parse($dataj->tanggal)->translatedFormat('Y-m-d');}}" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                        <div></div>
                                    </div>
                                    <div class="text-danger">
                                        @error('tanggal')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Penerima :</label>
                                    <select name="penerimaVaksin" id="penerimaVaksin" class="form-control">
                                        <option value="{{$dataj->id_penerima}}">{{$dataj->id_penerima}}</option>
                                        @foreach ($jnsPenerima as $data)
                                            <option value="{{$data->id_penerima}}">{{$data->nama_penerima}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('penerimaVaksin')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Dosis vaksin</label>
                                    <select name="dosisVaksin" id="dosisVaksin" class="form-control">
                                        <option value="{{$dataj->id_tipe}}">{{$dataj->nama_tipe}}</option>
                                        @foreach ($tipeVaksin as $data)
                                            <option value="{{$data->id_tipe}}">{{$data->nama_tipe}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">
                                        @error('dosisVaksin')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Jumlah Penerima :</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="jumlah" class="form-control datetimepicker-input" value="{{$dataj->jumlah}}">
                                        <div></div>
                                    </div>
                                    <div class="text-danger">
                                        @error('jumlah')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                </div>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button class="btn btn-info">Simpan</button>
                </div>
                </form>
            </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    @endforeach

@foreach($penerima as $data)
<div class="modal fade" id="delete{{$data->id_jumlahPenerima}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$data->tanggal}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <p>Apakah anda ingin menghapus data ini</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <a href="/admin/penerimaVaksin/delete/{{$data->id_jumlahPenerima}}" class="btn btn-danger">Ya</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach
</div>
@endsection
