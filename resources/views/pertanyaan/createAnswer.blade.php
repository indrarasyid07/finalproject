@extends('adminlte.master')

@push('script-head')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endpush

@section('content')
        <div class="mt-3 mx-4">
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Jawaban</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="/pertanyaan/{{$question->id}}" method="POST">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="body">Isi</label>
                    <!-- <input type="text" class="form-control" id="body" name="body" value="{{ old('body','') }}" placeholder="Masukkan Isi" required> -->
                    <input type="hidden" id="questionid" name="questionid" value="{{$question->id}}">
                    <textarea name="body" class="form-control my-editor">{!! old('body', $body ?? '') !!}</textarea>
                    @error('body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <a href="/pertanyaan/{{$question->id}}" class="btn btn-danger btn-md" style="color:white"><i class="fas fa-ban"></i> &nbsp;Batal</a>
                  <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Simpan Jawaban</button>
                </div>
              </form>
            </div>
        </div>
        </div>
@endsection

@push('scripts')
<script>
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