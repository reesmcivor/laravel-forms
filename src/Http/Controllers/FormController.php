<?php

namespace ReesMcIvor\Forms\Http\Controllers

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FormController extends Controller
{
    public function index()
    {
        return view('forms::index');
    }
}
