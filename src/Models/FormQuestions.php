<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\FormFactory;

class Form extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return FormFactory::new();
    }
}
