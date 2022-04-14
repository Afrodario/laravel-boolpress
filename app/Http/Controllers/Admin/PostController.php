<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;

//Importazione di Carbon
use Carbon\Carbon;
use Illuminate\Http\Request;
//Importazione di Storage
use Illuminate\Support\Facades\Storage;
//Importazione STR
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //Posso specificare ::with['category']->get() per risolvere subito la query con le relazioni
        //tra tabelle in modo da velocizzare le prestazioni
        $posts = Post::all();
        $tags = Tag::all();

        return view('admin.post.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //Raccolgo tutte le categorie
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Funzione di validazione
        $request->validate(
            [
            'title' => 'required|min:5',
            'content' => 'required|min:20',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            //Validazione specifica per l'upload dell'immagine, con funzione specifica image e il max della dimensione in KB
            'image' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:2048'
            ]
        );

        $data = $request->all();

        if (isset($data['image'])) {
            //Richiamo Storage per il salvataggio del file caricato, indicando la cartella di destinazione
            //e da dove prendere il dato, cioè da $data di image, il nome che ho dato nel form in create
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }

        //Calcolo lo slug (campo unico) a partire dal titolo in modo che ogni articolo
        //abbia un riferimento univoco
        $slug = Str::slug($data['title']);

        $counter = 1;

        while(Post::where('slug', $slug)->first()) {

            $slug = Str::slug($data['title']) . '-' . $counter;
            $counter++;

        };

        $data['slug'] = $slug;

        $post = new Post();
        $post->fill($data);
        $post->save();

        //Metodo SYNC per aggiungere o rimuovere dati dalla tabella ponte, lo fa automaticamente anche in fase di edit
        $post->tags()->sync($data['tags']);

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //Utilizzo di Carbon per la visualizzazione del tempo
        $now = Carbon::now();

        //Creo un nuovo oggetto Carbon che mi dia la data e l'ora, passandogli il valore di created at di un post del database
        $postDateTime = Carbon::create($post->created_at);

        $diffInDays = $now->diffInDays($postDateTime);

        return view('admin.post.show', compact('post', 'diffInDays'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        //Nella compact devo anche passare il parametro categories per fornire alla edit la lista delle categorie che ho raccolto
        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                'title' => 'required|min:5',
                'content' => 'required|min:20',
                'category_id' => 'nullable|exists:categories,id',
                'tags' => 'nullable|exists:tags,id',
                'image' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:2048'
            ]
        );

        $data = $request->all();

        if (isset($data['image'])) {

            if ($post->cover) {
                Storage::delete($post->cover);
            }
            
            //Richiamo Storage per il salvataggio del file caricato, indicando la cartella di destinazione
            //e da dove prendere il dato, cioè da $data di image, il nome che ho dato nel form in create
            $cover_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_path;
        }

        $slug = Str::slug($data['title']);

        if ($post->slug != $slug) {
            $counter = 1;
            while (Post::where('slug', $slug)->first()) {
                $slug = Str::slug($data['title']) . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        }

        
        $post->update($data);
        $post->save();

        $post->tags()->sync($data['tags']);
        
        return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover) {
            Storage::delete($post->cover);
        }


        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
