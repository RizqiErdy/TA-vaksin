@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah User</strong></h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="/admin/user/simpan" method="POST" enctype="multipart/form-data">
                        @csrf                    
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama User</label>
                                    <input type="text" name="name" class="form-control" placeholder="Masukkan Nama User">
                                    <div class="text-danger">
                                        @error('name')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                                    <div class="text-danger">
                                        @error('email')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" maxlength="8" class="form-control" placeholder="Masukkan Password">
                                    <div class="text-danger">
                                        @error('password')
                                            {{$message}}
                                        @enderror
                                    </div>    
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/admin/user" class="btn btn-warning float-right">Cancel</a>
                </div>
            </form>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.content -->

</div>

@endsection

