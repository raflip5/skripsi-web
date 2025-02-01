<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ClasificationController extends Controller
{
    public function index(): View
    {
        return view('clasification.index');
    }

    public function store()
    {

    }
}
