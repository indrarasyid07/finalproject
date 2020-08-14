@extends('adminlte.master')

@section('content')
<div class="col col-md-12 mt-3">
    <div class="card">
        <div class="card-header">
              @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
              @endif
          <h3 class="card-title mt-1">Daftar Pertanyaan</h3>
          <div class="card-tools">
                    @if (Auth::check())
          <a href="/pertanyaan/create" class="btn btn-primary btn-sm">Tanyakan Sesuatu</a>
                    @endif
                </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 20%">
                          
                      </th>
                      <th style="width: 80%">
                          Judul
                      </th>
                  </tr>
              </thead>
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
                            <a href="{{route('pertanyaan.detail', 1)}}">
                                {{$questions->title}}
                            </a>
                            <br/>
                            <a href="#" class="btn btn-sm btn-primary">{{$questions->category}}</a>
                            <small style="float: right">
                                Ditanyakan Oleh <a href="#">Ahmad Fahrudin</a> {{$questions->created_at}}
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