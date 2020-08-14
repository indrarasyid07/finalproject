@extends('adminlte.master')

@section('content')
        <div class="mt-3 mx-4">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Buat Pertanyaan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/pertanyaan" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title','')}}" placeholder="Masukkan judul" required>
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="category">kategori</label>
                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category','')}}" placeholder="Masukkan kategori" required>
                    @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="body">Isi</label>
                    <input type="text" class="form-control" id="body" name="body" value="{{ old('body','') }}" placeholder="Masukkan Isi" required>
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="{{route('pertanyaan.data')}}" class="btn btn-danger btn-md" style="color:white"><i class="fas fa-ban"></i> &nbsp;Batal</a>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Simpan Pertanyaan</button>
                </div>
              </form>
            </div>
        </div>
        </div>
@endsection