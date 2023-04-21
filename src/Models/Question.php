<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\QuestionFactory;

class Question extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return QuestionFactory::new();
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
