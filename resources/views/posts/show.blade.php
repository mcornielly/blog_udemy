@extends('layout')

@section('meta-title', $post->title)
@section('meta-description', $post->excerpt)

@push('css')
<link rel="stylesheet" href="/bootstrap/css/bootstrap.css">
{{-- <style>
  .container {
    width: 100%;
    padding-right: 0px!important;
    padding-left: 0px!important;
    margin-right: auto;
    margin-left: auto;
}
</style> --}}
@endpush

@section('content')
<article class="post container">

    @include($post->viewType())

    {{-- @if($post->photos->count() === 1)
        @include('posts.photo')
    @elseif($post->photos->count() > 1)
        @include('posts.carousel')
    @elseif($post->iframe)
        @include('posts.iframe')
    @endif --}}

    <div class="content-post">

      @include('posts.header')

      <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
          {{-- <figure class="block-left"><img src="/img/img-post-2.png" alt=""></figure> --}}
          <div>
          <p>{!! $post->body !!}</p>
          </div>
        </div>

        <footer class="container-flex space-between">

          @include('partials.social-links', ['description' => $post->title])
          
          <div class="tags container-flex">
            @foreach($post->tags as $tag)
                <span class="tags c-gray-1 text-capitalize">#{{ $tag->name }}</span>
            @endforeach
          </div>
      </footer>
      <div class="comments">
      <div class="divider"></div>
        <div id="disqus_thread"></div>
            @include('partials.disqus-script')
        </div><!-- .comments -->
    </div>
</article>
@endsection

@push('scripts')
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>   
<script src="/jquery/jquery-3.4.1.min.js"></script>   
<script src="/bootstrap/js/bootstrap.min.js"></script>   
@endpush