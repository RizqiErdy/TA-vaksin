@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Tempat Vaksin</strong></h3>
                    <div class="card-tools">
                        <a href="/admin/tempatVaksin/tambah" type="button" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(session('pesan'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{session('pesan')}}</h5>
                    </div>
                    @endif
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="10px" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Fasilitas</th>
                                <th>Alamat</th>
                                <th>Kecamatan</th>
                                <th width="100px" class="text-center">Action</th>
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
                                    <td>{{$data->deskripsi}}</td>
                                    <td>{{$data->fasilitas}}</td>
                                    <td>{{$data->alamat}}</td>
                                    <td>{{$data->nama_kecamatan}}</td>
                                    <td class="text-center">
                                        <a href="/admin/tempatVaksin/edit/{{$data->id_tempatVaksin}}" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{$data->id_tempatVaksin}}"><i class="fa fa-trash"></i></button>
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

@foreach($vaksin as $data)
<div class="modal fade" id="delete{{$data->id_tempatVaksin}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$data->nama_tempatVaksin}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <p>Apakah anda ingin menghapus data ini</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <a href="/admin/tempatVaksin/delete/{{$data->id_tempatVaksin}}" class="btn btn-danger">Ya</a>
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
