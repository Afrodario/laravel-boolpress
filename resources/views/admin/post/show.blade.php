@extends('admin.layouts.admin-base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1>Visualizzazione del post</h1>

                @if ($post->cover)
                    <img class="img-thumbnail" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
                @else
                    <img class="img-thumbnail" src="{{asset('img/phonograph-record.jpg')}}" alt="{{$post->title}}">
                @endif

                {{-- <img src="{{$post->img}}"> --}}
                {{-- <img src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}"> --}}
                <div>Titolo: {{$post->title}}</div>
                <div>Contenuto: {{$post->content}}</div>
                <div>Slug: {{$post->slug}}</div>
                <div>Categoria: {{$post->category->name}}</div>

                <div>Il post è stato creato: {{$diffInDays}} giorni fa</div>

                <div>
                    @foreach ($post->tags as $tag)
                        <span class="badge badge-primary">{{$tag->name}}</span>
                    @endforeach
                </div>

                <a href="{{route('admin.posts.index')}}" class="btn btn-primary">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection