<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\TextAnswerFactory;

class ChoiceAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function newFactory()
    {
        return ChoiceAnswerFactory::new();
    }

    public function questionAnswer()
    {
        return $this->morphOne(QuestionAnswer::class, 'answerable');
    }
}