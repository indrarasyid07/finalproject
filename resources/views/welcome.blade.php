@extends('adminlte.master')

@section('content')
<div class="container">
    <div class="col-md-12 mt-2">
        <!-- Widget: user widget style 2 -->
        <div class="card card-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <!-- /.widget-user-image -->
                <h3 >Aplikasi Tanya Jawab Seputar Coding</h3>
                <h5 >Kelompok 24</h5>
                <p>Saat ini semakin banyak masyarakat Indonesia di usia produktif mulai belajar tentang programming. Media pembelajaran sangat mudah ditemui dengan hanya mengandalkan kata kunci di mesin pencarian. Namun untuk para pembelajar pemula terutama bagi mereka yang kesulitan memahami literatur dalam bahasa Inggris kebanyakan menyerah ketika mendapati error ketika mencoba mempelajari materi lewat praktek langsung. Saat ini mereka menggunakan media komunikasi seperti grup telegram komunitas untuk bertanya tapi sangat sedikit dari anggota grup yang dapat membantu karena masih terlalu sulit untuk bertanya tentang pemrograman melalui aplikasi chatting. 
                </p>
               <a style="color:black !important;" href="{{route('pertanyaan.data')}}" type="button" class="btn btn-default btn-lg"><i class="fas fa-info"></i> Tanyakan Sesuatu</a>
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
</div> 
@endsection