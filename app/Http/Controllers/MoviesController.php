<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    

    public function index() {
        // busca os filmes pelo nome por ordem crescente
        $movies = Movie::orderBy('name', 'asc')->get();

        return view('movies.index', ['movs' => $movies, 'pagina' => 'movies']);
    }

    public function show(Movie $mov) {
        //retorna um filme em especifico
        return view('movies.show', ['mov' => $mov, 'pagina' => 'movies']);
    }

    public function create() {
        //retorna a pagina de criacao de filme
        return view('movies.create', ['pagina' => 'movies']);
    }

    public function insert(Request $form) {
        //salva a imagem no storage e obtem ela
        $imagemCaminho = $form->file('imagem')->store('', 'imagens');
        $mov = new Movie();

        //atribui os campos
        $mov->name = $form->name;
        $mov->description = $form->description;
        $mov->genre = $form->genre;
        $mov->trailer = $form->trailer;
        $mov->image = $imagemCaminho;
        
        //salva
        $mov->save();

        return redirect()->route('movies');
    }

}
