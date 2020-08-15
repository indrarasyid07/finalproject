@extends('adminlte.master')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush
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
                        $kategori = explode(',',$questions->category);
                    ?>  
                    @foreach ($kategori as $item_kategori)
                    <span class="badge badge-success">{{$item_kategori}}</span>
                    @endforeach
                    <br>
                    <span class="time" style="float: right">Ditanyakan <a href="#" title="Memiliki reputasi {{$questions->user->reputation}}">{{$questions->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$questions->user->reputation}})</a> {{date('d-m-Y H:i:s', strtotime($questions->created_at))}}</span>
                    <br>
                    <hr/>
                    @if(Auth::check())
                    <div class="mt-1" id="div_komentarjawaban_{{$questions->id}}">
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
                    @endif
                    {{-- Komentar --}}
                    <table class="table table-hover text-nowrap mt-2">
                        <tbody>
                            @foreach ($questions->comment as $comment)
                            <tr style="background:#f7f7f7;">
                                <td>
                                    @if(Auth::check())
                                        @if($comment->user_id==Auth::user()->id)
                                        <form id="delete-comment-question-{{$comment->id}}" action="{{ route('komentar.pertanyaan.destroy', $comment->id) }}" method="POST" style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a href="javascript:void(0)" onclick="hapuskomentarpertanyaan({{$comment->id}})" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus Komentar</a> &nbsp;&nbsp;
                                        @endif
                                    @endif
                                    {{$comment->body}}   <span style="float: right"><a href="#" >{{$comment->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$comment->user->reputation}})</a> | {{date('d-m-Y H:i:s', strtotime($comment->created_at))}}  </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </dd>
            </dl>
        </div>

        <!-- /.card-body -->
    </div>
    <div class="card">
        <div class="card-header">
            <h3>{{$countanswer}} Jawaban</h3>
        </div>
        <div class="card-body">
            @foreach($questions->answer as $answer)
            <dl class="row">
                <dt class="col-sm-2" align="center">
                    <h1>
                        <form id="upvote-form-jawaban-{{$answer->id}}" action="{{ route('jawaban.upvote') }}" method="POST" style="display: none;">
                            @csrf                          
                            <input type="hidden" name="idjawaban" value="{{$answer->id}}">
                        </form>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('upvote-form-jawaban-{{$answer->id}}').submit();">
                            <i class="nav-icon fas fa-angle-up"></i><br>
                        </a>
                            @php
                                $jmlup_answer = 0;
                                $jmldown_answer = 0;
                                foreach ($answer->vote as $datavote_answer) {
                                    $jmlup_answer += $datavote_answer->upvote;
                                    $jmldown_answer += $datavote_answer->downvote;
                                }
                            @endphp
                            {{ $jmlup_answer-$jmldown_answer }}
                        <br>
                        <form id="downvote-form-jawaban-{{$answer->id}}" action="{{ route('jawaban.downvote') }}" method="POST" style="display: none;">
                            @csrf                   
                            <input type="hidden" name="idjawaban" value="{{$answer->id}}">
                        </form>
                        <a href="javascript:void(0)" onclick="event.preventDefault(); document.getElementById('downvote-form-jawaban-{{$answer->id}}').submit();">
                            <i class="nav-icon fas fa-angle-down"></i>
                        </a>
                    </h1>
                </dt>
                <dd class="col-sm-10">
                    {!!$answer->body!!} 
                    @if (Auth::check() && Auth::user()->id == $answer->user_id)
                    <form id="delete-form-jawaban-{{$answer->id}}" action="{{ route('jawaban.delete', $answer->id) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                    <a href="javascript:void(0)" onclick="hapusjawaban({{$answer->id}})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus Jawaban</a>
                    @endif
                    <br><br>
                    <br>
                    <span class="time" style="float: right">Dijawab <a href="#" title="Memiliki reputasi {{$answer->user->reputation}}">{{$answer->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$answer->user->reputation}})</a> {{date('d-m-Y H:i:s', strtotime($answer->created_at))}}</span>
                    <br>
                    <hr>
                    @if(Auth::check())
                    <div class="mt-1" id="div_komentar_answer_{{$answer->question_id}}_{{$answer->id}}">
                        <form role="form" action="/komentar/{{$answer->id}}/storekomentarjawaban" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="idjawaban" value="{{$answer->id}}">
                                <input type="text" class="form-control" name="komentar_jawaban" value="" placeholder="Masukkan Komentar">
                                <button type="submit" class="btn btn-primary btn-sm mt-2"><i class="fas fa-paper-plane"></i> Kirim Komentar</button>
                            </div>
                        </form>
                    </div>
                    <br>           
                    @endif
                    <table class="table table-hover text-nowrap mt-2">
                        @foreach ($answer->comment as $comment_answer)
                        <tr style="background:#f7f7f7;">
                            <td>
                                @if(Auth::check())
                                    @if($comment_answer->user_id==Auth::user()->id)
                                    <form id="delete-comment-answer-{{$comment_answer->id}}" action="{{ route('komentar.jawaban.destroy', $comment_answer->id) }}" method="POST" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a href="javascript:void(0)" onclick="hapuskomentarjawaban({{$comment_answer->id}})" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus Komentar</a> &nbsp;&nbsp;
                                    @endif
                                @endif
                                {{$comment_answer->body}}   <span style="float: right"><a href="#" >{{$comment_answer->user->name}} (<i style="color:#ffa549" class="fas fa-star"></i> {{$comment_answer->user->reputation}})</a> | {{date('d-m-Y H:i:s', strtotime($comment_answer->created_at))}}  </span>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </dd>
            </dl>
            @endforeach
        </div>
    </div>
    @if(Auth::check())
    <div class="card">
        <div class="card-header">
            <h3>Tulis Jawabanmu</h3>
        </div>
        <div class="card-body">
            <form role="form" action="/pertanyaan/{{$questions->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" id="questionid" name="questionid" value="{{$questions->id}}">
                    <textarea name="body" class="form-control my-editor">{!! old('body', $body ?? '') !!}</textarea>
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-paper-plane"></i> &nbsp;Kirim Jawabanmu</button>
                  </div>
            </form>
        </div>
    </div>
    @endif
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
        function hapuskomentarpertanyaan(id) {
            swal({
                title: 'Apakah anda yakin?',
                text: 'Komentar ini akan terhapus, data tidak dapat dikembalikan!',
                icon: 'warning',
                buttons: ["Batal", "Hapus!"],
            }).then(function(value) {
                if (value) {
                    document.getElementById('delete-comment-question-'+id).submit();
                }
            });
        }
        function hapuskomentarjawaban(id) {
            swal({
                title: 'Apakah anda yakin?',
                text: 'Komentar ini akan terhapus, data tidak dapat dikembalikan!',
                icon: 'warning',
                buttons: ["Batal", "Hapus!"],
            }).then(function(value) {
                if (value) {
                    document.getElementById('delete-comment-answer-'+id).submit();
                }
            });
        }
        function hapusjawaban(id) {
            swal({
                title: 'Apakah anda yakin?',
                text: 'Jawaban ini akan terhapus, data tidak dapat dikembalikan!',
                icon: 'warning',
                buttons: ["Batal", "Hapus!"],
            }).then(function(value) {
                if (value) {
                    document.getElementById('delete-form-jawaban-'+id).submit();
                }
            });
        }

        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };

        tinymce.init(editor_config);
    </script>
@endpush