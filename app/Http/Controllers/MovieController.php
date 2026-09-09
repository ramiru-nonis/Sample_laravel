<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = [
            'Inception',
            'The Dark Knight',
            'Interstellar',
            'The Matrix',
            'Pulp Fiction',
        ];

        return view('movies', compact('movies'));
    }
}

