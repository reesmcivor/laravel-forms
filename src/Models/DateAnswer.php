<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\DateAnswerFactory;

class DateAnswer extends Model
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

    public function questionAnswer()
    {
        return $this->morphOne(QuestionAnswer::class, 'answerable');
    }
}
