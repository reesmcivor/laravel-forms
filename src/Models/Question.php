<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\FormQuestionFactory;

class FormQuestion extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return FormQuestionFactory::new();
    }
}
