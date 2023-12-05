<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use ReesMcIvor\Forms\Events\FormEntryComplete;
use ReesMcIvor\Forms\Models\FormEntry;

class ThankYouController extends Controller
{
    public function __invoke(Request $request, FormEntry $formEntry)
    {
        return view('forms::form-entry/thank-you', [
            'formEntry' => $formEntry,
        ]);
    }
}
