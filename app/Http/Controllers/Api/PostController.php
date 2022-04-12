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

        //La funzione with con parametro category (cioè il nome della funzione che definisce la relazione)
        //risolve la relazione tra tabelle specificata
        //e restituisce le informazioni relative alla categoria
        $posts = Post::with(['category', 'tags'])->get();
        $categories = Category::all();

        //Metodo di laravel di paginazione automatica, invia i dati al front, raccolti poi con una chiamata axios
        $posts = Post::paginate(3);

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
        //Con questa sintassi richiedo al database il primo post dove lo slug sia uguale alla variabile arrivata alla funzione show
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

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
