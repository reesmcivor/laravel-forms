<?php

namespace ReesMcIvor\Forms\Models\AnswerTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\DateAnswerFactory;

class DateAnswer extends Answer
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'answer' => 'datetime',
    ];

    protected static function newFactory()
    {
        return DateAnswerFactory::new();
    }
}
