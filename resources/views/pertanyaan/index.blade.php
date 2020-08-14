@extends('adminlte.master')

@section('content')
<div class="col col-md-12 mt-4">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title mt-1">Daftar Pertanyaan</h3>
          <div class="card-tools">
                    @if (Auth::check())
                        <a href="/pertanyaan/create" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> &nbsp; Tanyakan Sesuatu</a>
                    @endif
                </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
                <tbody>
                @forelse($questions as $key => $question)
                    <tr>
                        <td width="200">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-block btn-default btn-flat">0 <br> Votes</button>
                                </li>
                                <li class="list-inline-item">
                                    <button type="button" class="btn btn-block btn-default btn-flat">0 <br> Jawaban</button>
                                </li>
                            </ul>
                        </td>
                        <td>
                            <a href="{{route('pertanyaan.detail', $question->id)}}">
                                <b>{{$question->title}}</b>
                            </a>
                            <br/>
                            <?php 
                                $kategori = explode(',',$question->category);
                            ?>
                            @foreach ($kategori as $item_kategori)
                            <span class="badge badge-success">{{$item_kategori}}</span>
                            @endforeach
                            
                            <small style="float: right">
                                Ditanyakan Oleh <a href="#">{{$question->user->name}}</a> {{$question->created_at}}
                            </small>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Data Masih Kosong</td>
                    </tr>
                @endforelse
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="2">{{ $questions->links() }}</td>
                  </tr>
                </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection