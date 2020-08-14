@extends('adminlte.master')

@section('content')
<div class="col col-md-12 mt-3">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title mt-1">Daftar Pertanyaan</h3>
          <div class="card-tools">
                    @if (Auth::check())
                        <a href="/pertanyaan/create" class="btn btn-primary btn-sm">Tanyakan Sesuatu</a>
                    @endif
                </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              
              <tbody>
              @forelse($questions as $key => $questions)
                  <tr>
                      <td>
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
                            <a href="{{route('pertanyaan.detail', $questions->id)}}">
                                <b>{{$questions->title}}</b>
                            </a>
                            <br/>
                            <?php 
                                $kategori = explode(',',$questions->category);
                            ?>
                            @foreach ($kategori as $item_kategori)
                            <span class="badge badge-success">{{$item_kategori}}</span>
                            @endforeach
                            
                            <small style="float: right">
                                Ditanyakan Oleh <a href="#">{{$questions->user->name}}</a> {{$questions->created_at}}
                            </small>
                      </td>
                      @empty
                  </tr>
                @endforelse
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>
@endsection