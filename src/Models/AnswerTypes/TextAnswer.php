<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReesMcIvor\Forms\Database\Factories\TextAnswerFactory;
use ReesMcIvor\Forms\Models\Answer;

class TextAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return TextAnswerFactory::new();
    }

}
