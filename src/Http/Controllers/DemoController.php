<?php

namespace ReesMcIvor\Forms\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;

class DemoController extends Controller
{
    public function create()
    {
        Artisan::call("forms:seed");
        return redirect()->back();
    }
}
