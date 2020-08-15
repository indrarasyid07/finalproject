@extends('adminlte.master')
@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>{{$questions->title}}</h3>
            @if (Auth::check() && Auth::user()->id == $questions->user_id)
            <a href="{{route('pertanyaan.edit', $questions->id)}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i> Edit Pertanyaan</a>
            <form id="delete-form" action="{{ route('pertanyaan.delete', $questions->id) }}" method="POST" style="display: none;">
                @method('DELETE')
                @csrf
            </form>
            <a href="javascript:void(0)" id="tombol-hapus" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus Pertanyaan</a>
            @endif
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2" align="center">
                    <h1>
                        <form id="upvote-form" action="{{ route('pertanyaan.upvote') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="upvote_idpertanyaan" value="{{$questions->id}}">
                        </form>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('upvote-form').submit();">
                            <i class="nav-icon fas fa-angle-up"></i><br>
                        </a>
                        @php
                        $jmlup = 0;
                        $jmldown = 0;
                        foreach ($datavotes as $datavote) {
                        $jmlup += $datavote->upvote;
                        $jmldown += $datavote->downvote;
                        }
                        @endphp
                        {{ $jmlup-$jmldown }}
                        <br>
                        <form id="downvote-form" action="{{ route('pertanyaan.downvote') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="hidden" name="downvote_idpertanyaan" value="{{$questions->id}}">
                        </form>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('downvote-form').submit();">
                            <i class="nav-icon fas fa-angle-down"></i>
                        </a>
                    </h1>
                </dt>
                <dd class="col-sm-10">
                    {!!$questions->body!!}
                    <br><br>
                    <?php
                    $kategori = explode(',', $questions->category);
                    ?>
                    @foreach ($kategori as $item_kategori)
                    <span class="badge badge-success">{{$item_kategori}}</span>
                    @endforeach
                    <br />

                    <br>
                    <span class="time" style="float: right">Ditanyakan <a href="#" title="Memiliki reputasi {{$questions->user->reputation}}">{{$questions->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$questions->user->reputation}})</a> {{$questions->created_at}}</span>
                    <br />

                    <a href="javascript:void(0)" class="btn btn-warning btn-xs" onclick="tambahkomentar(<?php echo $questions->id; ?>)" style="color:white;"><i class="fas fa-comment"></i> Tambahkan Komentar</a>
                    <br><br>

                    <a>komentar</a>
                    <br>
                    <a href="javascript:void(0)" class="btn btn-warning btn-xs" onclick="tambahkomentar(<?php echo $questions->id ?>)" style="color:white;"><i class="fas fa-comment"></i> Tambahkan Komentar</a>
                    <div class="mt-1" id="div_komentarjawaban_{{$questions->id}}" style="display: none;">
                        <form role="form" action="/komentar/{{$questions->id}}/storekomentarpertanyaan" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="komentar_question_id" id="komentar_question_id" value="{{$questions->id}}">
                                <input type="text" class="form-control" id="komentar_isi" name="komentar_isi" placeholder="Masukkan Komentar">
                                <button type="submit" class="btn btn-primary btn-sm mt-2"><i class="fas fa-paper-plane"></i> Kirim Komentar</button>
                            </div>
                        </form>
                    </div>

                    <br>
                    {{-- Komentar --}}
                    <table class="table table-hover text-nowrap mt-2">
                        <tbody>
                            @forelse($comment as $komen)
                            <tr>
                                <td>&nbsp; </td>
                                <td> {{$komen->body}}<span style="float: right"><a href="#">{{$questions->user->name}}</a> <i class="nav-icon fas fa-home"></i> 13-08-2020 20:01:01 </span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">komentar Masih Kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <a>Jawaban</a>
                    <br>
                    <a class="btn btn-warning btn-xs mb-2" href="/pertanyaan/{{$questions->id}}/createAnswer" style="color:white;"><i class="fas fa-comment"></i> Tambahkan Jawaban</a>
                    @foreach($answers as $answer)
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>&nbsp; </td>
                                <td>
                                    <h1>
                                        <form id="upvote1-form" action="{{ route('pertanyaan.upvoteAnswer') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="upvote1_idjawaban" value="{{$answer->id}}">
                                        </form>
                                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('upvote1-form').submit();">
                                            <i class="nav-icon fas fa-angle-up"></i><br>
                                        </a>
                                        @php
                                        $jmlup1 = 0;
                                        $jmldown1 = 0;
                                        foreach ($datavotes1 as $datavote1) {
                                        $jmlup1 += $datavote1->upvote1;
                                        $jmldown1 += $datavote1->downvote1;
                                        }
                                        @endphp
                                        {{ $jmlup1-$jmldown1 }}
                                        <br>
                                        <form id="downvote1-form" action="{{ route('pertanyaan.downvoteAnswer') }}" method="POST" style="display: none;">
                                            @csrf
                                            <input type="hidden" name="downvote1_idjawaban" value="{{$answer->id}}">
                                        </form>
                                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('downvote1-form').submit();">
                                            <i class="nav-icon fas fa-angle-down"></i>
                                        </a>
                                    </h1>
                                </td>
                                <td>{!!$answer->body!!}<span class="time" style="float: right"><a href="#" title="Memiliki reputasi {{$questions->user->reputation}}">{{$answer->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$answer->user->reputation}})</a> {{$answer->created_at}}</span>
                            </tr>
                        </tbody>
                    </table>
                    @endforeach
                </dd>
            </dl>
        </div>

        <!-- /.card-body -->
    </div>


</div>
@endsection


@push('scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#tombol-hapus').on('click', function(event) {
        event.preventDefault();
        swal({
            title: 'Apakah anda yakin?',
            text: 'Pertanyaan ini akan terhapus, data tidak dapat dikembalikan!',
            icon: 'warning',
            buttons: ["Batal", "Ya!"],
        }).then(function(value) {
            if (value) {
                document.getElementById('delete-form').submit()
            }
        });
    });
</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.statkomenpertanyaan = 1;
    $('#tombol-hapus').on('click', function(event) {
        event.preventDefault();
        swal({
            title: 'Apakah anda yakin?',
            text: 'Pertanyaan ini akan terhapus, data tidak dapat dikembalikan!',
            icon: 'warning',
            buttons: ["Batal", "Hapus!"],
        }).then(function(value) {
            if (value) {
                document.getElementById('delete-form').submit()
            }
        });
    });

    function tambahkomentar(id) {
        if (window.statkomenpertanyaan == 1) {
            window.statkomenpertanyaan = 0;
            $('#div_komentarjawaban_' + id).show('fast');
        } else {
            window.statkomenpertanyaan = 1;
            $('#div_komentarjawaban_' + id).hide('fast');
        }
    }
</script>
@endpush