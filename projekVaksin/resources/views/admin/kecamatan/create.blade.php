@extends('layouts.admin')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Main content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Kecamatan</strong></h3> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form role="form" action="/admin/kecamatan/simpan" method="POST">
                        @csrf                    
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nama Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" placeholder="Masukkan Nama Kecamatan">
                                    <div class="text-danger">
                                        @error('kecamatan')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Warna</label>
                                    <div class="input-group my-colorpicker2">
                                        <input type="text" class="form-control" name="warna">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-square"></i></span>
                                    </div>
                                    </div>
                                    <div class="text-danger">
                                        @error('warna')
                                            {{$message}}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>GeoJSon</label>
                                    <textarea name="geojson" rows="7" class="form-control"></textarea>
                                    <div class="text-danger">
                                        @error('geojson')
                                            {{$message}}
                                        @enderror
                                    </div>    
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <a href="/admin/kecamatan" class="btn btn-warning float-right">Cancel</a>
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

