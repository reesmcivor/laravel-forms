<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReesMcIvor\Forms\Database\Factories\VarcharAnswerFactory;
use ReesMcIvor\Forms\Models\Answer;

class TextAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return VarcharAnswerFactory::new();
    }

}
