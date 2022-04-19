<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //La funzione with con parametro category (cioè il nome della funzione che definisce la relazione nei singoli model)
        //risolve la relazione tra tabelle specificata
        //e restituisce le informazioni relative alla categoria
        $posts = Post::with(['category', 'tags'])->get();

        $categories = Category::all();

        //Metodo di laravel di paginazione automatica, invia i dati al front, raccolti poi con una chiamata axios
        $posts = Post::paginate(6);

        //Costruisco per il campo cover una URL assoluta a partire dall'URL relativa salvata nel database,
        //grazie alla funzione di Laravel url()
        $posts->each(function($post) {
            if ($post->cover) {
                $post->cover = url('storage/'.$post->cover);
            } else {
                $post->cover = url('img/phonograph-record.jpg');
            }
        });

        //Metodo di raccolta dati da tornare alla vista in formato json, response() e json()
        return response()->json(
            [
                'results' => $posts,
                'categoryList' => $categories,
                'success' => true
            ]
        );
    }

    //La funzione show raccoglie la rotta di un singolo post da routes/api.php renderizzando lo slug, al posto dell'id
    public function show($slug) {
        //Con questa sintassi richiedo al database il primo post (first) dove lo slug sia uguale alla variabile arrivata alla funzione show
        //dalla rotta definita in api.php
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

        if ($post->cover) {
            $post->cover = url('storage/'.$post->cover);
        } else {
            $post->cover = url('img/phonograph-record.jpg');
        }

        if ($post) {
            return response()->json(
                [
                    'result' => $post,
                    'success' => true
                ]
            );    
        } else {
            return response()->json(
                [
                    'result' => 'Non trovato',
                    'success' => false
                ]
            );    
        }

    }

}
