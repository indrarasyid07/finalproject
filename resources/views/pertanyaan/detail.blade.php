@extends('adminlte.master')
@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h3 >{{$questions->title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2" align="center">
                    <h1>
                        <a href="#">
                            <i class="nav-icon fas fa-angle-up"></i><br>
                        </a>
                        0
                        <br>
                        <a href="#">
                            <i class="nav-icon fas fa-angle-down"></i>
                        </a>
                    </h1>
                </dt>
                <dd class="col-sm-10">
                    {{$questions->body}}
                    <br><br>
                    <a href="#" class="btn btn-sm btn-primary">{{$questions->category}}</a><br/>
                    <a href="#">Tambahkan Komentar</a>
                    <br>
                    <span class="time" style="float: right">Ditanyakan <a href="#">Ahmad Fahrudin</a> {{$questions->created_at}}</span>
                    <br><br>
                    
                    {{-- Komentar --}}
                    <table class="table table-hover text-nowrap">
                        <tbody>
                            <tr>
                                <td>&nbsp; </td>
                                <td>ini komentar Lorem ipsum dolor sit amet?   <span style="float: right"><a href="#" >Andi Rohmanto</a> <i class="nav-icon fas fa-home"></i> 13-08-2020 20:01:01  </span></td>
                            </tr>
                        </tbody>
                    </table>
                </dd>
            </dl>
        </div>
        
        <!-- /.card-body -->
    </div>
</div>
@endsection
