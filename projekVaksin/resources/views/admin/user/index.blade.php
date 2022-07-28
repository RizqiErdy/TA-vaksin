@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar User</strong></h3>
                    <div class="card-tools">
                        <a href="/admin/user/tambah" type="button" class="btn btn-primary btn-flat btn-sm"><i class="fa fa-plus"></i> Tambah</a>
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
                                <th width="50px" class="text-center">No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th width="100px" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1?>
                            @foreach ($user as $data)
                                <tr>
                                    <td class="text-center">{{$no++}}</td>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->email}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-flat btn-warning" data-toggle="modal" data-target="#ubah{{$data->id}}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-flat btn-danger" data-toggle="modal" data-target="#delete{{$data->id}}"><i class="fa fa-trash"></i></button>
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

    @foreach($user as $data)
    <div class="modal fade" id="ubah{{$data->id}}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form role="form" action="/admin/user/update/{{$data->id}}" method="POST" enctype="multipart/form-data">
                    @csrf                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Nama User</label>
                                <input type="text" name="name" class="form-control" value="{{$data->name}}" placeholder="Masukkan Nama User">
                                <div class="text-danger">
                                    @error('name')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{$data->email}}" placeholder="Masukkan Email">
                                <div class="text-danger">
                                    @error('email')
                                        {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                <button class="btn btn-danger">Ya</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->    
      @endforeach
@foreach($user as $data)
<div class="modal fade" id="delete{{$data->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$data->name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
        </div>
        <div class="modal-body">
            <p>Apakah anda ingin menghapus data ini</p>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <a href="/admin/user/delete/{{$data->id}}" class="btn btn-danger">Ya</a>
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