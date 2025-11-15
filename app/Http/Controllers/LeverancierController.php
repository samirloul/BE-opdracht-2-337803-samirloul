<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeverancierController extends Controller
{
    public function index()
    {
        // Hier gaan we later het overzicht ophalen (user story 1)
        return view('leveranciers.index');
    }
}
