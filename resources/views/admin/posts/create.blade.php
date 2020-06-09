<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Agregar una Nueva Publicación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <!-- form start -->
      <form role="form" method="POST" action="{{ route('admin.posts.store', '#create') }}" >
        @csrf
      <div class="modal-body">
      <div class="form-group">
        <label for="title">Titulo</label>
        <input id="post-title" 
                name="title" 
                type="text" 
                class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" placeholder="Ingresar un Título" value="{{ old('title') }}" autofocus required>
          {{-- {!! $errors->first('title', '<span class="invalid-feedback">:message</span>') !!} --}}
          <span class="invalid-feedback" role="alert">{{ $errors->first('title') }}</span>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button class="btn btn-primary">Crear</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@push('scripts')
<script>
  console.log(window.location.hash);
  if(window.location.hash === '#create')
  {
    $('#exampleModal').modal('show');
  }
  
  $('#exampleModal').on('hide.bs.modal', function(){
    window.location.hash = '#';
  });
  
  $('#exampleModal').on('shown.bs.modal', function(){
    $('#post-title').focus();
    window.location.hash = '#create';
  });
</script>     
@endpush

