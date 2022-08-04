@extends('layouts.frontend')
@section('content')
  <section class="col connectedSortable">
     <div class="row">
  <!-- Left col -->
        <section class="col-sm-12 connectedSortable">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content p-1">
                        <div class="container">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-times "></i>Gagal Mengirimkan Email</h5>
                            </div>
                            @endif
                            @if(session('pesan'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> {{session('pesan')}}</h5>
                            </div>
                            @endif
                            <div class="row m-3 mb-5">
                               <div class="col-md-6 offset-md-3">
                               <h3 style="text-align: center">Form Kritik dan Saran</h3>
                               <h5 style="text-align: center; color:#9F9C9C">Untuk menghubungi dan jika ada kritik dan saran silahkan masukkan pada form di bawah ini. Semoga web ini dapat membantu bagi semua pihak. Terima Kasih...</h5>
                               <hr>
                               <br>
                               <form action="{{ route('email.send') }}" method="post">
                                  @csrf
                                  <div class="form-group">
                                     <label for="">Name</label>
                                     <input type="text" class="form-control" name="name" placeholder="Enter your name">
                                     <div class="text-danger">
                                        @error('name')
                                            {{$message}}
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="form-group">
                                     <label for="">Email</label>
                                     <input type="text" class="form-control" name="email" placeholder="Enter your email">
                                     <div class="text-danger">
                                        @error('email')
                                            {{$message}}
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="form-group">
                                     <label for="">Subject</label>
                                     <input type="text" class="form-control" name="subject" placeholder="Enter subject">
                                     <div class="text-danger">
                                        @error('subject')
                                            {{$message}}
                                        @enderror
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <textarea name="message" cols="4" rows="4" class="form-control" placeholder="Message here...."></textarea>
                                    <div class="text-danger">
                                        @error('message')
                                            {{$message}}
                                        @enderror
                                    </div>
                                  </div>
                                  <button type="submit" class="btn btn-block btn-success">Send Email</button>
                               </form>
                               <div class="text-danger">
                                </div>
                               </div>
                            </div>
                         </div>
                    </div>
                </div><!-- /.card-body -->
            </div>
        </section>
      </div>

@endsection
