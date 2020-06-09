
@extends('layout')

@section('content')

<section class="posts container">
    @if(isset($title))
        <h3>{{ $title }}</h3>
    @endif

    @forelse($posts as $post)
        <article class="post">

            @include($post->viewType('home'))

            {{-- @if($post->photos->count() === 1)
                @include('posts.photo')
            @elseif($post->photos->count() > 1)
                @include('posts.carousel-preview')
            @elseif($post->iframe)
                @include('posts.iframe')
            @endif --}}

            <div class="content-post">

                @include('posts.header')   

                <h1>{{ $post->title }}</h1>
                <div class="divider"></div>
                <p>{{ $post->excerpt }}</p>
                <footer class="container-flex space-between">
                    <div class="read-more">
                        <a href="blog/{{ $post->url }}" class="text-uppercase c-green">Leer más</a>
                    </div>
                    <div class="tags container-flex">
                        @foreach($post->tags as $tag)
                            <span class="tags c-gray-1 text-capitalize"><a href="{{ route('tags.show', $tag)}}">#{{ $tag->name }}</a></span>
                        @endforeach
                    </div>
                </footer>
            </div>
        </article>
    @empty
        <article class="post">
            <div class="content-post">
                <h1>No hay publicaciones todavía.</h1>
                <div class="divider"></div>
            </div>
        </article>
    @endforelse
    

</section><!-- fin del div.posts.container -->

{{ $posts->appends(request()->all())->links() }}

{{-- <div class="pagination">
    <ul class="list-unstyled container-flex space-center">
        <li><a href="#" class="pagination-active">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
    </ul>
</div> --}}

@endsection
