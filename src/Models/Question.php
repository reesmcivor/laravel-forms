<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\QuestionFactory;

class Question extends Model
{
    use HasFactory;

    const TYPE_TEXT = 'text';

    protected static function newFactory()
    {
        return QuestionFactory::new();
    }

    public function forms()
    {
        return $this->belongsToMany(Form::class);
    }
}
