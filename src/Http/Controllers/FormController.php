<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReesMcIvor\Forms\Models\Form;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::paginate(10);
        return view('forms::forms.index', [
            'forms' => $forms,
        ]);
    }

    public function create()
    {
        return view('forms::forms.create');
    }
}
