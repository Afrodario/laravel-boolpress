@extends('admin.layouts.admin-base')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h1>Modifica post</h1>

                <form method="POST" action={{route('admin.posts.update', $post->id)}} enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    @if ($post->cover)
                        <p>Immagine attuale</p>
                        <img class="img-thumbnail" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
                    @endif

                    <div class="form-group">
                        <label for="image">Carica una nuova cover</label>
                        {{-- Il name dell'input può contenere un qualunque nome, perché non ha diretta
                        corrispondenza con il path del database --}}
                        <input class="form-control" type="file" name="image" id="image">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select class="form-control" id="category_id" name="category_id">

                            <option value="">Seleziona una categoria</option>

                            @foreach ($categories as $category)
                                <option {{(old('category_id', $post->category_id) == $category->id) ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                      <label for="title">Titolo</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
                    </div>

                    <div class="form-group">
                        <label for="content">Contenuto del post</label>
                        <textarea class="form-control" id="content" rows="10" name="content">{{old('content', $post->content)}}</textarea>
                    </div>

                    @foreach ($tags as $tag) 

                    @if ($errors->any())

                        <div class="custom-control custom-checkbox">
                            <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value={{$tag->id}} {{in_array($tag->id, old('tags'))?'checked':''}}>
                            <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        </div>

                    @else
                        <div class="custom-control custom-checkbox">
                            {{-- La funzione della input deve recuperare i tags già selezionati in fase di creazione
                                dentro $post->tags non finisce un array, ma una collection (oggetto con metodi)
                                il metodo specifico per le collection è contains --}}
                            <input name="tags[]" type="checkbox" class="custom-control-input" id="tag_{{$tag->id}}" value="{{$tag->id}}" {{($post->tags->contains($tag))?'checked':''}}>
                            <label class="custom-control-label" for="tag_{{$tag->id}}">{{$tag->name}}</label>
                        </div>

                    @endif

                    @endforeach

                    <button type="submit" class="btn btn-primary">Salva</button>

                </form>
            </div>
        </div>
    </div>
@endsection