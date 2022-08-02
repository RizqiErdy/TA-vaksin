@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Jadwal Vaksinasi</strong></h3>
                    <div class="card-tools">
                        <button class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i>Tambah</button>
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
                    
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="50px" class="text-center">No</th>
                                <th>Nama Tempat</th>
                                <th>Jenis Vaksin</th>
                                <th>Tipe Vaksin</th>
                                <th>Tanggal Vaksin</th>
                                <th>Waktu</th>
                                <th width="100px" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($jadwal as $data)
                            <?php $t = date('DD, d-m-Y',strtotime($data->tanggal));
                            ?>
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$data->nama_tempatVaksin}}</td>
                                    <td>{{$data->jenis_vaksin}}</td>
                                    <td>{{$data->tipe_vaksin}}</td>
                                    <td>{{Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y');}}</td>
                                    <td>{{$data->jam_mulai}} - {{$data->jam_selesai}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#ubah{{$data->id_jadwalVaksin}}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{$data->id_jadwalVaksin}}"><i class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="tambah">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Jadwal Vaksin</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/admin/jadwalvaksin/simpan" method="POST" enctype="multipart/form-data">
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
                                    <div class="input-group-append" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
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
                                <label>Waktu Mulai</label>
                                <input type="time" name="jam_mulai" class="form-control" placeholder="Masukkan Waktu Mulai">
                                <div class="text-danger">
                                    @error('jam_mulai')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Waktu Selesai</label>
                                <input type="time" name="jam_selesai" class="form-control" placeholder="Masukkan Waktu Selesai">
                                <div class="text-danger">
                                    @error('jam_selesai')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Tipe Vaksin</label>
                                <input type="text" name="tipe_vaksin" class="form-control" placeholder="Masukkan Tipe Vaksin">
                                <div class="text-danger">
                                    @error('tipe_vaksin')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Jenis Vaksin</label>
                                <input type="text" name="jenis_vaksin" class="form-control" placeholder="Masukkan Jenis Vaksin">
                                <div class="text-danger">
                                    @error('jenis_vaksin')
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

    @foreach($jadwal as $dataj)
        <div class="modal fade" id="ubah{{$dataj->id_jadwalVaksin}}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Form Edit Jadwal Vaksin</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="/admin/jadwalvaksin/update/{{$dataj->id_jadwalVaksin}}" method="POST" enctype="multipart/form-data">
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
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
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
                                    <label>Waktu Mulai</label>
                                    <input type="time" name="jam_mulai" value="{{$dataj->jam_mulai}}" class="form-control" placeholder="Masukkan Waktu Mulai">
                                    <div class="text-danger">
                                        @error('jam_mulai')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Waktu Selesai</label>
                                    <input type="time" name="jam_selesai" value="{{$dataj->jam_selesai}}" class="form-control" placeholder="Masukkan Waktu Selesai">
                                    <div class="text-danger">
                                        @error('jam_selesai')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipe Vaksin</label>
                                    <input type="text" name="tipe_vaksin" value="{{$dataj->tipe_vaksin}}" class="form-control" placeholder="Masukkan Tipe Vaksin">
                                    <div class="text-danger">
                                        @error('tipe_vaksin')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Jenis Vaksin</label>
                                    <input type="text" name="jenis_vaksin" value="{{$dataj->jenis_vaksin}}" class="form-control" placeholder="Masukkan Jenis Vaksin">
                                    <div class="text-danger">
                                        @error('jenis_vaksin')
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

@foreach($jadwal as $data)
<div class="modal fade" id="delete{{$data->id_jadwalVaksin}}">
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
            <a href="/admin/jadwalvaksin/delete/{{$data->id_jadwalVaksin}}" class="btn btn-danger">Ya</a>
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
