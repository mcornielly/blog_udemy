@extends('admin.layout')

@section('header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Crear Publicación</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Inicio</a></li>
      <li class="breadcrumb-item active"><a href="{{ route('admin.posts.index') }}">Posts</a></li>
      <li class="breadcrumb-item active">Crear</li> 
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container-fluid">
<!-- /.col-md-8 -->
<div class="row">
  @if($post->photos->count())
  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-body">
        <div class="row">
          @foreach ($post->photos as $photo)
          <div class="col-md-2">
            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
            @csrf  {{ method_field('DELETE') }}
              <button class="btn btn-danger btn-xs" style="position: absolute;"><i class="fa fa-trash"></i></button>
              <img class="img-fluid" src="{{ url($photo->url) }}" alt="">                       
            </form>
          </div>
          @endforeach 
        </div>
      </div>
    </div>
  </div>  
  @endif
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Nuevo Post</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('admin.posts.update', $post) }}" >
            @csrf {{ method_field('PUT') }}
            <div class="card-body">
                <div class="form-group">
                  <label for="title">Titulo</label>
                <input name="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Ingresar un Título" 
                value="{{ old('title', $post->title) }}">
                  {{-- {!! $errors->first('title', '<span class="invalid-feedback">:message</span>') !!} --}}
                  <span class="invalid-feedback" role="alert">{{ $errors->first('title') }}</span>
                </div>
    
                <div class="form-group">
                    <label for="title">Contenido</label>
                    <textarea name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" 
                      name="body" id="editor" cols="40" rows="6" placeholder="Ingresar el contenido del post">{{ old('body', $post->body) }}</textarea>
                    <span class="invalid-feedback" role="alert">{{ $errors->first('body') }}</span>
                </div>

                <div class="form-group">
                  <label for="title">IFrame</label>
                  <textarea name="iframe" class="form-control {{ $errors->has('iframe') ? 'is-invalid' : '' }}" 
                    name="iframe" id="editor" cols="40" rows="2" placeholder="Ingresar el contenido embebido (iframe) de audio o video">{{ old('iframe', $post->iframe) }}</textarea>
                  <span class="invalid-feedback" role="alert">{{ $errors->first('iframe') }}</span>
              </div>
            </div>


              <!-- /.card-body -->
    
              {{-- <div class="card-footer" style="border-top: 1px solid rgba(0,0,0,.125);">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div> --}}
           
          </div>
    </div>
    <!-- /.col-md-8 -->
    <div class="col-lg-4">
        <div class="card card-primary card-outline">
            <div class="card-body">
                <div class="form-group">
                    <label>Fecha de Publicación</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="far fa-calendar-alt"></i>
                        </span>
                      </div>
                      <input type="text" name="published_at" 
                        class="form-control float-right" 
                        id="published" 
                        value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}">
                    </div>
                    <!-- /.input group -->
                  </div>
                <div class="form-group">
                    <label for="category">Categorías</label>
                    <select class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }} select2" name="category_id" id="category_id"> 
                        <option value="">Seleccione una Categoría</option>
                        @foreach($categories as $category)
                            <option {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }} 
                              value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                      <span class="invalid-feedback" role="alert">{{ $errors->first('category_id') }}</span>
                </div> 
                <div class="form-group">
                    <label>Etiquetas</label>
                    <select class="select2 form-control" name="tags[]"
                       multiple="multiple" data-placeholder="Seleccione una o más etiquetas" style="width: 100%;">
                       @foreach($tags as $tag) 
                            <option value="{{ $tag->id }}"
                              {{ collect(old('tags', $post->tags->pluck('id')))->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                      @endforeach
                    </select>
                    {!! $errors->first('tags', '<span class="help-block text-danger" style="font-size: 80%;">:message</span>') !!}
                    {{-- <span class="help-block" role="alert">{{ $errors->first('tags') }}</span> --}}
                </div> 
                <div class="form-group">
                    <label for="title">Extracto</label>
                    <textarea class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" 
                      name="excerpt" id="" cols="30" rows="2" placeholder="Ingresar un extracto">{{ old('excerpt', $post->excerpt) }}</textarea>
                    <span class="invalid-feedback" role="alert">{{ $errors->first('excerpt') }}</span>
                </div>
                <div class="form-group">
                  <label for="my-input">Text</label>
                  <div class="dropzone"></div>
                </div>
            </div>
            <div class="card-footer" style="border-top: 1px solid rgba(0,0,0,.125);">
                <button type="submit" class="btn btn-primary btn-block">Guardar Publicación</button>
            </div>
            {{-- end form --}}
            </form>   
        </div>
    </div>

</div>
</div>
@endsection

@push('styles') 
<!-- Select2 -->
<link rel="stylesheet" href="/adminlte/plugins/select2/css/select2.min.css">
<style>
  .select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: auto!important;
    user-select: none;
    -webkit-user-select: none;
}  
</style>
{{-- <link rel="stylesheet" href="/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> --}}
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker.css">
  
@endpush

@push('scripts')
    {{-- Ckeditor --}}
    <script src="/adminlte/plugins/ckeditor/ckeditor.js"></script>
    <!-- bootstrap time picker -->
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Select2 -->
    <script src="/adminlte/plugins/select2/js/select2.full.min.js"></script>
    <script>
    
    //Date picker
    $('#published').datepicker({
      autoclose: true
    });
    $('.select2').select2({
      tags: true
    });

    CKEDITOR.replace( 'editor');
    CKEDITOR.config.height = 230;
    
   var myDropzone = new Dropzone('.dropzone', {
      url: '/admin/posts/{{ $post->url }}/photos',
      acceptedFiles: 'image/*',
      maxFilesize: 2,
      paramName: 'photo',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      dictDefaultMessage: 'Arrastra las imagenes para subirlas'
    });

    myDropzone.on('error', function(file, res){
      var msg = res.errors.photo[0];
      $('.dz-error-message:last > span').text(msg);
    });

    Dropzone.autoDiscover = false;
</script>    
@endpush