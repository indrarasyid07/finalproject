@extends('adminlte.master')

@section('content')
<div class="row mt-3 ml-3">
    <div class="col col-md-12 mt-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Pertanyaan</h3>
                <div class="card-tools">
                    @if (Auth::check())
                    <a href="#" class="btn btn-primary btn-sm">Tanyakan Sesuatu</a>
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
                                    Is there a way to run yarn test (jest) and directly update interactively?
                                </a>
                                <br/>
                                <a href="#" class="btn btn-sm btn-primary">jQuery</a>
                                <small style="float: right">
                                    Ditanyakan Oleh <a href="#">Ahmad Fahrudin</a> 13-08-2020 20:01:01
                                </small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection