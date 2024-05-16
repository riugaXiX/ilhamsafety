
@extends('layouts.template')

@section('csstambahan')

@endsection


@section('konten')
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah data siswa</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('flame.tambah') }}" method="post">
                @csrf
                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama siswa</label>
                    <input type="text" name='api' class="form-control" id="exampleInputEmail1" placeholder="Masukan Nama Siswa">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>


@endsection


@section('jstambahan')

@endsection