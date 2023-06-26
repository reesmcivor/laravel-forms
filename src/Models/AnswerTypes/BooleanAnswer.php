<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use ReesMcIvor\Forms\Database\Factories\BooleanFactory;
use ReesMcIvor\Forms\Models\Answer;

class BooleanAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'answer' => 'boolean',
    ];

    protected static function newFactory()
    {
        return BooleanFactory::new();
    }

}
