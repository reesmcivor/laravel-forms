<?php

namespace ReesMcIvor\Forms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReesMcIvor\Forms\Database\Factories\TextAnswerFactory;

class TextAnswer extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return TextAnswerFactory::new();
    }

    public function question()
    {
        return $this->morphOne(Question::class, 'answerable');
    }
}
