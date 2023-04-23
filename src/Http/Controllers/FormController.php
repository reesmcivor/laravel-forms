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

    public function store(Request $request)
    {
        $form = Form::create($request->all());
        return redirect()->route('tenant.forms.index');
    }

    public function show(Form $form)
    {
        return view('forms::forms.show', [
            'form' => $form,
        ]);
    }

    public function edit(Form $form)
    {
        return view('forms::forms.edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, Form $form)
    {
        $form->update($request->all());
        return redirect()->route('tenant.forms.index');
    }

    public function destroy(Form $form)
    {
        $form->delete();
        return redirect()->route('tenant.forms.index');
    }
}
