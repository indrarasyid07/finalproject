@extends('adminlte.master')
@section('content')
<form action="/komentar/input" method="POST">
    @csrf
    <div class="form-group w-75 ml-4">
        <label>Komentar pertanyaan</label>
        <textarea class="form-control" rows="4" placeholder="Masukan Komentar Anda" name="body"></textarea>
    </div>
    <button type="submit" class="btn btn-success ml-4">Kirim Komentar</button>

</form>
@endsection