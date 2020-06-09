@extends('layout')

@section('content')
<section class="pages container">
    <div class="page page-about">
        <h1 class="text-capitalize"><h2>404 - Página no encontrada</h2></h1>
        <div class="divider-2" style="margin: 35px 0;"></div>
        <p>Regresar a <a href="{{ route('pages.home') }}">Inicio</a></p>
    </div>
</section>
@endsection