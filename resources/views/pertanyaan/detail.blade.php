@extends('adminlte.master')
@section('content')
<div class="container mt-2">
    <div class="card">
        <div class="card-header">
            <h3 >Ini pertanyaan yang ditanyakan oleh user ??</h3>
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
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Natus et suscipit, cumque quas earum, tempore, iste maiores soluta ad laudantium blanditiis rerum placeat. Exercitationem provident nemo corrupti vero. Distinctio, accusantium.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, quos. Illo illum doloremque quisquam amet, aut pariatur ullam aliquid provident dolorem iusto fugiat. Quo quaerat itaque delectus nisi repudiandae beatae.
                    <br><br>
                    <a href="#" class="btn btn-sm btn-primary">jQuery (ini tags)</a><br/>
                    <a href="#">Tambahkan Komentar</a>
                    <br>
                    <span class="time" style="float: right">Ditanyakan <a href="#">Ahmad Fahrudin</a> 13-08-2020 20:01:01</span>
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
